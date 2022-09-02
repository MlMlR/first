USE `main`;

CREATE TABLE `container_management` (
                                        `code` VARCHAR(12) NOT NULL,
                                        `size` INT NULL DEFAULT 0,
                                        PRIMARY KEY (`code`)
)
    COLLATE='utf8mb4_unicode_ci'
;
