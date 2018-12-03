CREATE DATABASE IF NOT EXISTS VideoControllerDB;
USE VideoControllerDB;

CREATE TABLE users (
	id		int(255) auto_increment not null,
	role		varchar(20),
	name		varchar(255),
	surname	varchar(255),
	email		varchar(255),
	password	varchar(255),
	image		varchar(255),
	created_at	datetime,
	updated_at	datetime,
	remember_token	varchar(255),
	CONSTRAINT pk_users PRIMARY KEY(id)
) ENGINE=InnoDb; 

CREATE  TABLE videos (
	id		int(255) auto_increment not null,
	user_id	int(255) not null,
	title		varchar(255),
	description	text,
	status		varchar(20),
	image		varchar(255),
	video_path	varchar(255),
	created_at	datetime,
	updated_at	datetime,
	CONSTRAINT pk_videos PRIMARY KEY(id),
	CONSTRAINT fk_videos_users FOREIGN KEY(user_id) REFERENCES users(id)
) ENGINE=InnoDb;


CREATE  TABLE comments (
	id		int(255) auto_increment not null,
	user_id	int(255) not null,
	video_id	int(255) not null,
	body		text,
	created_at	datetime,
	updated_at	datetime,
	CONSTRAINT pk_comments PRIMARY KEY(id),
	CONSTRAINT fk_comments_videos FOREIGN KEY(video_id) REFERENCES videos(id),
	CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDb;


CREATE TABLE status (
	id		int(255) auto_increment not null,
	name 	varchar(255) not null,
	CONSTRAINT pk_status PRIMARY KEY(id)
) ENGINE=InnoDb;

CREATE TABLE events (
	eventID varchar(255) not null,
	title	varchar(255),
	status 	int(255) not null,
	user_id	int(255) not null,
	created_at	datetime,
	updated_at	datetime,
	CONSTRAINT pk_events PRIMARY KEY(id),
	CONSTRAINT fk_events_status FOREIGN KEY(status) REFERENCES status(id),
	CONSTRAINT fk_events_users FOREIGN KEY(user_id) REFERENCES users(id)
) ENGINE=InnoDb;