CREATE DATABASE IF NOT EXISTS anime;

SHOW DATABASES;

USE anime;

CREATE TABLE users (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    username  VARCHAR(225) NOT NULL,
    email     VARCHAR(75)  NOT NULL UNIQUE,
    join_date DATE
);

DESCRIBE users;

INSERT INTO users (username, email, join_date) VALUES
('www',         'www@gmail.com',         '2026-09-14'),
('qqq',         'qqq@gmail.com',         '2026-09-14'),
('ming',        'ming@gmail.com',        '2025-11-27'),
('jelee',       'jelee@gmail.com',       '2025-06-24'),
('hoomannnnnn', 'hoomannnnnn@gmail.com', '2022-11-27'),
('JJJES',       'jjjes@gmail.com',       '2020-01-01');

SELECT * FROM users;

CREATE TABLE animes (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    title         VARCHAR(225) NOT NULL,
    studio        VARCHAR(100),
    episode_count INT,
    status        VARCHAR(20)
);

DESCRIBE animes;

INSERT INTO animes(title, studio, episode_count, status) VALUES
('Naruto', 'Pierrot', 220, 'Completed'),
('One Piece', 'Toei Animation', 1100, 'Ongoing'),
('Demon Slayer', 'Ufotable', 55, 'Ongoing'),
('Attack on Titan', 'MAPPA', 89, 'Upcoming'),
('My Hero Academia', 'Bones', 159, 'Ongoing'),
('Jujutsu Kaisen', 'MAPPA', 47, 'Upcoming'),
('Death Note', '	Madhouse', 37, 'Completed'),
('Spy x Family', 'Wit Studio', 37, 'Ongoing');

SELECT * FROM animes;

CREATE TABLE genre (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    genre_name VARCHAR(225) NOT NULL UNIQUE
);

DESCRIBE genre;

INSERT INTO genre (genre_name) VALUES
('Action'), 
('Adventure'),
('Fantasy'), 
('Dark Fantasy'),
('Drama'),  
('Superhero'), 
('Supernatural'),  
('Mystery'), 
('Psychological Thriller'),
('Comedy'),  
('Spy');

SELECT * FROM genre;

CREATE TABLE anime_genre (
    anime_id INT NOT NULL,
    genre_id INT NOT NULL,
    PRIMARY KEY (anime_id, genre_id),
    FOREIGN KEY (anime_id) REFERENCES animes(id),
    FOREIGN KEY (genre_id) REFERENCES genre(id)  
);

INSERT INTO anime_genre (anime_id, genre_id) VALUES
(1, 1), (1, 2), (1, 3),          -- Naruto: Action, Adventure, Fantasy
(2, 1), (2, 2), (2, 3),          -- One Piece: Action, Adventure, Fantasy
(3, 1), (3, 4),                  -- Demon Slayer: Action, Dark Fantasy
(4, 1), (4, 4), (4, 5),          -- Attack on Titan: Action, Dark Fantasy, Drama
(5, 1), (5, 3), (5, 6),          -- My Hero Academia: Action, Fantasy, Superhero
(6, 1), (6, 7), (6, 4),          -- Jujutsu Kaisen: Action, Supernatural, Dark Fantasy
(7, 9), (7, 7), (7, 8),          -- Death Note: Psych. Thriller, Supernatural, Mystery
(8, 1), (8, 10), (8, 11);        -- Spy x Family: Action, Comedy, Spy
     
SELECT * FROM anime_genre;    

CREATE TABLE review (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT NOT NULL,
    anime_id    INT NOT NULL,
    rating      DECIMAL(3,1) NOT NULL,
    comment     VARCHAR(500),
    review_date DATE,
    FOREIGN KEY (user_id)  REFERENCES users(id),
    FOREIGN KEY (anime_id) REFERENCES animes(id)
);

INSERT INTO review (user_id, anime_id, rating, comment, review_date) VALUES
(1, 1, 8.3, 'An exciting story about friendship, determination, and becoming a great ninja.', '2026-09-01'),
(1, 2, 9.0, 'A fun and emotional adventure with memorable characters and an expansive world.', '2026-09-03'),
(1, 4, 9.1, 'A gripping and unpredictable story filled with mystery, sacrifice, and plot twists.', '2026-09-07'),
(1, 7, 8.9, 'A clever and suspenseful battle of intelligence between two determined characters.', '2026-09-13'),
(2, 3, 8.6, 'Beautiful animation with intense battles and an emotional storyline.', '2026-09-05'),
(2, 6, 8.6, 'Fast-paced battles, strong characters, and an engaging supernatural world.', '2026-09-11'),
(3, 1, 7.5, 'Good arcs overall, but the filler episodes really slow things down.', '2026-08-20'),
(3, 4, 9.4, 'Every season raises the stakes. The ending left me speechless.', '2026-08-22'),
(4, 7, 9.2, 'The first half is near perfect. One of the smartest anime ever written.', '2026-07-30'),
(4, 3, 8.8, 'Ufotable animation is on another level, especially the fight choreography.', '2026-08-02'),
(5, 2, 7.8, 'I love it, but 1100 episodes is a serious commitment for a newcomer.', '2026-06-15'),
(5, 6, 9.0, 'Great villains and an excellent soundtrack. Season two was a highlight.', '2026-06-18'),
(6, 4, 8.7, 'Dark, heavy, and thought-provoking. Not an easy watch, but worth it.', '2026-05-09');

SELECT * FROM review;

