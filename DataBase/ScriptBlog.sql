-- Create 'users' table
CREATE TABLE users (
    id INT(255) AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    CONSTRAINT pk_users PRIMARY KEY (id),
    CONSTRAINT uq_email UNIQUE (email)
) ENGINE=InnoDB;

-- Create 'categories' table
CREATE TABLE categories (
    id INT(255) AUTO_INCREMENT NOT NULL,
    name VARCHAR(100),
    CONSTRAINT pk_categories PRIMARY KEY (id)
) ENGINE=InnoDB;

-- Create 'entries' table
CREATE TABLE entries (
    id INT(255) AUTO_INCREMENT NOT NULL,
    user_id INT(255) NOT NULL,
    category_id INT(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description MEDIUMTEXT,
    date DATE NOT NULL,
    CONSTRAINT pk_entries PRIMARY KEY (id),
    CONSTRAINT fk_entry_user FOREIGN KEY (user_id) REFERENCES users (id),
    CONSTRAINT fk_entry_category FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE NO ACTION
) ENGINE=InnoDB;

-- Create 'blog-videogames' database
CREATE DATABASE IF NOT EXISTS `blog-videogames` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `blog-videogames`;
