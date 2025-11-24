<?php
declare(strict_types=1);

namespace App\Services;

use Exception;

class UploaderService {
    
    private const ALLOWED_MIMES = ['image/jpeg', 'image/png', 'image/webp'];
    private const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 MB

    private string $baseDir;

    public function __construct() {
        $this->baseDir = __DIR__ . '/../../assets/uploads/';
    }

    public function upload(array $file, string $subDir): string {
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File upload failed code: " . $file['error']);
        }
        $this->validateFile($file);
        $subDir = preg_replace('/[^a-zA-Z0-9_\-\/]/', '', $subDir);
        $targetDir = $this->baseDir . $subDir;
        
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = uniqid('upload_') . '_' . time() . '.' . $ext;
        $targetFile = $targetDir . $filename;
        $webPath = 'assets/uploads/' . $subDir . $filename;
        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0755, true)) { 
                 throw new Exception("Failed to create directory");
            }
        }
        if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
            throw new Exception("Failed to move file");
        }
        
        return $webPath;
    }

    private function validateFile(array $file): void {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            throw new Exception("File too large (Max 5MB)");
        }
        
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);

        if (!in_array($mimeType, self::ALLOWED_MIMES)) {
            throw new Exception("Invalid file type: $mimeType");
        }
    }
}