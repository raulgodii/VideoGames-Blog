-- Create 'blog-videogames' database
CREATE DATABASE IF NOT EXISTS `blog-videogames` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `blog-videogames`;

-- Create 'users' table
CREATE TABLE IF NOT EXISTS users (
    id INT(255) AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    CONSTRAINT pk_users PRIMARY KEY (id),
    CONSTRAINT uq_email UNIQUE (email)
) ENGINE=InnoDB;

-- Insert minimum of 8 users
INSERT INTO users (name, last_name, email, password, date) VALUES
('John', 'Doe', 'john.doe@email.com', 'password123', '2023-01-01'),
('Jane', 'Smith', 'jane.smith@email.com', 'securepass', '2023-02-15'),
('Mike', 'Johnson', 'mike.johnson@email.com', 'pass123', '2023-03-20'),
('Emily', 'Williams', 'emily.w@email.com', 'strongpass', '2023-04-10'),
('Chris', 'Miller', 'chris.m@email.com', 'mypassword', '2023-05-05'),
('Eva', 'Brown', 'eva.b@email.com', 'evapass', '2023-06-12'),
('Alex', 'Taylor', 'alex.t@email.com', 'alexpass', '2023-07-18'),
('Sophie', 'Clark', 'sophie.c@email.com', 'sophiepass', '2023-08-24');

-- Create 'categories' table
CREATE TABLE IF NOT EXISTS categories (
    id INT(255) AUTO_INCREMENT NOT NULL,
    name VARCHAR(100),
    CONSTRAINT pk_categories PRIMARY KEY (id)
) ENGINE=InnoDB;

-- Insert minimum of 5 categories
INSERT INTO categories (name) VALUES
('Action'),
('Adventure'),
('Role-playing'),
('Simulation'),
('Strategy');

-- Create 'entries' table
CREATE TABLE IF NOT EXISTS entries (
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

-- Insert minimum of 20 entries with extensive descriptions
INSERT INTO entries (user_id, category_id, title, description, date) VALUES
(1, 1, 'Exciting Action Game', 'Embark on a thrilling adventure filled with heart-pounding action and intense combat. This action game delivers adrenaline-pumping excitement with its fast-paced gameplay and stunning visuals. Battle fierce enemies, uncover hidden secrets, and become the hero the gaming world needs. Are you ready for the ultimate gaming experience?', '2023-01-05'),
(2, 2, 'Epic Adventure Awaits', 'Join our protagonist on an epic journey through mysterious lands and ancient ruins. This adventure game combines captivating storytelling with breathtaking landscapes, offering players a truly immersive experience. Solve challenging puzzles, encounter intriguing characters, and unveil the secrets of a world waiting to be explored.', '2023-02-20'),
(3, 3, 'Fantasy RPG Quest', 'Immerse yourself in a rich fantasy world where magic and monsters collide. This RPG game promises an expansive open-world filled with quests, character customization, and epic battles. Forge alliances, defeat powerful foes, and shape the destiny of your character in this unforgettable role-playing experience.', '2023-03-25'),
(4, 4, 'Life Simulation Masterpiece', 'Experience the joy of life simulation like never before. Create and customize your own virtual world, from building your dream home to pursuing your dream career. This simulation game offers endless possibilities and allows you to live the life you´ve always imagined. What path will you choose?', '2023-04-15'),
(5, 5, 'Strategic Warfare', 'Command an army, build an empire, and engage in strategic warfare in this intense strategy game. Test your tactical skills on the battlefield, form alliances, and conquer enemy territories. With intricate gameplay mechanics and a deep storyline, this strategy game will keep you hooked for hours on end.', '2023-05-10'),
(6, 1, 'Fast-Paced Action Thrills', 'Get ready for a rollercoaster of action-packed thrills in this high-speed gaming experience. Battle against waves of enemies, execute jaw-dropping stunts, and push your reflexes to the limit. This action-packed title promises non-stop excitement and adrenaline-fueled moments.', '2023-06-18'),
(7, 2, 'Mystical Adventure Chronicles', 'Embark on a mystical journey through enchanted realms and mythical creatures. This adventure game combines captivating storytelling with stunning visuals, creating a truly magical experience. Solve ancient mysteries, collect powerful artifacts, and become a legend in this unforgettable adventure.', '2023-07-22'),
(8, 3, 'Epic Fantasy Saga', 'Delve into an epic fantasy saga that spans across generations. This RPG masterpiece offers a vast and immersive world filled with dynamic characters, intricate lore, and epic quests. Customize your character, make impactful choices, and shape the fate of the realm in this unforgettable role-playing experience.', '2023-08-30'),
(1, 4, 'Virtual Life Mastery', 'Experience the joys and challenges of virtual life in this highly detailed life simulation game. From building your dream home to pursuing a fulfilling career, this game offers a realistic and immersive simulation of everyday life. Are you ready to create your own virtual story?', '2023-09-05'),
(2, 5, 'Global Strategy Domination', 'Lead your nation to victory in this grand strategy game that spans continents and centuries. Develop your economy, build armies, and engage in diplomatic maneuvers to secure your place in history. This strategy title offers unparalleled depth and complexity for those seeking a true challenge.', '2023-10-12'),
(3, 1, 'Intense Action Warfare', 'Gear up for intense action warfare with this adrenaline-fueled gaming experience. Engage in epic battles, use advanced weaponry, and outsmart your enemies in fast-paced combat. This action-packed title guarantees an immersive and thrilling experience for players seeking a challenge.', '2023-11-18'),
(4, 2, 'Enchanting Quest for Glory', 'Embark on an enchanting quest for glory in a world of magic and wonder. This adventure game invites players to explore lush landscapes, encounter mythical creatures, and uncover the secrets of a forgotten realm. Will you rise to the challenge and become a legendary hero in this captivating journey?', '2023-12-03'),
(5, 3, 'Epic RPG Odyssey', 'Embark on an epic RPG odyssey that takes you through a vast and immersive world. With a deep and engaging storyline, this role-playing game offers a combination of strategic battles, character development, and impactful decision-making. Your choices will shape the destiny of the game world in this unforgettable odyssey.', '2023-12-20'),
(6, 4, 'Virtual Reality Life', 'Step into the world of virtual reality and experience life in a whole new way. This simulation game takes immersion to the next level, allowing players to interact with a lifelike virtual environment. From socializing with virtual friends to pursuing virtual careers, the possibilities are endless in this groundbreaking title.', '2024-01-05'),
(7, 5, 'Tactical Mastery', 'Hone your tactical skills and lead your squad to victory in this tactical strategy game. With realistic battlefield scenarios and advanced AI, this title offers a challenging and rewarding experience for players who crave strategic depth. Plan your moves, execute precise maneuvers, and emerge victorious in the theater of war.', '2024-02-10'),
(8, 1, 'High-Octane Action', 'Immerse yourself in the heart-pounding world of high-octane action. This game delivers intense and fast-paced gameplay, featuring a wide range of weapons, explosive set pieces, and adrenaline-fueled missions. Get ready for a cinematic gaming experience that will leave you on the edge of your seat.', '2024-03-15'),
(1, 2, 'Magical Adventure Awaits', 'Embark on a magical adventure filled with wonder and enchantment. This adventure game combines whimsical storytelling with stunning visuals, creating a truly magical experience. Solve puzzles, meet fantastical creatures, and explore a world where dreams come to life.', '2024-04-20'),
(2, 3, 'Epic RPG Chronicles', 'Dive into a world of epic RPG chronicles, where every decision shapes the destiny of the game world. This role-playing game offers a rich narrative, intricate character development, and a vast open world to explore. Will you become a savior, a conqueror, or something in between?', '2024-05-25'),
(3, 4, 'Virtual Life Beyond Limits', 'Experience a virtual life beyond limits in this innovative life simulation game. From virtual relationships to virtual adventures, this title pushes the boundaries of what is possible in a simulated world. Create your own narrative and live a life without constraints.', '2024-06-30'),
(4, 5, 'Global Strategy Conquest', 'Lead your nation to global conquest in this expansive strategy game. Develop your civilization, form alliances, and engage in epic battles for world domination. With a deep and complex gameplay system, this strategy title offers endless hours of strategic planning and tactical warfare.', '2024-07-05'),
(5, 1, 'Action-Packed Warfare', 'Gear up for action-packed warfare in this intense gaming experience. Navigate through challenging environments, engage in fierce battles, and outsmart your adversaries in adrenaline-fueled combat. This action title promises non-stop excitement and high-stakes encounters for players seeking a thrill.', '2024-08-10'),
(6, 2, 'Fantasy Adventure Unleashed', 'Unleash your imagination in this fantasy adventure that takes you on a journey through mythical realms and magical landscapes. This adventure game combines stunning visuals with an immersive storyline, inviting players to become part of a world where anything is possible. Are you ready for the adventure of a lifetime?', '2024-09-15'),
(7, 3, 'Epic RPG Legends', 'Become a legend in the world of epic RPGs, where your every decision shapes the course of history. This role-playing game offers a deep and immersive experience, with complex characters, moral dilemmas, and a sprawling game world. Will you be a hero, a villain, or something in between?', '2024-10-20'),
(8, 4, 'Virtual Reality Exploration', 'Embark on a journey of exploration in the realm of virtual reality. This simulation game allows players to interact with a vast and dynamic virtual environment, from breathtaking landscapes to futuristic cityscapes. Immerse yourself in a world where the boundaries of reality are pushed to new heights.', '2024-11-25');
