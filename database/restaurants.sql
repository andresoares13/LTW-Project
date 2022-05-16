PRAGMA foreign_keys = ON;
BEGIN TRANSACTION;
.mode columns
.headers on
.nullvalue NULL


DROP TABLE IF EXISTS users;

CREATE TABLE users (
  userId INTEGER PRIMARY KEY,
  username VARCHAR NOT NULL,      
  password VARCHAR NOT NULL,                  
  Fname     VARCHAR NOT NULL,
  Lname    VARCHAR NOT NULL,
  adress   VARCHAR DEFAULT 'undefined',
  email    VARCHAR NOT NULL,
  phone    VARCHAR DEFAULT 'empty',
  photo STRING DEFAULT "default.jpg"                 
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


DROP TABLE IF EXISTS favouriteMenuItem;

CREATE TABLE favouriteMenuItem (
  id INTEGER PRIMARY KEY,
  customer INTEGER NOT NULL REFERENCES customer(id) ON DELETE CASCADE,
  menu_item INTEGER NOT NULL REFERENCES menu_item(id) ON DELETE CASCADE
);

INSERT INTO users (userId,username,password,Fname,Lname,adress,email,phone) VALUES (1,'admin','90bffe1884b84d5e255f12ff0ecbd70f2edfc877b68d612dc6fb50638b3ac17c', 'admin','Main', 'Parque infantil da Cordoaria','admin13131313@gmail.com', '966969694');

INSERT INTO users (userId,username,password,Fname,Lname,adress,email,phone) VALUES (2,'manel','f46337876db2ee9c6cc7ed84a1de76198f7ce3ba219031bd91df46009d00d510', 'Joaquim','Manel', 'Rua do Povo','joaquimmaneltaskinha@gmail.com', '912242469');

INSERT INTO restaurantOwner (id,user) VALUES (1,2);

INSERT INTO restaurants (id,name,adress,category,photo,owner) VALUES (1,'Taskinha','Rua do povo','Sushi','taskinha.jpg',1);

INSERT INTO restaurants (id,name,adress,category,owner) VALUES (2,'Casa do Povo','Rua do povo','Tudo',1);

INSERT INTO restaurants (id,name,adress,category,owner) VALUES (3,'Piolho','Rua do povo','pizza',1);

INSERT INTO menu(id,name,restaurant) VALUES (1,'massas',1);

INSERT INTO menu(id,name,restaurant) VALUES (2,'pizzas',1);

INSERT INTO menu(id,name,restaurant) VALUES (3,'massas',2);

INSERT INTO menu(id,name,restaurant) VALUES (4,'pizzas',2);

INSERT INTO menu(id,name,restaurant) VALUES (5,'massas',3);

INSERT INTO menu(id,name,restaurant) VALUES (6,'pizzas',3);

INSERT INTO menu_item(id,name,price,category,menu) VALUES (1,'massa com atum',5,'massa',1);

INSERT INTO menu_item(id,name,price,category,menu) VALUES (2,'massa com carne',6,'massa',1);


COMMIT TRANSACTION;

PRAGMA foreign_keys = ON;
  
  
