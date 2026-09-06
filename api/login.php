<?php
require_once __DIR__ . '/config.php';

// Kalau sudah login, langsung lempar ke katalog (atau tujuan semula).
$redirect = $_GET['redirect'] ?? 'katalog.php';
if (currentUser()) {
    header('Location: ' . $redirect);
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = (string) ($_POST['password'] ?? '');
    $redirect = $_POST['redirect'] ?: 'katalog.php';

    if ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi.';
    } else {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM `users` WHERE `username` = :u LIMIT 1");
        $stmt->execute([':u' => $username]);
        $row = $stmt->fetch();

        if (!$row || !password_verify($password, $row['password_hash'])) {
            $error = 'Username atau password salah.';
        } else {
            $_SESSION['user_id']  = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['name']     = $row['name'];
            header('Location: ' . $redirect);
            exit;
        }
    }
}

$pageTitle = 'Masuk';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="auth-section">
    <div class="container auth-container">
        <div class="auth-card">
            <span class="section-tag">Selamat Datang Kembali</span>
            <h1 class="auth-title">Masuk ke Akun Anda</h1>
            <p class="auth-desc">Masuk dulu untuk mulai membaca koleksi e-book di <?= htmlspecialchars(APP_NAME) ?>.</p>

            <?php if ($error): ?>
            <div class="auth-alert"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post" class="auth-form">
                <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">
                <label class="auth-label">
                    Username
                    <input type="text" name="username" class="auth-input" placeholder="Masukan username" required autofocus value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                </label>
                <label class="auth-label">
                    Password
                    <input type="password" name="password" class="auth-input" placeholder="Masukan password" required>
                </label>
                <button type="submit" class="btn btn-primary auth-submit">Masuk</button>
            </form>

            <p class="auth-switch">Belum punya akun? <a href="register.php?redirect=<?= urlencode($redirect) ?>">Daftar di sini</a></p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
