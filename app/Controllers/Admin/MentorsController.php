<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;
use Core\Response;
use App\Models\Mentor;

class MentorsController extends Controller {
    
    public function index() {
        $filters = [
            'status' => $_GET['status'] ?? 'new',
            'search' => $_GET['search'] ?? '',
            'period' => $_GET['period'] ?? 'all'
        ];

        $mentors = Mentor::getAll($filters);
        
        $counts = [
            'new'      => count(Mentor::getAll(['status' => 'new'])),
            'approved' => count(Mentor::getAll(['status' => 'approved'])),
            'rejected' => count(Mentor::getAll(['status' => 'rejected'])),
            'all'      => Mentor::count()
        ];

        View::render('admin/mentors/index', [
            'mentors' => $mentors,
            'filters' => $filters,
            'counts'  => $counts
        ], 'admin_layout');
    }

    public function show(string $id) {
        $mentor = Mentor::getById((int)$id);
        if (!$mentor) { echo "Not found"; return; }
        View::render('admin/mentors/show', ['item' => $mentor], 'admin_layout');
    }

    public function updateStatus(string $id) {
        $status = $_POST['status'] ?? null;
        if (in_array($status, ['new', 'approved', 'rejected'])) {
            Mentor::updateStatus((int)$id, $status);
        }
        Response::redirect('admin/mentors/' . $id);
    }

    public function export() {
        $filters = [
            'status' => $_GET['status'] ?? 'all',
            'search' => $_GET['search'] ?? '',
            'period' => $_GET['period'] ?? 'all'
        ];
        
        $data = Mentor::getAll($filters);
        $filename = "mentors_export_" . date('Y-m-d_H-i') . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');
        fputs($output, "\xEF\xBB\xBF");

        fputcsv($output, ['ID', 'Name', 'Organization', 'Position', 'Email', 'Phone', 'Status', 'Date']);

        foreach ($data as $row) {
            fputcsv($output, [
                $row['id'],
                $row['full_name'],
                $row['organization'],
                $row['position'],
                $row['email'],
                $row['phone'],
                $row['status'],
                $row['created_at']
            ]);
        }
        fclose($output);
        exit;
    }
}