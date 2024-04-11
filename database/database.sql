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

-- Insert sample users
INSERT INTO users (username, password, email, is_admin) VALUES 
    ('admin', 'admin123', 'admin@example.com', 1),
    ('user1', 'password1', 'user1@example.com', 0),
    ('user2', 'password2', 'user2@example.com', 0),
    ('user3', 'password3', 'user3@example.com', 0),
    ('SunnySurfer21', 's3cureP@ss', 'sunny_surfer21@gmail.com', 0),
    ('ArtisticAdventurer', 'P@intM3aN0ther', 'artistic_adv@example.com', 0),
    ('CulinaryConnoisseur', 'T@steExp3rt', 'culinary_connoisseur@example.com', 0),
    ('FashionForward', 'Chic&Styl!sh', 'fashion_forward@example.com', 0),
    ('VintageVoyager', 'R3troTr3@sure', 'vintage_voyager@example.com', 0),
    ('MusicalMaestro', 'M3lod!cM@ster', 'musical_maestro@example.com', 0),
    ('CraftyCollector', 'Cr3@t!veCrafter', 'crafty_collector@example.com', 0);

-- Insert sample categories
INSERT INTO categories (name) VALUES 
    ('Electronics'),
    ('Clothing'),
    ('Books'),
    ('Furniture'),
    ('Toys');

-- Insert sample items
INSERT INTO items (seller_id, category_id, brand, model, size, condition, description, price, image_paths) VALUES 
    (1, 1, 'Apple', 'iPhone X', 'N/A', 'Good', 'Used iPhone X in good condition', 500.00, '/path/to/image1'),
    (2, 2, 'Nike', 'Air Max', '9', 'New', 'Brand new Nike Air Max shoes', 100.00, '/path/to/image2'),
    (3, 3, 'JK Rowling', 'Harry Potter and the Sorcerer''s Stone', 'N/A', 'Like New', 'First book in the Harry Potter series', 15.00, '/path/to/image3'),
    (4, 4, 'IKEA', 'MALM', 'Queen', 'Excellent', 'IKEA MALM Queen bed frame', 200.00, '/path/to/image4'),
    (5, 5, 'LEGO', 'Star Wars Millennium Falcon', 'N/A', 'New', 'LEGO Star Wars Millennium Falcon set', 800.00, '/path/to/image5');

-- Insert sample transactions
INSERT INTO transactions (buyer_id, item_id) VALUES 
    (2, 1),
    (3, 2),
    (4, 3),
    (5, 4),
    (6, 5);

-- Insert sample messages
INSERT INTO messages (sender_id, receiver_id, item_id, message_text) VALUES 
    (2, 1, 1, 'Is the iPhone still available?'),
    (1, 2, 1, 'Yes, it is.'),
    (3, 2, 2, 'Are the shoes true to size?'),
    (2, 3, 2, 'Yes, they are.'),
    (4, 3, 3, 'Is the book hardcover?');
