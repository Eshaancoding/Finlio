create table personal_information (
	id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    first_name varchar(128) not null,
    last_name varchar(128) not null,
    high_school varchar(512) not null,
    email varchar(512) not null,
    date_of_birth date not null
);

create table project_name (
	id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    first_name varchar(128) not null,
    last_name varchar(128) not null,
    proj_name varchar(128) not null,
    proj_details varchar(512) not null
);

create table interests (
	id int(11) not null PRIMARY KEY AUTO_INCREMENT, 
   	first_name varchar(128) not null,
    last_name varchar(128) not null,
    ml boolean not null,
    web_dev boolean not null,
    react boolean not null, 
    robotics boolean not null, 
    flutter boolean not null
);

create table profiles (
    id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    first_name varchar(128), 
    last_name varchar(128),
    image_url varchar(512)
);