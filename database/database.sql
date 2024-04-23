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
    Id INTEGER PRIMARY KEY AUTOINCREMENT,
    Username TEXT UNIQUE NOT NULL,
    Password TEXT NOT NULL,
    Email TEXT UNIQUE NOT NULL,
    Is_Admin BOOLEAN NOT NULL DEFAULT FALSE
);

-- Items table to store information about listed items
CREATE TABLE Item (
    Id INTEGER PRIMARY KEY AUTOINCREMENT,
    Seller_Id INTEGER NOT NULL,
    Category_Id INTEGER NOT NULL,
    Manufacturer TEXT NOT NULL,
    Name TEXT NOT NULL,
    Size TEXT,
    Condition TEXT,
    Description TEXT,
    Price REAL NOT NULL,
    Image_path TEXT, -- Comma-separated paths to images
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
    Id INTEGER PRIMARY KEY AUTOINCREMENT,
    Buyer_Id INTEGER NOT NULL,
    Item_Id INTEGER NOT NULL,
    Purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Buyer_Id) REFERENCES User(Id),
    FOREIGN KEY (Item_Id) REFERENCES Item(Id)
);

-- Messages table to store messages between users (optional feature)
CREATE TABLE Message (
    Id INTEGER PRIMARY KEY AUTOINCREMENT,
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
INSERT INTO User (Username, Password, Email, Is_admin) VALUES 
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
INSERT INTO Category (Name) VALUES 
    ('Electronics'),
    ('Clothing'),
    ('Books'),
    ('Furniture'),
    ('Toys');

-- Insert sample items
INSERT INTO Item (Seller_Id, Category_Id, Manufacturer, Name, Size, Condition, Description, Price, Image_path) VALUES 
    (1, 1, 'Apple', 'iPhone X', 'N/A', 'Good', 'Used iPhone X in good condition', 500.00, '/path/to/image1'),
    (2, 2, 'Nike', 'Air Max', '9', 'New', 'Brand new Nike Air Max shoes', 100.00, '/path/to/image2'),
    (3, 3, 'JK Rowling', 'Harry Potter and the Sorcerer''s Stone', 'N/A', 'Like New', 'First book in the Harry Potter series', 15.00, '/path/to/image3'),
    (4, 4, 'IKEA', 'MALM', 'Queen', 'Excellent', 'IKEA MALM Queen bed frame', 200.00, '/path/to/image4'),
    (5, 5, 'LEGO', 'Star Wars Millennium Falcon', 'N/A', 'New', 'LEGO Star Wars Millennium Falcon set', 800.00, '/path/to/image5');

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
