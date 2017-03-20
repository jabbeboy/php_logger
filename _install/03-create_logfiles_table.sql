CREATE TABLE `logger`.`logfiles` (
    id INT NOT NULL AUTO_INCREMENT,
    session_id VARCHAR (255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    date_time DATETIME,
    html BLOB,
    PRIMARY KEY(id)
);
