CREATE TABLE question (
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
     questionsId MEDIUMINT NOT NULL,
     sortorder INT DEFAULT 1,
     label CHAR(255) NOT NULL,
     PRIMARY KEY (id),
     FOREIGN KEY (questionsId)
        REFERENCES questions(id)
        ON DELETE CASCADE
)   ENGINE=INNODB;

INSERT INTO question (questionsId,sortorder,label) VALUES (6,1,"Less than 18");
INSERT INTO question (questionsId,sortorder,label) VALUES (6,2,"18-99");
INSERT INTO question (questionsId,sortorder,label) VALUES (6,3,"More than 99");
INSERT INTO question (questionsId,sortorder,label) VALUES (7,1,"Yes");
INSERT INTO question (questionsId,sortorder,label) VALUES (7,2,"No");
INSERT INTO question (questionsId,sortorder,label) VALUES (8,1,"Spain");
INSERT INTO question (questionsId,sortorder,label) VALUES (8,2,"France");
INSERT INTO question (questionsId,sortorder,label) VALUES (8,3,"Italy");
INSERT INTO question (questionsId,sortorder,label) VALUES (8,4,"England");
INSERT INTO question (questionsId,sortorder,label) VALUES (8,5,"Portugal");
INSERT INTO question (questionsId,sortorder,label) VALUES (9,1,"Football");
INSERT INTO question (questionsId,sortorder,label) VALUES (9,2,"Basketball");
INSERT INTO question (questionsId,sortorder,label) VALUES (9,3,"Soccer");
INSERT INTO question (questionsId,sortorder,label) VALUES (9,4,"Volleyball");
INSERT INTO question (questionsId,sortorder,label) VALUES (10,1,"PHP");
INSERT INTO question (questionsId,sortorder,label) VALUES (10,2,"Ruby");
INSERT INTO question (questionsId,sortorder,label) VALUES (10,3,"Python");
INSERT INTO question (questionsId,sortorder,label) VALUES (10,4,"JavaScript");