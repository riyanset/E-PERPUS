<?php
/**
 * Melayani file PDF untuk dibaca di web (tanpa unduh)
 */
require_once __DIR__ . '/config.php';

$id = trim($_GET['id'] ?? '');
$book = $id ? getBookById($id) : null;

if (!$book || empty($book['file'])) {
    http_response_code(404);
    exit('Buku tidak ditemukan.');
}

// Blokir semua percobaan unduh
if (isset($_GET['download'])) {
    http_response_code(403);
    exit('Unduh E-book tidak diizinkan. Baca langsung di website.');
}

$filename = basename($book['file']);
$filepath = PDF_DIR . '/' . $filename;

if (!file_exists($filepath) || !is_readable($filepath)) {
    http_response_code(404);
    exit('File PDF tidak ditemukan.');
}

if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) !== 'pdf') {
    http_response_code(403);
    exit('Format file tidak diizinkan.');
}

header('Content-Type: application/pdf');
header('Content-Length: ' . filesize($filepath));
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Cache-Control: private, max-age=3600');
header('X-Content-Type-Options: nosniff');

readfile($filepath);
exit;