DROP TABLE attachments;

CREATE TABLE IF NOT EXISTS attachments (
  id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  attachment_type int(2) NOT NULL,
  quantity char(255) NOT NULL
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;