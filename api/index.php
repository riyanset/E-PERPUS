<?php
require_once 'config.php';

$pageTitle = 'Beranda';
$books = getBooks();
$featuredBooks = getFeaturedBooks();
$categoryCounts = getCategoryCounts();
$totalBooks = count($books);
$randomMotivasi = $motivasi[array_rand($motivasi)];

// PERBAIKAN: Jalur dirubah mundur satu tingkat ke root folder
require_once __DIR__ . '/../includes/header.php';
?>

<section class="hero">
    <div class="container hero-grid">
        <div class="hero-content">
            <span class="hero-badge">Selamat Datang</span>
            <h1 class="hero-title">
                Jelajahi Dunia<br>
                <em>Melalui Halaman</em>
            </h1>
            <p class="hero-desc">
                <?= htmlspecialchars(APP_NAME) ?> Menghadirkan koleksi E-Book PDF pilihan.
                Baca kapan saja, di mana saja — karena setiap buku adalah investasi terbaik untuk masa depan Anda.
            </p>
            <div class="hero-actions">
                <a href="katalog.php" class="btn btn-primary">
                    <span>Mulai Membaca</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="#motivasi" class="btn btn-ghost">Dapatkan Motivasi</a>
            </div>
            <div class="hero-stats">
                <div class="stat">
                    <span class="stat-num"><?= $totalBooks ?></span>
                    <span class="stat-label">E-Book Tersedia</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat">
                    <span class="stat-num">24/7</span>
                    <span class="stat-label">Akses Bebas</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat">
                    <span class="stat-num">100%</span>
                    <span class="stat-label">Gratis Baca</span>
                </div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-quote-box">
                <p>"<?= htmlspecialchars($randomMotivasi['quote']) ?>"</p>
                <cite>- <?= htmlspecialchars($randomMotivasi['author']) ?></cite>
            </div>
        </div>
    </div>
</section>

<section class="motivasi" id="motivasi">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Inspirasi</span>
            <h2 class="section-title">Mengapa Membaca Itu Penting?</h2>
            <p class="section-desc">Kata-kata bijak dari para pemikir hebat untuk memotivasi perjalanan membaca Anda.</p>
        </div>
        <div class="motivasi-grid">
            <?php foreach ($motivasi as $item): ?>
            <article class="motivasi-card">
                <blockquote>"<?= htmlspecialchars($item['quote']) ?>"</blockquote>
                <cite>- <?= htmlspecialchars($item['author']) ?></cite>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="benefits">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Manfaat</span>
            <h2 class="section-title">Keajaiban di Balik Setiap Buku</h2>
        </div>
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-num">01</div>
                <h3>Memperluas Wawasan</h3>
                <p>Setiap buku membuka pintu ke pengetahuan baru, budaya berbeda, dan perspektif yang lebih luas.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-num">02</div>
                <h3>Mengasah Pikiran</h3>
                <p>Membaca melatih otak untuk berpikir kritis, analitis, dan kreatif dalam menghadapi tantangan hidup.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-num">03</div>
                <h3>Mengurangi Stres</h3>
                <p>Menyelami cerita dalam buku adalah cara terbaik untuk bersantai dan melupakan kepenatan sehari-hari.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-num">04</div>
                <h3>Investasi Diri</h3>
                <p>Pengetahuan dari buku adalah aset yang tidak akan pernah hilang dan terus memberi manfaat seumur hidup.</p>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($categoryCounts)): ?>
<section class="categories-preview">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Kategori</span>
            <h2 class="section-title">Jelajahi Koleksi</h2>
        </div>
        <div class="category-pills category-pills--center reveal">
            <?php foreach ($categoryCounts as $cat => $count): ?>
            <a href="katalog.php?cat=<?= urlencode($cat) ?>" class="category-pill">
                <?= htmlspecialchars($cat) ?>
                <span><?= $count ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($featuredBooks)): ?>
<section class="featured">
    <div class="container">
        <div class="section-header section-header--row">
            <div>
                <span class="section-tag">Koleksi</span>
                <h2 class="section-title">E-book Pilihan</h2>
            </div>
            <a href="katalog.php" class="btn btn-outline">Lihat Semua (<?= $totalBooks ?>)</a>
        </div>
        <div class="book-grid">
            <?php foreach ($featuredBooks as $book): ?>
            <?php include '../includes/book-card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="cta">
    <div class="container">
        <div class="cta-box">
            <h2>Siap Memulai Perjalanan Membaca?</h2>
            <p>Jelajahi koleksi E-book PDF kami dan temukan buku favorit Anda hari ini.</p>
            <a href="katalog.php" class="btn btn-primary btn-lg">Buka Katalog</a>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>