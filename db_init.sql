DROP TABLE IF EXISTS views;
DROP TABLE IF EXISTS images;

CREATE TABLE images (
                        id BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT UNIQUE,
                        name VARCHAR(255) NOT NULL,
                        author VARCHAR(255) NOT NULL,
                        created_at DATETIME,
                        updated_at DATETIME,
                        deleted_at DATETIME
);

CREATE TABLE views (
                       id SERIAL PRIMARY KEY UNIQUE,
                       image_id BIGINT UNSIGNED NOT NULL,
                       view_count INT,
                       FOREIGN KEY(image_id) REFERENCES images(id)
);