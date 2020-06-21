DROP TABLE boxmails;

CREATE TABLE IF NOT EXISTS boxmails (
  id int(5) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_user int NOT NULL,
  header char(255),
  content char(255) NOT NULL,
  watched int(1) DEFAULT 0,
  attachment int(1) DEFAULT 0,
  date_reception TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;