<?php
require_once __DIR__ . '/config.php';

$pageTitle = 'Dashboard';
$books = getBooks();
$featuredBooks = getFeaturedBooks();
$categoryCounts = getCategoryCounts();
$totalBooks = count($books);
$randomMotivasi = $motivasi[array_rand($motivasi)];

require_once __DIR__ . '/../includes/header.php';
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="content-header-inner">
        <h1>
            Dashboard
            <small>Control panel perpustakaan digital</small>
        </h1>
        <div class="date-picker-mock">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <span>2020-11-26 - <?= date('Y-m-d') ?></span>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    
    <!-- Update alert banner -->
    <div class="alert alert-cyan">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <span>Terakhir di perbaharui : <?= date('d M Y') ?> Jam : <?= date('H:i:s') ?></span>
    </div>

    <!-- Small boxes (Stat cards row) -->
    <div class="row small-box-row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box aqua -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>Peringkat 0</h3>
                    <p>Total Pembaca : 3</p>
                </div>
                <div class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <a href="katalog.php" class="small-box-footer">More info <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box purple -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>Peringkat 0</h3>
                    <p>Total Durasi : 14 Jam</p>
                </div>
                <div class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <a href="katalog.php" class="small-box-footer">More info <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box red -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>Peringkat 0</h3>
                    <p>Total Sirkulasi : <?= $totalBooks ?></p>
                </div>
                <div class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </div>
                <a href="katalog.php" class="small-box-footer">More info <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box orange -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3><?= $totalBooks ?> Buku</h3>
                    <p>SIRKULASI BUKU di BACA : 7</p>
                </div>
                <div class="icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                </div>
                <a href="katalog.php" class="small-box-footer">More info <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></a>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Row 1 -->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Total Durasi Baca Terlama (Bulan ini)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/></svg></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="info-blocks-grid">
                        <div class="info-tile bg-tile-blue">
                            <div class="tile-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            </div>
                            <div class="tile-content">
                                <span class="tile-sub">TOTAL MEMBER</span>
                                <span class="tile-main">30</span>
                                <span class="tile-note">2 Pendaftar Baru</span>
                            </div>
                        </div>

                        <div class="info-tile bg-tile-green">
                            <div class="tile-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                            </div>
                            <div class="tile-content">
                                <span class="tile-sub">JUMLAH PEMBACA</span>
                                <span class="tile-main">3</span>
                                <span class="tile-note">0 Pembaca Aktif Hari Ini</span>
                            </div>
                        </div>

                        <div class="info-tile bg-tile-orange">
                            <div class="tile-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            </div>
                            <div class="tile-content">
                                <span class="tile-sub">SIRKULASI BUKU di BACA</span>
                                <span class="tile-main">7</span>
                                <span class="tile-note">Koleksi Terpopuler</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Total Sirkulasi Konten Terbanyak</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/></svg></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="category-pills-list">
                        <?php foreach ($categoryCounts as $cat => $count): ?>
                        <a href="katalog.php?cat=<?= urlencode($cat) ?>" class="cat-badge-item">
                            <span class="cat-name"><?= htmlspecialchars($cat) ?></span>
                            <span class="badge bg-blue"><?= $count ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Member Status Row -->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Member Belum Aktif</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/></svg></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
                    </div>
                </div>
                <div class="box-body">
                    <p class="text-muted">Tidak ada member yang menunggu verifikasi saat ini.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Member Aktif</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/></svg></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="active-member-item">
                        <img src="../assets/images/user-logo.png" alt="User" class="member-thumb">
                        <div class="member-details">
                            <strong>deepublish.ds@gmail.com</strong>
                            <small class="text-success">● Aktif / Administrator</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Buku Rekomendasi Kami & E-Book Pilihan -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Buku Rekomendasi Kami</h3>
                    <div class="box-tools pull-right">
                        <a href="katalog.php" class="btn btn-xs btn-primary">Lihat Semua Katalog (<?= $totalBooks ?>)</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="book-grid">
                        <?php foreach ($featuredBooks as $book): ?>
                        <?php include __DIR__ . '/../includes/book-card.php'; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
 