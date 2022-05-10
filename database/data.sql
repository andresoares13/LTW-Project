INSERT INTO users (userId,username,password,name,adress,phone) VALUES (1,'admin','90bffe1884b84d5e255f12ff0ecbd70f2edfc877b68d612dc6fb50638b3ac17c', 'adminMain', 'Parque infantil da Cordoaria', '966969694');

INSERT INTO users (userId,username,password,name,adress,phone) VALUES (2,'manel','f46337876db2ee9c6cc7ed84a1de76198f7ce3ba219031bd91df46009d00d510', 'Manel', 'Rua do Povo', '912242469');

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

INSERT INTO dish(id,name,price,category,menu) VALUES (1,'massa com atum',5,'massa',1);

INSERT INTO dish(id,name,price,category,menu) VALUES (2,'massa com carne',6,'massa',1);


