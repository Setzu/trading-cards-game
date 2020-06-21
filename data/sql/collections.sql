DROP TABLE collections;

CREATE TABLE IF NOT EXISTS collections (
  id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_card int NOT NULL,
  pack int NOT NULL,
  id_user int NOT NULL,
  quantity int NOT NULL DEFAULT 0,
  prism tinyint(1) NOT NULL DEFAULT 0,
  date_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
