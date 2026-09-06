<?php
/** Tampilan cover buku (CSS only, tanpa load PDF/gambar) */
$colors = $book['colors'] ?? getCategoryColors($book['category'] ?? 'Umum');
$initial = mb_strtoupper(mb_substr($book['title'] ?? 'B', 0, 1));
$shortTitle = truncateTitle($book['title'] ?? '', 55);
?>
<div class="book-cover-view" style="--cv1:<?= $colors[0] ?>;--cv2:<?= $colors[1] ?>;" aria-hidden="true">
    <span class="book-cover-view__spine"></span>
    <span class="book-cover-view__tag"><?= htmlspecialchars($book['category'] ?? 'Umum') ?></span>
    <span class="book-cover-view__initial"><?= htmlspecialchars($initial) ?></span>
    <p class="book-cover-view__title"><?= htmlspecialchars($shortTitle) ?></p>
    <span class="book-cover-view__fmt">E-book</span>
</div>
