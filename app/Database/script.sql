CREATE DATABASE wiki;



CREATE TABLE roles (
    id int PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50)
);



CREATE TABLE users (
    id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(255),
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(255),
    password VARCHAR(255),
    role_id int,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE ON UPDATE CASCADE
    );

    
CREATE TABLE categories (
    id int PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50)
);


CREATE TABLE wikis (
    id int PRIMARY KEY AUTO_INCREMENT,
    image varchar(255) DEFAULT NULL,
    title VARCHAR(255),
    centent VARCHAR(255),
    creation_date date,
    statut int DEFAULT NULL,
     categorie_id int,
     user_id int,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE tags (
    id int PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    description VARCHAR(255)
);


CREATE TABLE tag_wiki (
    id int PRIMARY KEY AUTO_INCREMENT,
    tag_id int,
    wiki_id int,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (wiki_id) REFERENCES wikis(id) ON DELETE CASCADE ON UPDATE CASCADE
);