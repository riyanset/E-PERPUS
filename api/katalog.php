<?php
require_once 'config.php';

$pageTitle = 'Katalog';
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

// PERBAIKAN: Jalur dirubah mundur satu tingkat ke root folder
require_once '../includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <span class="section-tag">Koleksi</span>
        <h1 class="page-title">Katalog E-book</h1>
        <p class="page-desc"><?= count($allBooks) ?> E-book PDF tersedia di <?= htmlspecialchars(APP_NAME) ?>.</p>
    </div>
</section>

<section class="catalog">
    <div class="container">
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
            <button type="submit" class="btn btn-primary">Cari</button>
            <?php if ($search || $category): ?>
            <a href="katalog.php" class="btn btn-ghost">Reset</a>
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

        <?php if (empty($books)): ?>
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <h3><?= empty($allBooks) ? 'Belum Ada Buku' : 'Tidak Ditemukan' ?></h3>
            <p>
                <?php if (empty($allBooks)): ?>
                Letakkan data buku di <code>data/books.json</code> dengan <code>id_drive</code> Google Drive.
                <?php else: ?>
                Coba kata kunci atau kategori lain.
                <?php endif; ?>
            </p>
        </div>
        <?php elseif ($isGrouped): ?>
        <?php foreach ($grouped as $catName => $catBooks): ?>
        <div class="catalog-section reveal">
            <div class="catalog-section-header">
                <h2 class="catalog-section-title"><?= htmlspecialchars($catName) ?></h2>
                <span class="catalog-section-count"><?= count($catBooks) ?> buku</span>
            </div>
            <div class="book-grid">
                <?php foreach ($catBooks as $book): ?>
                <?php include '../includes/book-card.php'; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="catalog-count"><?= count($books) ?> E-book ditemukan</p>
        <div class="book-grid">
            <?php foreach ($books as $book): ?>
            <?php include '../includes/book-card.php'; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>