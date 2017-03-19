CREATE TABLE `template`.`users` (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password CHAR(64) NOT NULL,
    salt CHAR(16) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE KEY username(username),
    UNIQUE KEY email(email)
);