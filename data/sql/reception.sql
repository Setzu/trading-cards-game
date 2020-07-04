DROP TABLE reception;

CREATE TABLE IF NOT EXISTS reception (
  id int(5) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_user int NOT NULL,
  sender char(50) NOT NULL,
  header char(255),
  content char(255) NOT NULL,
  readed int(1) DEFAULT 0,
  id_attachment int NOT NULL DEFAULT 0,
  collected int(1) DEFAULT 0,
  date_reception TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;