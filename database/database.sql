DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS transactions;
DROP TABLE IF EXISTS messages;

---------------------------------------
-- CREATE TABLES
---------------------------------------

-- Users table to store user information
CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT FALSE
);

-- Items table to store information about listed items
CREATE TABLE items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    seller_id INTEGER NOT NULL,
    category_id INTEGER NOT NULL,
    brand TEXT NOT NULL,
    model TEXT NOT NULL,
    size TEXT,
    condition TEXT,
    description TEXT,
    price REAL NOT NULL,
    image_paths TEXT, -- Comma-separated paths to images
    FOREIGN KEY (seller_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Categories table to store item categories
CREATE TABLE categories (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT UNIQUE NOT NULL
);

-- Transactions table to store information about completed transactions
CREATE TABLE transactions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    buyer_id INTEGER NOT NULL,
    item_id INTEGER NOT NULL,
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (buyer_id) REFERENCES users(id),
    FOREIGN KEY (item_id) REFERENCES items(id)
);

-- Messages table to store messages between users (optional feature)
CREATE TABLE messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    item_id INTEGER NOT NULL,
    message_text TEXT NOT NULL,
    send_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id),
    FOREIGN KEY (item_id) REFERENCES items(id)
);

---------------------------------------
-- POPULATE TABLES
---------------------------------------























INSERT INTO users (username, password_hash, email, is_admin) VALUES
('ArtisticAdventurer', 'P@intM3aN0ther', 'artistic_adv@example.com', 0),
('CulinaryConnoisseur', 'T@steExp3rt', 'culinary_connoisseur@example.com', 0),
('FashionForward', 'Chic&Styl!sh', 'fashion_forward@example.com', 0),
('VintageVoyager', 'R3troTr3@sure', 'vintage_voyager@example.com', 0),
('MusicalMaestro', 'M3lod!cM@ster', 'musical_maestro@example.com', 0),
('CraftyCollector', 'Cr3@t!veCrafter', 'crafty_collector@example.com', 0),
('user1', 'passwordhash1', 'user1@example.com', 0),
('admin', 'adminpasswordhash', 'admin@example.com', 1),
('SunnySurfer21', 's3cureP@ss', 'sunny_surfer21@gmail.com', 0),
('RetroReviver', 'vintageL0ve', 'retro_reviver@hotmail.com', 0),
('MysteryMaven', 'enigma@123', 'mystery_maven@yahoo.com', 0);

