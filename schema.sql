CREATE DATABASE IF NOT EXISTS theme_park_planner;
USE theme_park_planner;

CREATE TABLE IF NOT EXISTS rides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    park VARCHAR(100) NOT NULL,
    wait_time INT DEFAULT 0,
    thrill_level VARCHAR(20) NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS itinerary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    ride_id INT NOT NULL,
    position INT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (ride_id) REFERENCES rides(id)
);

INSERT INTO users (username) VALUES ('guest');

INSERT INTO rides (name, park, wait_time, thrill_level, description) VALUES
('Space Mountain', 'Magic Kingdom', 55, 'high', 'An indoor roller coaster through outer space.'),
('Pirates of the Caribbean', 'Magic Kingdom', 35, 'medium', 'A boat ride through pirate scenes.'),
('Haunted Mansion', 'Magic Kingdom', 30, 'medium', 'A spooky dark ride through a haunted estate.'),
('Seven Dwarfs Mine Train', 'Magic Kingdom', 50, 'medium', 'A family coaster based on Snow White.'),
('Soarin Around the World', 'EPCOT', 40, 'low', 'A flight simulation ride featuring landmarks from around the world.'),
('Test Track', 'EPCOT', 50, 'high', 'A high-speed car ride experience.'),
('Frozen Ever After', 'EPCOT', 45, 'low', 'A boat ride based on the Frozen movie.'),
('Remys Ratatouille Adventure', 'EPCOT', 35, 'low', 'A 4D ride through Gusteaus restaurant.'),
('Tower of Terror', 'Hollywood Studios', 60, 'high', 'A haunted hotel drop tower experience.'),
('Slinky Dog Dash', 'Hollywood Studios', 50, 'medium', 'A family-friendly roller coaster.'),
('Mickey and Minnies Runaway Railway', 'Hollywood Studios', 35, 'low', 'A trackless cartoon adventure ride.'),
('Rise of the Resistance', 'Hollywood Studios', 70, 'high', 'A large Star Wars attraction with multiple ride elements.'),
('Expedition Everest', 'Animal Kingdom', 45, 'high', 'A fast roller coaster through the Himalayas.'),
('Kilimanjaro Safaris', 'Animal Kingdom', 25, 'low', 'A safari ride featuring live animals.'),
('Na''vi River Journey', 'Animal Kingdom', 40, 'low', 'A peaceful boat ride through Pandora.'),
('DINOSAUR', 'Animal Kingdom', 30, 'medium', 'A time-travel adventure with dinosaurs.');
