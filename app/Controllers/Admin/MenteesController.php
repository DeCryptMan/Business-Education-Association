<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;
use Core\Response;
use App\Models\Mentee;

class MenteesController extends Controller {
    public function index() {
        $filters = [
            'status' => $_GET['status'] ?? 'new',
            'search' => $_GET['search'] ?? '',
            'period' => $_GET['period'] ?? 'all'
        ];

        $mentees = Mentee::getAll($filters);
        
        $counts = [
            'new'      => count(Mentee::getAll(['status' => 'new'])),
            'approved' => count(Mentee::getAll(['status' => 'approved'])),
            'rejected' => count(Mentee::getAll(['status' => 'rejected'])),
            'all'      => Mentee::count()
        ];

        View::render('admin/mentees/index', [
            'mentees' => $mentees,
            'filters' => $filters,
            'counts'  => $counts
        ], 'admin_layout');
    }
    public function show(string $id) {
        $mentee = Mentee::getById((int)$id);
        
        if (!$mentee) {
            echo "Mentee not found";
            return;
        }

        View::render('admin/mentees/show', ['item' => $mentee], 'admin_layout');
    }
    public function updateStatus(string $id) {
        $status = $_POST['status'] ?? null;
        
        if (in_array($status, ['new', 'approved', 'rejected'])) {
            Mentee::updateStatus((int)$id, $status);
        }

        Response::redirect('admin/mentees/' . $id);
    }
    public function export() {
        $filters = [
            'status' => $_GET['status'] ?? 'all',
            'search' => $_GET['search'] ?? '',
            'period' => $_GET['period'] ?? 'all'
        ];
        
        $data = Mentee::getAll($filters);
        $filename = "mentees_export_" . date('Y-m-d_H-i') . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');
        fputs($output, "\xEF\xBB\xBF");

        fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Status', 'Date', 'Organization', 'Position']);

        foreach ($data as $row) {
            $json = !empty($row['profile_data']) ? json_decode($row['profile_data'], true) : [];
            
            fputcsv($output, [
                $row['id'],
                $row['full_name'],
                $row['email'],
                $row['phone'],
                $row['status'],
                $row['created_at'],
                $json['currentOrg'] ?? '',
                $json['currentPosition'] ?? ''
            ]);
        }

        fclose($output);
        exit;
    }
}