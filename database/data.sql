INSERT INTO users (userId,username,password,name,adress,phone) VALUES (1,'admin','90bffe1884b84d5e255f12ff0ecbd70f2edfc877b68d612dc6fb50638b3ac17c', 'adminMain', 'Parque infantil da Cordoaria', '966969694');

INSERT INTO users (userId,username,password,name,adress,phone) VALUES (2,'manel','f46337876db2ee9c6cc7ed84a1de76198f7ce3ba219031bd91df46009d00d510', 'Manel', 'Rua do Povo', '912242469');

INSERT INTO restaurantOwner (id,user) VALUES (1,2);

INSERT INTO restaurants (id,name,adress,category,owner) VALUES (1,'Taskinha','Rua do povo','Sushi',1);


