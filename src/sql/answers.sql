CREATE TABLE answer (
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
     questionId MEDIUMINT NOT NULL,
     userId MEDIUMINT NOT NULL,
     PRIMARY KEY (id),
     FOREIGN KEY (questionId)
        REFERENCES question(id)
        ON DELETE CASCADE
)   ENGINE=INNODB;