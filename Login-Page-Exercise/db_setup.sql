CREATE DATABASE IF NOT EXISTS pdo_lesson;
USE pdo_lesson;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100),
    status TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, email, password, name, status) VALUES
('alice',   'alice@example.com',   'password123', 'Alice Smith',   1),
('bob',     'bob@example.com',     'securepass',  'Bob Johnson',   1),
('charlie', 'charlie@example.com', 'charlie99',   'Charlie Brown', 0),
('diana',   'diana@example.com',   'diana2024',   'Diana Prince',  1),
('eve',     'eve@example.com',     'evepass',     'Eve Adams',     0);
