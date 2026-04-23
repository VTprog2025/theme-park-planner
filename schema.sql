-- TODO: Create your database and tables
CREATE DATABASE IF NOT EXISTS theme_park_planner;
USE theme_park_planner;

-- TODO: Define rides table
CREATE TABLE IF NOT EXISTS rides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    park VARCHAR(100) NOT NULL,
    wait_time INT DEFAULT 0,
    thrill_level VARCHAR(20) NOT NULL,
    description TEXT
);

-- TODO: Define users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE
);

-- TODO: Define itinerary table
CREATE TABLE IF NOT EXISTS itinerary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    ride_id INT NOT NULL,
    position INT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (ride_id) REFERENCES rides(id)
);

-- TODO: Insert sample data
