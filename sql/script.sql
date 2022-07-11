create database niggod;
use niggod;

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    profile_picture varchar(500) default "defaultPfP.jpg",
    bio varchar(500) default "Use this space to tell the world about yourself."
);

CREATE TABLE post(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
text_content varchar(500),
image_content varchar(500),
posted_at DATETIME DEFAULT CURRENT_TIMESTAMP,
user_id int not null,
constraint user_post_id foreign key (user_id) references users(id)
);

CREATE TABLE friend(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
user1 int not null,
user2 int not null,
user1_confirm bit,
user2_confirm bit
);