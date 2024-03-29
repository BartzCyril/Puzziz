CREATE TABLE `Filtre`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL,
    `poids` BIGINT NOT NULL
);
CREATE TABLE `Sequence`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `image_id` BIGINT NOT NULL,
    `operation_id` BIGINT NOT NULL,
    `operation_type` ENUM('') NOT NULL COMMENT 'ENUM(\'Filtre\', \'Effet\')',
    `challenge_id` BIGINT NOT NULL
);
CREATE TABLE `Image`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `utilisateur_id` BIGINT NOT NULL,
    `lien_image` VARCHAR(255) NOT NULL,
    `image_origine_id` BIGINT NOT NULL,
    `challenge_id` BIGINT NOT NULL,
    `modifiable` TINYINT(1) NOT NULL
);
CREATE TABLE `Utilisateur`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` CHAR(255) NOT NULL,
    `mot de passe` CHAR(255) NOT NULL,
    `nom` CHAR(255) NOT NULL
);
CREATE TABLE `Effet`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL,
    `poids` BIGINT NOT NULL
);
CREATE TABLE `Challenge`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `code_jeu` BIGINT NOT NULL,
    `date` DATETIME NOT NULL
);
ALTER TABLE
    `Image` ADD CONSTRAINT `image_utilisateur_id_foreign` FOREIGN KEY(`utilisateur_id`) REFERENCES `Utilisateur`(`id`);
ALTER TABLE
    `Sequence` ADD CONSTRAINT `sequence_challenge_id_foreign` FOREIGN KEY(`challenge_id`) REFERENCES `Challenge`(`id`);
ALTER TABLE
    `Sequence` ADD CONSTRAINT `sequence_operation_id_foreign` FOREIGN KEY(`operation_id`) REFERENCES `Effet`(`id`);
ALTER TABLE
    `Image` ADD CONSTRAINT `image_challenge_id_foreign` FOREIGN KEY(`challenge_id`) REFERENCES `Challenge`(`id`);
ALTER TABLE
    `Sequence` ADD CONSTRAINT `sequence_operation_id_foreign` FOREIGN KEY(`operation_id`) REFERENCES `Filtre`(`id`);
ALTER TABLE
    `Sequence` ADD CONSTRAINT `sequence_image_id_foreign` FOREIGN KEY(`image_id`) REFERENCES `Image`(`id`);