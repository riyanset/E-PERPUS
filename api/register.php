<?php
require_once __DIR__ . '/config.php';

$redirect = $_GET['redirect'] ?? 'katalog.php';
if (currentUser()) {
    header('Location: ' . $redirect);
    exit;
}

function uuidv4() {
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = (string) ($_POST['password'] ?? '');
    $redirect = $_POST['redirect'] ?: 'katalog.php';

    if ($name === '' || $username === '' || $password === '') {
        $error = 'Nama, username, dan password wajib diisi.';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter.';
    } elseif (!preg_match('/^[a-zA-Z0-9_.]{3,30}$/', $username)) {
        $error = 'Username 3-30 karakter, hanya huruf/angka/underscore.';
    } else {
        $db = getDB();
        $check = $db->prepare("SELECT id FROM `users` WHERE `username` = :u LIMIT 1");
        $check->execute([':u' => $username]);
        if ($check->fetch()) {
            $error = 'Username sudah digunakan, silakan pilih yang lain.';
        } else {
            $id   = uuidv4();
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $db->prepare("INSERT INTO `users` (`id`, `username`, `password_hash`, `name`) VALUES (:id, :u, :p, :n)");
            $stmt->execute([':id' => $id, ':u' => $username, ':p' => $hash, ':n' => $name]);

            $_SESSION['user_id']  = $id;
            $_SESSION['username'] = $username;
            $_SESSION['name']     = $name;
            header('Location: ' . $redirect);
            exit;
        }
    }
}

$pageTitle = 'Daftar';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="auth-section">
    <div class="container auth-container">
        <div class="auth-card">
            <span class="section-tag">Gabung Sekarang</span>
            <h1 class="auth-title">Buat Akun Baru</h1>
            <p class="auth-desc">Daftar gratis untuk mulai membaca semua koleksi e-book di <?= htmlspecialchars(APP_NAME) ?>.</p>

            <?php if ($error): ?>
            <div class="auth-alert"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post" class="auth-form">
                <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">
                <label class="auth-label">
                    Nama Lengkap
                    <input type="text" name="name" class="auth-input" placeholder="Masukan nama lengkap" required autofocus value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                </label>
                <label class="auth-label">
                    Username
                    <input type="text" name="username" class="auth-input" placeholder="Masukan username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                </label>
                <label class="auth-label">
                    Password
                    <input type="password" name="password" class="auth-input" placeholder="Minimal 6 karakter" required>
                </label>
                <button type="submit" class="btn btn-primary auth-submit">Daftar</button>
            </form>

            <p class="auth-switch">Sudah punya akun? <a href="login.php?redirect=<?= urlencode($redirect) ?>">Masuk di sini</a></p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
