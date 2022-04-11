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
  name     VARCHAR NOT NULL,
  adress   VARCHAR NOT NULL,
  phone    VARCHAR UNIQUE,
  isRestaurant BOOLEAN NOT NULL DEFAULT FALSE                       
);

DROP TABLE IF EXISTS restaurants;

CREATE TABLE restaurants (
  id INTEGER PRIMARY KEY,            
  name VARCHAR NOT NULL                    
);

DROP TABLE IF EXISTS menu;

CREATE TABLE menu (
  id INTEGER PRIMARY KEY,
  name VARCHAR NOT NULL,
  restaurant INTEGER NOT NULL REFERENCES restaurant(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS dish;

CREATE TABLE dish (
  id INTEGER PRIMARY KEY,
  name VARCHAR NOT NULL,
  menu INTEGER NOT NULL REFERENCES menu(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS customer; 

CREATE TABLE customer (
  id INTEGER PRIMARY KEY,
  name VARCHAR NOT NULL
); 

DROP TABLE IF EXISTS request; 

CREATE TABLE request (
  id INTEGER PRIMARY KEY,
  restaurant INTEGER NOT NULL REFERENCES restaurant(id) ON DELETE CASCADE,
  customer INTEGER NOT NULL REFERENCES customer(id) ON DELETE CASCADE
);
   

DROP TABLE IF EXISTS requestDish;

CREATE TABLE RequestDish (
  id INTEGER PRIMARY KEY,
  request INTEGER NOT NULL REFERENCES request(id) ON DELETE CASCADE
);  



COMMIT TRANSACTION;
PRAGMA foreign_keys = on;  

  
  
