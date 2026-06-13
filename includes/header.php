<?php
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? APP_NAME) ?> - <?= htmlspecialchars(APP_NAME) ?></title>
    <meta name="description" content="<?= htmlspecialchars(APP_TAGLINE) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a href="/api/index.php" class="brand">
                <span class="brand-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                </span>
                <div class="brand-text">
                    <span class="brand-title"><?= htmlspecialchars(APP_NAME) ?></span>
                    <span class="brand-sub"><?= htmlspecialchars(APP_TAGLINE) ?></span>
                </div>
            </a>
            <nav class="main-nav" id="mainNav">
                <a href="/api/index.php" class="nav-link <?= $currentPage === 'index' ? 'active' : '' ?>">Beranda</a>
                <a href="/api/katalog.php" class="nav-link <?= $currentPage === 'katalog' ? 'active' : '' ?>">Katalog</a>
                <a href="/api/index.php#motivasi" class="nav-link">Motivasi</a>
            </nav>
            <button class="nav-toggle" id="navToggle" aria-label="Menu"><span></span><span></span><span></span></button>
        </div>
    </header>
    <main class="site-main">