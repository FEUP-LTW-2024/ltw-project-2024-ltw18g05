DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Transaction_;
DROP TABLE IF EXISTS Message;

---------------------------------------
-- CREATE TABLES
---------------------------------------

-- Users table to store user information
CREATE TABLE User (
    Id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    Username TEXT UNIQUE NOT NULL,
    Name TEXT NOT NULL,
    Password TEXT NOT NULL,
    Email TEXT UNIQUE NOT NULL,
    Is_Admin BOOLEAN NOT NULL DEFAULT FALSE
);

-- Items table to store information about listed items
CREATE TABLE Item (
    Id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    Seller_Id INTEGER NOT NULL,
    Category_Id INTEGER NOT NULL,
    Manufacturer TEXT NOT NULL,
    Name TEXT NOT NULL,
    Size TEXT,
    Condition TEXT,
    Description TEXT,
    Price REAL NOT NULL,
    Image_path TEXT, -- Comma-separated paths to images
    Featured BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (Seller_id) REFERENCES User(Id),
    FOREIGN KEY (Category_id) REFERENCES Category(Id)
);

-- Categories table to store item categories
CREATE TABLE Category (
    Id INTEGER PRIMARY KEY AUTOINCREMENT,
    Name TEXT UNIQUE NOT NULL
);

-- Transactions table to store information about completed transactions
CREATE TABLE Transaction_ (
    Id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    Buyer_Id INTEGER NOT NULL,
    Item_Id INTEGER NOT NULL,
    Purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Buyer_Id) REFERENCES User(Id),
    FOREIGN KEY (Item_Id) REFERENCES Item(Id)
);

-- Messages table to store messages between users (optional feature)
CREATE TABLE Message (
    Id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    Sender_Id INTEGER NOT NULL,
    Receiver_Id INTEGER NOT NULL,
    Item_Id INTEGER NOT NULL,
    Message_text TEXT NOT NULL,
    Send_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Sender_Id) REFERENCES User(Id),
    FOREIGN KEY (Receiver_Id) REFERENCES User(Id),
    FOREIGN KEY (Item_Id) REFERENCES Item(Id)
);

---------------------------------------
-- POPULATE TABLES
---------------------------------------

-- Insert sample users
INSERT INTO User (Username, Name, Password, Email, Is_admin) VALUES 
    ('admin', 'NameOfAdmin', 'admin123', 'admin@example.com', 1),
    ('user1', 'User One', 'password1', 'user1@example.com', 0),
    ('user2', 'User Two', 'password2', 'user2@example.com', 0),
    ('user3', 'User Three', 'password3', 'user3@example.com', 0),
    ('SunnySurfer21', 'Sunny Surfer', 's3cureP@ss', 'sunny_surfer21@gmail.com', 0),
    ('ArtisticAdventurer', 'Artistic Adventurer', 'P@intM3aN0ther', 'artistic_adv@example.com', 0),
    ('CulinaryConnoisseur', 'Culinary Connoisseur', 'T@steExp3rt', 'culinary_connoisseur@example.com', 0),
    ('FashionForward', 'Fashion Forward', 'Chic&Styl!sh', 'fashion_forward@example.com', 0),
    ('VintageVoyager', 'Vintage Voyager', 'R3troTr3@sure', 'vintage_voyager@example.com', 0),
    ('MusicalMaestro', 'Musical Maestro', 'M3lod!cM@ster', 'musical_maestro@example.com', 0),
    ('CraftyCollector', 'Crafty Collector', 'Cr3@t!veCrafter', 'crafty_collector@example.com', 0);

-- Insert sample categories
INSERT INTO Category (Name) VALUES 
    ('Electronics'),
    ('Clothing'),
    ('Books'),
    ('Furniture'),
    ('Toys');

-- Insert sample items
INSERT INTO Item (Seller_Id, Category_Id, Manufacturer, Name, Size, Condition, Description, Price, Image_path, Featured) VALUES 
    (1, 1, 'Apple', 'iPhone X', 'N/A', 'Good', 'Used iPhone X in good condition', 500.00, '/images/items/iphonex.jpg', 1),
    (2, 2, 'Nike', 'Air Max', '9', 'Good', 'Brand new Nike Air Max shoes', 100.00, '/images/items/nikeairmax.jpeg', 0),
    (3, 3, 'JK Rowling', 'Harry Potter and the Sorcerer''s Stone', 'N/A', 'Very Good', 'First book in the Harry Potter series', 15.00, '/images/items/harrypotter.jpg', 0),
    (4, 4, 'IKEA', 'MALM', 'Queen', 'Excellent', 'IKEA MALM Queen bed frame', 200.00, '/images/items/MALM.png', 1),
    (5, 5, 'LEGO', 'Star Wars Millennium Falcon', 'N/A', 'Good', 'LEGO Star Wars Millennium Falcon set', 800.00, '/images/items/millenium.jpg', 1),
    (6, 1, 'Apple', 'Apple Watch Series 9', 'N/A', 'Bad', 'This Apple Watch is surviving by hopes and prayers', 50.00, '/images/items/apple.jpg', 0),
    (6, 1, 'Cessna', 'Cessna 152', 'N/A', 'Deteriorated', 'The GPS still works', 15000.00, '/images/items/cessna.jpg', 0),
    (6, 1, 'Samsung', 'Galaxy Book 3', 'N/A', 'Very Good', 'Computer in great condition!!', 2640.00, '/images/items/samsung.jpg', 0);

-- Insert sample transactions
INSERT INTO Transaction_ (Buyer_Id, Item_Id) VALUES 
    (2, 1),
    (3, 2),
    (4, 3),
    (5, 4),
    (6, 5);

-- Insert sample messages
INSERT INTO Message (Sender_Id, Receiver_Id, Item_Id, Message_text) VALUES 
    (2, 1, 1, 'Is the iPhone still available?'),
    (1, 2, 1, 'Yes, it is.'),
    (3, 2, 2, 'Are the shoes true to size?'),
    (2, 3, 2, 'Yes, they are.'),
    (4, 3, 3, 'Is the book hardcover?');
