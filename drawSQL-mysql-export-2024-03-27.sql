CREATE TABLE `Image`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT NOT NULL,
    `contenue` JSON NOT NULL
);
CREATE TABLE `Filtre`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL
);
CREATE TABLE `User`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` CHAR(255) NOT NULL,
    `mot de passe` CHAR(255) NOT NULL,
    `name` CHAR(255) NOT NULL
);
CREATE TABLE `Sequence`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `image_id` BIGINT NOT NULL,
    `operation_id` BIGINT NOT NULL,
    `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE `Effet`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `Sequence` ADD CONSTRAINT `sequence_image_id_foreign` FOREIGN KEY(`image_id`) REFERENCES `Image`(`id`);
ALTER TABLE
    `Image` ADD CONSTRAINT `image_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `User`(`id`);
ALTER TABLE
    `Sequence` ADD CONSTRAINT `sequence_operation_id_foreign` FOREIGN KEY(`operation_id`) REFERENCES `Filtre`(`id`);
ALTER TABLE
    `Sequence` ADD CONSTRAINT `sequence_operation_id_foreign` FOREIGN KEY(`operation_id`) REFERENCES `Effet`(`id`);