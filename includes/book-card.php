<article class="book-card">
    <a href="baca.php?id=<?= urlencode($book['id']) ?>" class="book-card-link">
        <div class="book-cover">
            <div class="book-cover-container">
                <?php if (!empty($book['id_drive'])): ?>
                <?php $driveId = htmlspecialchars($book['id_drive'], ENT_QUOTES, 'UTF-8'); ?>
                <img
                    src="https://docs.google.com/uc?export=view&id=<?= $driveId ?>"
                    alt="<?= htmlspecialchars($book['title']) ?>"
                    loading="lazy"
                    decoding="async"
                    onerror="this.onerror=null;this.src='https://drive.google.com/thumbnail?authuser=0&sz=w500&id=<?= $driveId ?>';"
                >
                <?php else: ?>
                <div class="default-cover">
                    <span><?= htmlspecialchars(mb_strtoupper(mb_substr($book['title'] ?? 'B', 0, 1))) ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="book-overlay"><span class="read-btn">Baca</span></div>
        </div>
        <div class="book-info">
            <span class="book-category"><?= htmlspecialchars($book['category'] ?? 'Umum') ?></span>
            <h3 class="book-title"><?= htmlspecialchars($book['title']) ?></h3>
            <p class="book-author"><?= htmlspecialchars($book['author'] ?? '-') ?></p>
        </div>
    </a>
</article>
