DROP TABLE friends;

CREATE TABLE IF NOT EXISTS friends (
  id int(5) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  id_user int(5) NOT NULL UNIQUE,
  id_friend int(5) NOT NULL,
  added_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;