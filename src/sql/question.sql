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

INSERT INTO question (questionsId,sortorder,label) VALUES (1,1,"Male");
INSERT INTO question (questionsId,sortorder,label) VALUES (1,2,"Female");
INSERT INTO question (questionsId,sortorder,label) VALUES (2,1,"Married");
INSERT INTO question (questionsId,sortorder,label) VALUES (2,2,"Single");
INSERT INTO question (questionsId,sortorder,label) VALUES (2,3,"Divorced");
INSERT INTO question (questionsId,sortorder,label) VALUES (2,4,"Widowed");
INSERT INTO question (questionsId,sortorder,label) VALUES (2,5,"Separated");
INSERT INTO question (questionsId,sortorder,label) VALUES (2,6,"In a relationship");
INSERT INTO question (questionsId,sortorder,label) VALUES (3,1,"Canada");
INSERT INTO question (questionsId,sortorder,label) VALUES (3,2,"Italy");
INSERT INTO question (questionsId,sortorder,label) VALUES (3,3,"Australia");
INSERT INTO question (questionsId,sortorder,label) VALUES (3,4,"Hong Kong");
INSERT INTO question (questionsId,sortorder,label) VALUES (3,5,"Russia");
INSERT INTO question (questionsId,sortorder,label) VALUES (3,6,"Belgium");
INSERT INTO question (questionsId,sortorder,label) VALUES (4,1,"Football");
INSERT INTO question (questionsId,sortorder,label) VALUES (4,2,"basketball");
INSERT INTO question (questionsId,sortorder,label) VALUES (4,3,"Baseball");
INSERT INTO question (questionsId,sortorder,label) VALUES (4,4,"Hockey");
INSERT INTO question (questionsId,sortorder,label) VALUES (4,5,"None");
INSERT INTO question (questionsId,sortorder,label) VALUES (5,1,"PHP");
INSERT INTO question (questionsId,sortorder,label) VALUES (5,2,"Ruby");
INSERT INTO question (questionsId,sortorder,label) VALUES (5,3,"Python");
INSERT INTO question (questionsId,sortorder,label) VALUES (5,4,"JavaScript");