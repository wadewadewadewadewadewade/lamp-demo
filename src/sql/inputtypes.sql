CREATE TABLE inputtypes (
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
     label CHAR(255) NOT NULL,
     PRIMARY KEY (id)
)   ENGINE=INNODB;

INSERT INTO inputtypes (label) VALUES ('radio');
INSERT INTO inputtypes (label) VALUES ('checkbox');