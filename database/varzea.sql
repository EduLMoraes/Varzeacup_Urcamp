-- Active: 1703730527497@@127.0.0.1@5432@varzea_db
CREATE DATABASE varzea_db;

\c

CREATE TABLE IF NOT EXISTS users(
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS times(
    id_time BIGSERIAL NOT NULL PRIMARY KEY,
    points_time INT NOT NULL,
    games_time INT NOT NULL,
    name_time VARCHAR(100) NOT NULL,
    victory_time INT NOT NULL,
    draw_time INT NOT NULL,
    lost_time INT NOT NULL
);

CREATE TABLE IF NOT EXISTS games(
    id_game BIGSERIAL NOT NULL PRIMARY KEY,
    id_home BIGINT NOT NULL,
    id_visitor BIGINT NOT NULL,
    home_gols INT NOT NULL,
    visitor_gols INT NOT NULL,
    FOREIGN KEY (id_home) REFERENCES times,
    FOREIGN KEY (id_visitor) REFERENCES times
);
