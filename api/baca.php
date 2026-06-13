<?php
require_once 'config.php';

$id = trim($_GET['id'] ?? '');
$book = $id ? getBookById($id) : null;

if (!$book) {
    header('Location: katalog.php');
    exit;
}

$idDrive = $book['id_drive'] ?? '';
$previewUrl = getDrivePreviewUrl($idDrive);
$hasDrive = !empty($previewUrl);

$pageTitle = $book['title'];

// PERBAIKAN: Jalur dirubah mundur satu tingkat ke root folder
require_once '../includes/header.php';
?>

<section class="reader-header">
    <div class="container reader-layout">
        <a href="katalog.php" class="back-link">← Kembali ke Katalog</a>
        <div class="reader-top">
            <div class="reader-cover-wrap">
                <?php if (!empty($idDrive)): ?>
                <img
                    src="https://docs.google.com/uc?export=view&id=<?= urlencode($idDrive) ?>"
                    alt="Cover <?= htmlspecialchars($book['title']) ?>"
                    onerror="this.onerror=null;this.src='assets/images/default-cover.svg';"
                >
                <?php else: ?>
                <img src="assets/images/default-cover.svg" alt="Cover default">
                <?php endif; ?>
            </div>
            <div class="reader-meta">
                <span class="book-category"><?= htmlspecialchars($book['category'] ?? 'Umum') ?></span>
                <h1 class="reader-title"><?= htmlspecialchars($book['title']) ?></h1>
                <p class="reader-author">oleh <?= htmlspecialchars($book['author'] ?? '-') ?></p>
                <?php if ($hasDrive): ?>
                <p class="reader-note">Baca langsung dari Google Drive di <?= htmlspecialchars(APP_NAME) ?>. Unduh tidak tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="reader">
    <div class="container">
        <?php if (!$hasDrive): ?>
        <div class="empty-state">
            <h3>E-book Tidak Tersedia</h3>
            <p>ID Google Drive tidak ditemukan untuk buku ini.</p>
            <a href="katalog.php" class="btn btn-primary">Kembali</a>
        </div>
        <?php else: ?>
        <div class="pdf-viewer">
            <iframe
                src="<?= htmlspecialchars($previewUrl) ?>"
                title="<?= htmlspecialchars($book['title']) ?>"
                class="pdf-frame"
                allow="autoplay"
            ></iframe>
        </div>
        <?php if (!empty($book['description'])): ?>
        <div class="reader-description">
            <h3>Tentang Buku</h3>
            <p><?= nl2br(htmlspecialchars($book['description'])) ?></p>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>