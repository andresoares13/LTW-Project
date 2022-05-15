PRAGMA foreign_keys = ON;
BEGIN TRANSACTION;
.mode columns
.headers on
.nullvalue NULL

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  userId INTEGER PRIMARY KEY,
  username VARCHAR NOT NULL UNIQUE,      
  password VARCHAR NOT NULL,                  
  Fname     VARCHAR NOT NULL,
  Lname    VARCHAR NOT NULL,
  adress   VARCHAR DEFAULT 'undefined',
  email    VARCHAR NOT NULL,
  phone    VARCHAR DEFAULT 'empty'                 
);

DROP TABLE IF EXISTS restaurants;

CREATE TABLE restaurants (
  id INTEGER PRIMARY KEY,            
  name VARCHAR NOT NULL,
  adress VARCHAR NOT NULL,
  category VARCHAR NOT NULL,
  photo STRING DEFAULT "default.jpg",
  owner INTEGER NOT NULL REFERENCES restaurantOwner(id) ON DELETE CASCADE                    
);

DROP TABLE IF EXISTS menu;

CREATE TABLE menu (
  id INTEGER PRIMARY KEY,
  name VARCHAR NOT NULL,
  restaurant INTEGER NOT NULL REFERENCES restaurants(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS menu_item;

CREATE TABLE menu_item (
  id INTEGER PRIMARY KEY,
  name VARCHAR NOT NULL,
  price INTEGER NOT NULL,
  photo STRING DEFAULT "default.jpg",
  category VARCHAR NOT NULL,
  menu INTEGER NOT NULL REFERENCES menu(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS customer; 

CREATE TABLE customer (
  id INTEGER PRIMARY KEY,
  user INTEGER NOT NULL REFERENCES users(userId) ON DELETE CASCADE,
  name VARCHAR NOT NULL
); 

DROP TABLE IF EXISTS restaurantOwner;

CREATE TABLE restaurantOwner (
  id INTEGER PRIMARY KEY,
  user INTEGER NOT NULL REFERENCES users(userId) ON DELETE CASCADE
);

DROP TABLE IF EXISTS request; 

CREATE TABLE request (
  id INTEGER PRIMARY KEY,
  restaurant INTEGER NOT NULL REFERENCES restaurants(id) ON DELETE CASCADE,
  customer INTEGER NOT NULL REFERENCES customer(id) ON DELETE CASCADE,
  state VARCHAR NOT NULL
);
   

DROP TABLE IF EXISTS requestMenuItem;

CREATE TABLE RequestMenuItem (
  id INTEGER PRIMARY KEY,
  menu_item INTEGER NOT NULL REFERENCES menu_item(id) ON DELETE CASCADE,
  request INTEGER NOT NULL REFERENCES request(id) ON DELETE CASCADE
);  

DROP TABLE IF EXISTS review;

CREATE TABLE review (
  id INTEGER PRIMARY KEY,
  customer INTEGER NOT NULL REFERENCES customer(id) ON DELETE SET NULL,
  restaurant INTEGER NOT NULL REFERENCES restaurant(id) ON DELETE CASCADE,
  rating INTEGER NOT NULL,
  comment VARCHAR NOT NULL
);

DROP TABLE IF EXISTS favouriteRestaurant;

CREATE TABLE favouriteRestaurant (
  id INTEGER PRIMARY KEY,
  customer INTEGER NOT NULL REFERENCES customer(id) ON DELETE CASCADE,
  restaurant INTEGER NOT NULL REFERENCES restaurant(id) ON DELETE CASCADE
);


DROP TABLE IF EXISTS favouriteMenu;

CREATE TABLE favouriteMenu (
  id INTEGER PRIMARY KEY,
  customer INTEGER NOT NULL REFERENCES customer(id) ON DELETE CASCADE,
  menu INTEGER NOT NULL REFERENCES menu(id) ON DELETE CASCADE
);



COMMIT TRANSACTION;


PRAGMA foreign_keys = on;  

  
  
