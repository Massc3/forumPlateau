CREATE TABLE Users(
   id_user COUNTER,
   email VARCHAR(255),
   pseudo VARCHAR(50) NOT NULL,
   password VARCHAR(255) NOT NULL,
   dateInscription DATETIME NOT NULL,
   ban LOGICAL,
   role JISON,
   PRIMARY KEY(id_user)
);

CREATE TABLE Category(
   id_category COUNTER,
   nameCategory VARCHAR(255) NOT NULL,
   PRIMARY KEY(id_category)
);

CREATE TABLE Topics(
   id_topic LOGICAL,
   title VARCHAR(255) NOT NULL,
   dateCreation DATETIME NOT NULL,
   locked LOGICAL,
   id_category INT NOT NULL,
   id_user INT NOT NULL,
   PRIMARY KEY(id_topic),
   FOREIGN KEY(category_id) REFERENCES Category(category_id),
   FOREIGN KEY(user_id) REFERENCES Users(user_id)
);

CREATE TABLE Post(
   id_post VARCHAR(255),
   text TEXT NOT NULL,
   date_creation_message DATETIME NOT NULL,
   id_user INT NOT NULL,
   id_topic LOGICAL NOT NULL,
   PRIMARY KEY(id_post),
   FOREIGN KEY(user_id) REFERENCES Users(user_id),
   FOREIGN KEY(topic_id) REFERENCES Topics(topic_id)
);
