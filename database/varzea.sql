-- Active: 1703730527497@@127.0.0.1@5432@varzea_db
CREATE DATABASE varzea_db;

\c

CREATE TABLE IF NOT EXISTS users(
    id SERIAL NOT NULL PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users(name, email, password) VALUES ('admin', 'admin@example.com', '$2y$10$v2Y9D0iWZ7HKVnnC61sH4eAn23x8n.YdcoDJXwYOO0hqdcxfOLtvC');

CREATE TABLE IF NOT EXISTS teams(
    id BIGSERIAL NOT NULL PRIMARY KEY,
    points_team INT NOT NULL,
    games_team INT NOT NULL,
    name_team VARCHAR(100) NOT NULL UNIQUE,
    victory_team INT NOT NULL,
    draw_team INT NOT NULL,
    lost_team INT NOT NULL
);

CREATE TABLE IF NOT EXISTS games(
    id BIGSERIAL NOT NULL PRIMARY KEY,
    id_home BIGINT NOT NULL,
    id_visitor BIGINT NOT NULL,
    home_gols INT NOT NULL,
    visitor_gols INT NOT NULL,
    date DATE NOT NULL,
    group_name VARCHAR(100) NOT NULL,
    hour TIME NOT NULL,
    FOREIGN KEY (id_home) REFERENCES teams(id),
    FOREIGN KEY (id_visitor) REFERENCES teams(id)
);
