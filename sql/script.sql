create database niggod;
use niggod;

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE post(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
text_content varchar(500),
image_content varchar(500),
posted_at DATETIME DEFAULT CURRENT_TIMESTAMP,
user_id int not null,
constraint user_post_id foreign key (user_id) references users(id)
);
SELECT text_content, image_content, username, posted_at FROM post INNER JOIN users ON users.id = post.user_id ORDER BY posted_at DESC;
delete from post;
