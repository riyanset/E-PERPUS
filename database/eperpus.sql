-- ============================================================
--  E-Perpus Mas Riy — Skema Database (login & daftar pembaca)
--  Cara pakai:
--   1. Buat database MySQL baru di panel hosting (terpisah dari
--      database aplikasi booking).
--   2. Buka phpMyAdmin database itu, tab "Import", pilih file
--      ini, klik "Go" / "Kirim".
--   3. Isi DB_HOST, DB_NAME, DB_USER, DB_PASS di api/config.php
--      sesuai data database yang baru dibuat.
-- ============================================================

CREATE TABLE IF NOT EXISTS `users` (
  `id`            VARCHAR(36)   NOT NULL,
  `username`      VARCHAR(50)   NOT NULL,
  `password_hash` VARCHAR(255)  NOT NULL,
  `name`          VARCHAR(100)  NOT NULL,
  `created_at`    DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tidak ada akun bawaan — silakan daftar akun sendiri lewat
-- halaman register.php setelah website berjalan.
