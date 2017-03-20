### MySQL Queries

1. Create database for the application

``CREATE DATABASE IF NOT EXISTS `logger`;``

2. Create user table 

``CREATE TABLE `logger`.`users` (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password CHAR(64) NOT NULL,
    salt CHAR(16) NOT NULL,
    PRIMARY KEY(id),
    UNIQUE KEY username(username),
    UNIQUE KEY email(email));``
    
3. Create table for logfiles
    
``CREATE TABLE `logger`.`logfiles` (
      id INT NOT NULL AUTO_INCREMENT,
      session_id VARCHAR (255) NOT NULL,
      address VARCHAR(255) NOT NULL,
      date_time DATETIME,
      html BLOB,
      PRIMARY KEY(id)
  );``
  
4. Insert test admin 

**Username: user123**

**Password: userpass**

``INSERT INTO `logger`.`users` (
  username,
  email,
  password,
  salt
)
VALUES (
  'user123',
  'user123@domain.com',
  '7d1962c61aa304416bf39b86d75609bb02e3916656e6aafefebdaf4f20f877d2',
  '352af1187cecfb66'
);``






