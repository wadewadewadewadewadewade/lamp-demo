CREATE TABLE questions (
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
     surveyId MEDIUMINT NOT NULL,
     sortorder INT DEFAULT 1,
     label CHAR(255) NOT NULL,
     inputtype INT DEFAULT 1,
     PRIMARY KEY (id),
     FOREIGN KEY (surveyId)
        REFERENCES survey(id)
        ON DELETE CASCADE,
     FOREIGN KEY (inputtype) --error 150
        REFERENCES inputtypes(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
)   ENGINE=INNODB;

INSERT INTO questions (surveyId, sortorder, label, inputtype) VALUES (1,1,"How old are you?",1);
INSERT INTO questions (surveyId, sortorder, label, inputtype) VALUES (1,2,"Are you happy?",1);
INSERT INTO questions (surveyId, sortorder, label, inputtype) VALUES (1,3,"What countries have you visited?",2);
INSERT INTO questions (surveyId, sortorder, label, inputtype) VALUES (1,4,"What is your favorite sport?",1);
INSERT INTO questions (surveyId, sortorder, label, inputtype) VALUES (1,5,"Which programming languages do you know?",2);