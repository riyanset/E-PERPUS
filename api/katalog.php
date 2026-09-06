<?php
require_once __DIR__ . '/config.php';
requireLogin();

$pageTitle = 'Katalog Buku';
$allBooks = getBooks();
$categories = array_keys(getBooksGroupedByCategory());

$search = trim($_GET['q'] ?? '');
$category = trim($_GET['cat'] ?? '');
$books = $allBooks;

if ($search !== '') {
    $books = array_filter($books, function ($book) use ($search) {
        $haystack = strtolower(
            ($book['title'] ?? '') . ' ' .
            ($book['author'] ?? '') . ' ' .
            ($book['category'] ?? '')
        );
        return str_contains($haystack, strtolower($search));
    });
}

if ($category !== '') {
    $books = array_filter($books, fn($book) => ($book['category'] ?? '') === $category);
}

$books = array_values($books);
$isGrouped = ($search === '' && $category === '');
$grouped = $isGrouped ? getBooksGroupedByCategory($books) : [];

require_once __DIR__ . '/../includes/header.php';
?>

<!-- Content Header -->
<section class="content-header">
    <div class="content-header-inner">
        <h1>
            Katalog E-Book
            <small><?= count($allBooks) ?> Koleksi PDF Tersedia</small>
        </h1>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Pencarian & Filter Koleksi</h3>
        </div>
        <div class="box-body">
            <form class="catalog-filter" method="get" action="katalog.php">
                <div class="search-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                    </svg>
                    <input type="text" name="q" placeholder="Cari judul, penulis, kategori..." value="<?= htmlspecialchars($search) ?>">
                </div>
                <select name="cat" class="filter-select">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat) ?>" <?= $category === $cat ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary">Cari Buku</button>
                <?php if ($search || $category): ?>
                <a href="katalog.php" class="btn btn-default">Reset Filter</a>
                <?php endif; ?>
            </form>

            <?php if (!empty($allBooks) && $isGrouped): ?>
            <div class="category-pills">
                <?php foreach (getCategoryCounts() as $cat => $count): ?>
                <a href="katalog.php?cat=<?= urlencode($cat) ?>" class="category-pill">
                    <?= htmlspecialchars($cat) ?>
                    <span><?= $count ?></span>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (empty($books)): ?>
    <div class="box box-warning">
        <div class="box-body text-center empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <h3>Tidak Ditemukan E-Book</h3>
            <p>Coba gunakan kata kunci atau kategori yang berbeda.</p>
        </div>
    </div>
    <?php elseif ($isGrouped): ?>
        <?php foreach ($grouped as $catName => $catBooks): ?>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><?= htmlspecialchars($catName) ?></h3>
                <span class="pull-right badge bg-blue"><?= count($catBooks) ?> buku</span>
            </div>
            <div class="box-body">
                <div class="book-grid">
                    <?php foreach ($catBooks as $book): ?>
                    <?php include __DIR__ . '/../includes/book-card.php'; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Hasil Pencarian (<?= count($books) ?> E-book)</h3>
            </div>
            <div class="box-body">
                <div class="book-grid">
                    <?php foreach ($books as $book): ?>
                    <?php include __DIR__ . '/../includes/book-card.php'; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>