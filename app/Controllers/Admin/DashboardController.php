<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;
use Core\Auth;
use Core\Response;
use Core\Database;
use PDO;
use App\Models\Event;

class DashboardController extends Controller {
    
    public function __construct() {
        if (!Auth::check()) {
            Response::redirect('login');
        }
    }

    public function index() {
        $db = Database::connect();
        $kpi = [
            'mentors'  => $this->getDailyStats($db, 'mentors'),
            'mentees'  => $this->getDailyStats($db, 'mentees'),
            'messages' => $this->getDailyStats($db, 'contact_messages'),
            'events'   => [
                'total' => count(Event::getAll()),
                'upcoming' => count(Event::getUpcoming(50))
            ]
        ];

        $hourlyChart = $this->getHourlyActivity($db);
        $distribution = [
            'mentors' => $this->getStatusDistribution($db, 'mentors'),
            'mentees' => $this->getStatusDistribution($db, 'mentees')
        ];
        $activity = $this->getRecentActivity($db);
        $ratio = ($kpi['mentees']['total'] > 0 && $kpi['mentors']['total'] > 0) 
            ? round($kpi['mentees']['total'] / $kpi['mentors']['total'], 1) 
            : 0;

        View::render('admin/dashboard', [
            'kpi' => $kpi,
            'chart' => $hourlyChart,
            'dist' => $distribution,
            'activity' => $activity,
            'ratio' => $ratio
        ], 'admin_layout');
    }

    // --- HELPERS ---

    private function getDailyStats(PDO $db, string $table): array {
        $allowedTables = ['mentors', 'mentees', 'contact_messages'];
        if (!in_array($table, $allowedTables)) {
            throw new \Exception("Invalid table name");
        }

        $today = date('Y-m-d') . '%';
        $yesterday = date('Y-m-d', strtotime('-1 day')) . '%';
        $total = (int)$db->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
        
        $stmt = $db->prepare("SELECT COUNT(*) FROM `$table` WHERE created_at LIKE :date");
        
        $stmt->execute(['date' => $today]);
        $todayCount = (int)$stmt->fetchColumn();
        
        $stmt->execute(['date' => $yesterday]);
        $yesterdayCount = (int)$stmt->fetchColumn();

        $diff = $todayCount - $yesterdayCount;
        $growthPercent = 0;
        
        if ($yesterdayCount > 0) {
            $growthPercent = round(($diff / $yesterdayCount) * 100, 1);
        } elseif ($todayCount > 0) {
            $growthPercent = 100;
        }

        return [
            'total' => $total,
            'today' => $todayCount,
            'diff' => $diff,
            'growth' => $growthPercent,
            'is_positive' => $diff >= 0
        ];
    }
    private function getHourlyActivity(PDO $db): array {
        $labels = [];
        $dataMap = [];
        for ($i = 11; $i >= 0; $i--) {
            $hourKey = date('Y-m-d H', strtotime("-$i hours"));
            $labels[] = date('H:00', strtotime("-$i hours"));
            $dataMap[$hourKey] = 0;
        }
        $sql = "
            SELECT DATE_FORMAT(created_at, '%Y-%m-%d %H') as hour_key, COUNT(*) as cnt 
            FROM mentors 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 12 HOUR)
            GROUP BY hour_key
            UNION ALL
            SELECT DATE_FORMAT(created_at, '%Y-%m-%d %H') as hour_key, COUNT(*) as cnt 
            FROM mentees 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 12 HOUR)
            GROUP BY hour_key
        ";

        $rows = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            if (isset($dataMap[$row['hour_key']])) {
                $dataMap[$row['hour_key']] += $row['cnt'];
            }
        }

        return [
            'labels' => json_encode($labels),
            'data' => json_encode(array_values($dataMap))
        ];
    }

    private function getStatusDistribution(PDO $db, string $table): array {
        $allowedTables = ['mentors', 'mentees'];
        if (!in_array($table, $allowedTables)) return ['new'=>0, 'approved'=>0, 'rejected'=>0];

        $stmt = $db->query("SELECT status, COUNT(*) as cnt FROM `$table` GROUP BY status");
        $res = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        
        return [
            'new' => $res['new'] ?? 0,
            'approved' => $res['approved'] ?? 0,
            'rejected' => $res['rejected'] ?? 0
        ];
    }

    private function getRecentActivity(PDO $db): array {
        $sql = "
            (SELECT id, full_name, 'mentor' as type, created_at, status FROM mentors)
            UNION ALL
            (SELECT id, full_name, 'mentee' as type, created_at, status FROM mentees)
            ORDER BY created_at DESC LIMIT 10
        ";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}