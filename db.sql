ALTER DATABASE epiz_33567965_es CHARACTER SET utf8 COLLATE utf8_unicode_ci

CREATE TABLE words (
    id INT NOT NULL AUTO_INCREMENT,
    es_name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
    ru_name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into words values(1,"la ventana","окно");