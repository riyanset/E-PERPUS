<?php
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
$userName = 'Mas Riy';
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
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Top Main Header -->
    <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
            <span class="logo-mini">
                <img src="../assets/images/user-logo.png" alt="Logo" class="logo-img-mini">
            </span>
            <span class="logo-lg">
                <img src="../assets/images/user-logo.png" alt="Logo" class="logo-img">
                <span class="logo-text"><?= htmlspecialchars(APP_NAME) ?></span>
            </span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle navigation">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="navbar-custom-title">
                <span>E-Perpus Mas Riy @ Perpustakaan Digital Pribadi</span>
            </div>

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="index.php" class="dropdown-toggle">
                            <img src="../assets/images/user-logo.png" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= htmlspecialchars($userName) ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="../assets/images/user-logo.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?= htmlspecialchars($userName) ?></p>
                    <a href="#"><span class="status-indicator online"></span> Online</a>
                </div>
            </div>

            <!-- search form -->
            <form action="katalog.php" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Cari buku...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </button>
                    </span>
                </div>
            </form>

            <!-- sidebar menu -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="<?= $currentPage === 'index' ? 'active' : '' ?>">
                    <a href="index.php">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="<?= $currentPage === 'katalog' ? 'active' : '' ?>">
                    <a href="katalog.php">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        <span>Katalog Buku</span>
                    </a>
                </li>
                <li>
                    <a href="index.php#motivasi">
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <span>Motivasi</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Mobile Quick Nav (Tampil Jelas di HP / Smartphone) -->
        <div class="mobile-quick-nav">
            <a href="index.php" class="mobile-nav-item <?= $currentPage === 'index' ? 'active' : '' ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                <span>Beranda</span>
            </a>
            <a href="katalog.php" class="mobile-nav-item <?= $currentPage === 'katalog' ? 'active' : '' ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                <span>Katalog Buku</span>
            </a>
            <a href="index.php#motivasi" class="mobile-nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                <span>Motivasi</span>
            </a>
        </div>

