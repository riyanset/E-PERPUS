<?php
/**
 * Konfigurasi E-Perpus Mas Riy
 */

define('APP_NAME', 'E-Perpus Mas Riy');
define('APP_TAGLINE', 'Perpustakaan Digital Pribadi');
define('BASE_PATH', __DIR__);
define('DATA_FILE', dirname(__DIR__) . '/data/books.json');
define('PDF_DIR', dirname(__DIR__) . '/pdfs');
define('CATEGORY_ORDER', [
    'Islam & Spiritual',
    'Psikologi',
    'Motivasi & Pengembangan Diri',
    'Bisnis & Keuangan',
    'Kepemimpinan',
    'Filosofi & Berpikir',
    'Komunikasi',
    'Sejarah',
    'Teknologi & Skill',
    'Akademik',
    'Umum',
]);

define('CATEGORY_COLORS', [
    'Islam & Spiritual'     => ['#14532d', '#22c55e'],
    'Psikologi'             => ['#4c1d95', '#a78bfa'],
    'Motivasi & Pengembangan Diri' => ['#92400e', '#fbbf24'],
    'Bisnis & Keuangan'     => ['#1e3a5f', '#38bdf8'],
    'Kepemimpinan'          => ['#7c2d12', '#fb923c'],
    'Filosofi & Berpikir'   => ['#312e81', '#818cf8'],
    'Komunikasi'            => ['#831843', '#f472b6'],
    'Sejarah'               => ['#44403c', '#d6d3d1'],
    'Teknologi & Skill'     => ['#0c4a6e', '#22d3ee'],
    'Akademik'              => ['#3f3f46', '#a1a1aa'],
    'Umum'                  => ['#1e293b', '#94a3b8'],
]);

$motivasi = [
    ['quote' => 'Membaca adalah pintu menuju dunia yang tak terbatas. Setiap halaman adalah petualangan baru.', 'author' => 'Anonim'],
    ['quote' => 'Buku adalah teman terbaik yang tidak pernah mengkhianati. Ia selalu ada saat kita membutuhkan.', 'author' => 'Anonim'],
    ['quote' => 'Investasi terbaik adalah investasi pada pengetahuan. Dan cara termudah adalah dengan membaca.', 'author' => 'Warren Buffett'],
    ['quote' => 'Seorang pembaca hidup seribu kali sebelum ia mati. Orang yang tidak pernah membaca hanya hidup sekali.', 'author' => 'George R.R. Martin'],
];

function makeBookId(string $filename): string
{
    $base = pathinfo($filename, PATHINFO_FILENAME);
    $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $base));
    return trim($slug, '-') ?: md5($filename);
}

function parsePdfFilename(string $filename): array
{
    $raw = pathinfo($filename, PATHINFO_FILENAME);
    $author = '';
    $title = preg_replace('/^-E-\d+-\s*/i', '', $raw);
    $title = preg_replace('/^\d+\.\s*/', '', $title);
    $title = preg_replace('/^\([^)]+\)\s*/', '', $title);

    if (preg_match('/\s+[Bb]y\s+(.+)$/u', $title, $m)) {
        $author = trim($m[1]);
        $title = trim(preg_replace('/\s+[Bb]y\s+.+$/u', '', $title));
    }
    if ($author === '' && preg_match('/^(.+?)\s+-\s+(.+)$/u', $title, $m)) {
        $first = trim($m[1]);
        $second = trim($m[2]);
        if (strlen($first) < 45 && !preg_match('/^\d/', $first)) {
            $author = $first;
            $title = $second;
        }
    }
    if ($author === '' && preg_match('/^(.+?)\s+-\s+([^-]+)$/u', $title, $m)) {
        $last = trim($m[2]);
        if (strlen($last) <= 50 && !preg_match('/\d{3,}/', $last)) {
            $title = trim($m[1]);
            $author = $last;
        }
    }

    $title = preg_replace('/\s*\(\d+\)\s*$/', '', $title);
    $title = preg_replace('/\s*\(Bahasa Indonesia\)/i', '', $title);
    $title = preg_replace('/\s*\(B\.\s*INDO\)/i', '', $title);
    $title = preg_replace('/\s+/', ' ', trim($title, " \t\n\r\0\x0B-"));

    if ($author !== '') {
        $author = trim(preg_replace('/\s*\(\d+\)\s*$/', '', $author));
    }

    return ['title' => $title ?: $raw, 'author' => $author ?: '-'];
}

function detectCategory(string $title, string $filename): string
{
    $text = strtolower($title . ' ' . $filename);
    $rules = [
        'Islam & Spiritual' => ['islam', 'quranic', 'sirah', 'nabawiyah', 'rasulullah', 'adab', 'allah', 'akhir zaman', 'bencana', 'peperangan', 'prioritas antara adab'],
        'Psikologi' => ['psikologi', 'mindset', 'mental block', 'psychology of money', 'diskursus'],
        'Motivasi & Pengembangan Diri' => ['atomic habit', 'good vibes', 'self-love', 'minimalis', 'rehat', 'galau', 'gagal', 'tenang', 'law of attraction', 'titik terendah', 'personal attraction', 'uzrah', 'critical thinking'],
        'Bisnis & Keuangan' => ['business plan', 'marketing', 'money', 'gaji', 'brand', 'tiktok', 'bisnis', 'mengelola gaji'],
        'Kepemimpinan' => ['kepemimpinan', 'leadership', 'principles of power', 'power dion'],
        'Filosofi & Berpikir' => ['filosofi', 'falsafah', 'filsafat', 'filosofi teras', 'berpikir logis'],
        'Komunikasi' => ['berbicara', 'komunikasi', 'larry king', 'sakit hati'],
        'Sejarah' => ['sejarah', 'disembunyikan'],
        'Teknologi & Skill' => ['excel', 'microsoft', 'tips tricks'],
        'Akademik' => ['pertemuan', 'seminar', 'kesimpulan'],
    ];
    foreach ($rules as $category => $keywords) {
        foreach ($keywords as $keyword) {
            if (str_contains($text, $keyword)) {
                return $category;
            }
        }
    }
    return 'Umum';
}

function getCategoryColors(string $category): array
{
    return CATEGORY_COLORS[$category] ?? CATEGORY_COLORS['Umum'];
}

function getDriveThumbnailUrl(?string $idDrive): string
{
    if (empty($idDrive)) {
        return 'assets/images/default-cover.svg';
    }
    return 'https://docs.google.com/uc?export=view&id=' . urlencode($idDrive);
}

function getDrivePreviewUrl(?string $idDrive): ?string
{
    if (empty($idDrive)) {
        return null;
    }
    return 'https://drive.google.com/file/d/' . rawurlencode($idDrive) . '/preview';
}

function loadBooksFromJson(): array
{
    if (!file_exists(DATA_FILE)) {
        return [];
    }

    $data = json_decode(file_get_contents(DATA_FILE), true);
    if (!is_array($data)) {
        return [];
    }

    $books = [];
    foreach ($data as $book) {
        if (empty($book['id'])) {
            continue;
        }
        $category = $book['category'] ?? 'Umum';
        $books[] = [
            'id' => $book['id'],
            'id_drive' => $book['id_drive'] ?? '',
            'title' => $book['title'] ?? 'Tanpa Judul',
            'author' => $book['author'] ?? '-',
            'category' => $category,
            'description' => $book['description'] ?? ('E-book PDF — ' . $category),
            'cover' => getDriveThumbnailUrl($book['id_drive'] ?? ''),
            'colors' => getCategoryColors($category),
        ];
    }

    usort($books, function ($a, $b) {
        $catOrder = array_flip(CATEGORY_ORDER);
        $catA = $catOrder[$a['category']] ?? 99;
        $catB = $catOrder[$b['category']] ?? 99;
        if ($catA !== $catB) {
            return $catA <=> $catB;
        }
        return strcasecmp($a['title'], $b['title']);
    });

    return $books;
}

function scanPdfBooks(): array
{
    return loadBooksFromJson();
}

function getBooks(): array
{
    static $cache = null;
    if ($cache === null) {
        $cache = scanPdfBooks();
    }
    return $cache;
}

function getBooksGroupedByCategory(?array $books = null): array
{
    $books = $books ?? getBooks();
    $grouped = [];
    foreach ($books as $book) {
        $grouped[$book['category'] ?? 'Umum'][] = $book;
    }
    $ordered = [];
    foreach (CATEGORY_ORDER as $cat) {
        if (!empty($grouped[$cat])) {
            $ordered[$cat] = $grouped[$cat];
        }
    }
    foreach ($grouped as $cat => $items) {
        if (!isset($ordered[$cat])) {
            $ordered[$cat] = $items;
        }
    }
    return $ordered;
}

function getFeaturedBooks(int $limit = 6): array
{
    $featured = [];
    foreach (getBooksGroupedByCategory() as $books) {
        if (count($featured) >= $limit) {
            break;
        }
        $featured[] = $books[0];
    }
    if (count($featured) < $limit) {
        foreach (getBooks() as $book) {
            if (count($featured) >= $limit) {
                break;
            }
            if (!in_array($book['id'], array_column($featured, 'id'), true)) {
                $featured[] = $book;
            }
        }
    }
    return $featured;
}

function getCategoryCounts(): array
{
    $counts = [];
    foreach (getBooks() as $book) {
        $cat = $book['category'] ?? 'Umum';
        $counts[$cat] = ($counts[$cat] ?? 0) + 1;
    }
    return $counts;
}

function getBookById(string $id): ?array
{
    foreach (getBooks() as $book) {
        if ($book['id'] === $id) {
            return $book;
        }
    }
    return null;
}

function formatFileSize(int $bytes): string
{
    if ($bytes >= 1048576) {
        return round($bytes / 1048576, 1) . ' MB';
    }
    if ($bytes >= 1024) {
        return round($bytes / 1024, 1) . ' KB';
    }
    return $bytes . ' B';
}

function truncateTitle(string $title, int $max = 60): string
{
    if (mb_strlen($title) <= $max) {
        return $title;
    }
    return mb_substr($title, 0, $max - 1) . '…';
}
