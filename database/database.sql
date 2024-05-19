DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Transaction_;
DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS Conversation;
DROP TABLE IF EXISTS Wishlist;

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
    Is_Admin BOOLEAN NOT NULL DEFAULT FALSE,
    Profile_Picture TEXT NOT NULL DEFAULT 'white',
    Address TEXT NOT NULL,
    Phone TEXT NOT NULL
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
    Image_path TEXT DEFAULT '/images/defaults/default_Item.jpg', -- Comma-separated paths to images
    Featured BOOLEAN NOT NULL DEFAULT FALSE,
    Is_Sold BOOLEAN NOT NULL DEFAULT FALSE,
    Buyer_Id INTEGER DEFAULT NULL,
    FOREIGN KEY (Seller_id) REFERENCES User(Id) on DELETE CASCADE,
    FOREIGN KEY (Category_id) REFERENCES Category(Id) on DELETE CASCADE
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

-- Messages table to store messages between users
CREATE TABLE Message (
    Id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    Sender_Id INTEGER NOT NULL,
    Receiver_Id INTEGER NOT NULL,
    Conversation_Id INTEGER,
    Message_text TEXT NOT NULL,
    Send_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Opened BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (Sender_Id) REFERENCES User(Id) ON DELETE CASCADE,
    FOREIGN KEY (Receiver_Id) REFERENCES User(Id) ON DELETE CASCADE,
    FOREIGN KEY (Conversation_Id) REFERENCES Conversation(Id) ON DELETE CASCADE
);

CREATE TABLE Conversation (
    Id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    User1_Id INTEGER NOT NULL,
    User2_Id INTEGER NOT NULL,
    Item_Id INTEGER NOT NULL,
    FOREIGN KEY (User1_Id) REFERENCES User(Id) ON DELETE CASCADE,
    FOREIGN KEY (User2_Id) REFERENCES User(Id) ON DELETE CASCADE,
    FOREIGN KEY (Item_Id) REFERENCES Item(Id) ON DELETE CASCADE
);

CREATE TABLE Wishlist (
    Id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    User_Id INTEGER NOT NULL,
    Item_Id INTEGER NOT NULL,
    FOREIGN KEY (User_Id) REFERENCES User(Id),
    FOREIGN KEY (Item_Id) REFERENCES Item(Id)
);

---------------------------------------
-- POPULATE TABLES
---------------------------------------

-- Insert sample users
INSERT INTO User (Username, Name, Password, Email, Is_admin, Profile_Picture, Address, Phone) VALUES 
    ('admin', 'NameOfAdmin', '$2a$12$e/79zbaaMrx5n.c2/m5cH.vnQ0IFHV1UPhFIenaV2i3p1YIBT8El2', 'admin@example.com', 1, 'black', 'Admin Address', '123456789'),
    ('admin2', 'ADMI', '$2a$12$2Zp/GR/9XHxGNEUNMBEkyu8KaLmedJ/YNEHtOFE47/iOK8.8fHVO6', 'admin2@example.com', 1, 'red', 'Admin2 Address', '987654321'),
    ('user1', 'User One', '$2a$12$gKkLzQDFqmVHZvlhjDC0SuVfOiSw0uvccv6nHSPIGHG2h.Mk3eLEi', 'user1@example.com', 0, 'white', 'User1 Address', '111111111'),
    ('user2', 'User Two', '$2a$12$FwSZgHSnB7iXnq7z12hcweGJV/KNuY5WlFZk6cGaSl.JLskZIS5/.', 'user2@example.com', 0, 'white', 'User2 Address', '222222222'),
    ('user3', 'User Three', '$2a$12$UsL2IpOSJSi19EhuAOSyGuiqiHu4KMGd7xGOqQKCGHEPJZvsUHwE6', 'user3@example.com', 0, 'white', 'User3 Address', '333333333'),
    ('SunnySurfer21', 'Sunny Surfer', 's3cureP@ss', 'sunny_surfer21@gmail.com', 0, 'orange', 'SunnySurfer21 Address', '444444444'),
    ('ArtisticAdventurer', 'Artistic Adventurer', 'P@intM3aN0ther', 'artistic_adv@example.com', 0, 'blue', 'ArtisticAdventurer Address', '555555555'),
    ('CulinaryConnoisseur', 'Culinary Connoisseur', 'T@steExp3rt', 'culinary_connoisseur@example.com', 0, 'red', 'CulinaryConnoisseur Address', '666666666'),
    ('FashionForward', 'Fashion Forward', 'Chic&Styl!sh', 'fashion_forward@example.com', 0, 'green', 'FashionForward Address', '777777777'),
    ('VintageVoyager', 'Vintage Voyager', 'R3troTr3@sure', 'vintage_voyager@example.com', 0, 'orange', 'VintageVoyager Address', '888888888'),
    ('MusicalMaestro', 'Musical Maestro', 'M3lod!cM@ster', 'musical_maestro@example.com', 0, 'blue', 'MusicalMaestro Address', '999999999'),
    ('CraftyCollector', 'Crafty Collector', 'Cr3@t!veCrafter', 'crafty_collector@example.com', 0, 'red', 'CraftyCollector Address', '000000000');


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
    (3, 3, 'JK Rowling', 'Harry Potter and the Sorcerer''s Stone', 'N/A', 'Excellent', 'First book in the Harry Potter series', 15.00, '/images/items/harrypotter.jpg', 0),
    (4, 4, 'IKEA', 'MALM', '1,5 meters', 'Excellent', 'IKEA MALM for clothes and stuff', 200.00, '/images/items/MALM.png', 1),
    (5, 5, 'LEGO', 'Star Wars Millennium Falcon', 'N/A', 'Good', 'LEGO Star Wars Millennium Falcon set', 800.00, '/images/items/millenium.jpg', 1),
    (2, 1, 'Apple', 'Apple Watch Series 9', 'N/A', 'Bad', 'This Apple Watch is surviving by hopes and prayers', 50.00, '/images/items/apple.jpg', 0),
    (2, 1, 'Cessna', 'Cessna 152', 'N/A', 'Deteriorated', 'The GPS still works', 15000.00, '/images/items/cessna.jpg', 0),
    (2, 1, 'Samsung', 'Galaxy Book 3', 'N/A', 'Good', 'Computer in great condition!!', 2640.00, '/images/items/samsung.jpg', 0);

-- Insert sample transactions
INSERT INTO Transaction_ (Buyer_Id, Item_Id) VALUES 
    (2, 1),
    (3, 2),
    (4, 3),
    (5, 4),
    (6, 5);

-- Insert sample messages
INSERT INTO Message (Sender_Id, Receiver_Id, Conversation_Id, Message_text) VALUES 
    (2, 1, 1, 'Is the iPhone still available?'),
    (1, 2, 1, 'Yes, it is.'),
    (3, 2, 2, 'Are the shoes true to size?'),
    (2, 3, 2, 'Yes, they are.'),
    (4, 3, 3, 'Is the book hardcover?');

-- Insert sample conversations
INSERT INTO Conversation (User1_Id, User2_Id, Item_Id) VALUES 
    (2, 1, 1),
    (3, 2, 2),
    (4, 3, 3);

INSERT INTO Wishlist (User_Id, Item_Id) VALUES 
    (2, 1),  
    (3, 2),  
    (4, 3),  
    (2, 4),  
    (5, 5),  
    (6, 6),  
    (7, 7),  
    (8, 8);  

