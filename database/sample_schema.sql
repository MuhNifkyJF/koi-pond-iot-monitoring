-- MySQL/MariaDB sample database for local development.
-- All values below are synthetic.

SET NAMES utf8mb4;

CREATE TABLE tb_user (
    id_user INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(80) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_level TINYINT UNSIGNED NOT NULL DEFAULT 1,
    PRIMARY KEY (id_user),
    UNIQUE KEY uq_tb_user_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tb_tampilan (
    id_tampilan BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    suhu DECIMAL(5,2) NOT NULL,
    kadar_ph DECIMAL(4,2) NOT NULL,
    sensor_dht DECIMAL(5,2) NOT NULL,
    tanggal TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_tampilan),
    KEY idx_tb_tampilan_tanggal (tanggal)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password: KoiDemo!2026
INSERT INTO tb_user (username, password, user_level) VALUES
    ('admin_koi', '$2y$10$M16skMbDyE3A6.sNqE311OUPybHjdmXQ2sAugk7d4TuX9cUOMUhhy', 1);

INSERT INTO tb_tampilan (suhu, kadar_ph, sensor_dht, tanggal) VALUES
    (26.40, 7.10, 28.20, '2026-08-20 08:00:00'),
    (26.55, 7.08, 28.40, '2026-08-20 08:05:00'),
    (26.70, 7.05, 28.60, '2026-08-20 08:10:00'),
    (26.65, 7.12, 28.50, '2026-08-20 08:15:00'),
    (26.50, 7.15, 28.30, '2026-08-20 08:20:00');
