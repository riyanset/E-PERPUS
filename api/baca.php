<?php
require_once __DIR__ . '/config.php';
requireLogin();

$id = trim($_GET['id'] ?? '');
$book = $id ? getBookById($id) : null;

if (!$book) {
    header('Location: katalog.php');
    exit;
}

$idDrive = $book['id_drive'] ?? '';
$previewUrl = getDrivePreviewUrl($idDrive);
$hasDrive = !empty($previewUrl);

$pageTitle = 'Membaca - ' . $book['title'];

require_once __DIR__ . '/../includes/header.php';
?>

<!-- Content Header -->
<section class="content-header">
    <div class="content-header-inner">
        <h1>
            Pembaca E-Book
            <small><?= htmlspecialchars($book['title']) ?></small>
        </h1>
        <a href="katalog.php" class="btn btn-default btn-sm">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;display:inline-block;vertical-align:middle;margin-right:4px;"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali ke Katalog
        </a>
    </div>
</section>

<!-- Main content -->
<section class="content">
    
    <!-- Reader Controls Bar -->
    <div class="box box-primary">
        <div class="box-body reader-controls-bar">
            <div class="reader-meta-summary">
                <span class="badge bg-blue"><?= htmlspecialchars($book['category'] ?? 'Umum') ?></span>
                <strong class="reader-book-title"><?= htmlspecialchars($book['title']) ?></strong>
                <span class="reader-author-name">oleh <?= htmlspecialchars($book['author'] ?? '-') ?></span>
            </div>
            
            <div class="reader-view-actions">
                <button type="button" class="btn btn-phone-view active" id="btnPhoneView">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                    <span>📱 View Full Layar Handphone</span>
                </button>
                <button type="button" class="btn btn-desktop-view" id="btnDesktopView">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    <span>🖥️ Mode Desktop</span>
                </button>
            </div>
        </div>
    </div>

    <?php if (!$hasDrive): ?>
    <div class="box box-danger">
        <div class="box-body text-center empty-state">
            <h3>E-book Tidak Tersedia</h3>
            <p>ID Google Drive belum dikonfigurasi untuk buku ini.</p>
            <a href="katalog.php" class="btn btn-primary">Kembali ke Katalog</a>
        </div>
    </div>
    <?php else: ?>
    
    <!-- Smartphone / Handphone Mockup Container -->
    <div class="phone-reader-wrapper" id="phoneReaderWrapper">
        
        <!-- Mobile View Header Bar (for fullscreen mode) -->
        <div class="phone-fullscreen-bar" id="phoneFullscreenBar">
            <div class="phone-bar-title">
                <span>📱 Mode Full Layar Handphone</span>
            </div>
            <button type="button" class="btn btn-xs btn-danger" id="btnClosePhoneFullscreen">
                ❌ Keluar Layar Penuh HP
            </button>
        </div>

        <div class="smartphone-frame" id="smartphoneFrame">
            <!-- Side buttons decoration -->
            <div class="phone-button phone-button-volume-up"></div>
            <div class="phone-button phone-button-volume-down"></div>
            <div class="phone-button phone-button-power"></div>

            <!-- Smartphone Screen -->
            <div class="smartphone-screen">
                <!-- Phone Status Bar -->
                <div class="phone-status-bar">
                    <span class="phone-time" id="phoneClock">09:41</span>
                    <div class="phone-notch">
                        <span class="camera-lens"></span>
                        <span class="speaker-grille"></span>
                    </div>
                    <div class="phone-icons">
                        <svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px;"><path d="M12 3c-4.97 0-9 4.03-9 9 0 2.12.74 4.07 1.97 5.61L4.35 19.4a1 1 0 0 0 1.25 1.25l1.79-.62C8.93 20.26 10.88 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9z"/></svg>
                        <svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px;"><path d="M12 4C7.31 4 3.07 5.9 0 8.98L12 21 24 8.98C20.93 5.9 16.69 4 12 4z"/></svg>
                        <svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px;"><path d="M15.67 4H14V2h-4v2H8.33C7.6 4 7 4.6 7 5.33v15.33C7 21.4 7.6 22 8.33 22h7.33c.74 0 1.34-.6 1.34-1.33V5.33C17 4.6 16.4 4 15.67 4z"/></svg>
                    </div>
                </div>

                <!-- PDF Viewport -->
                <div class="pdf-viewer" id="pdfViewer">
                    <iframe
                        src="<?= htmlspecialchars($previewUrl) ?>"
                        title="<?= htmlspecialchars($book['title']) ?>"
                        class="pdf-frame"
                        allow="autoplay"
                        id="pdfIframe"
                    ></iframe>
                    <!-- Overlay transparan memblokir cetak & unduh GDrive -->
                    <div class="pdf-viewer-overlay"></div>
                </div>

                <!-- Phone Home Indicator Bar -->
                <div class="phone-home-bar">
                    <span class="home-indicator"></span>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($book['description'])): ?>
    <div class="box box-info" style="margin-top: 20px;">
        <div class="box-header with-border">
            <h3 class="box-title">Tentang Buku Ini</h3>
        </div>
        <div class="box-body">
            <p><?= nl2br(htmlspecialchars($book['description'])) ?></p>
        </div>
    </div>
    <?php endif; ?>

    <?php endif; ?>

</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>