Colleen - Completed part one and 1-5 of part two. Decided to change the phone into a varchar instead of an int to fix the size issue, as well as ensure that preceding 0's wouldn't be cut off.




## Part One

CREATE TABLE Courses (  
    crn INT(11),  
    prefix VARCHAR(4) NOT NULL,  
    number SMALLINT(4) NOT NULL,  
    title VARCHAR(255) NOT NULL,  
    PRIMARY KEY (crn)  
);

CREATE TABLE students (  
    RIN INT(9),  
    RCSID CHAR(7),  
    fname VARCHAR(100) NOT NULL,  
    lname VARCHAR(100) NOT NULL,  
    alias VARCHAR(100) NOT NULL,  
    phone INT(10),  
    PRIMARY KEY(RIN)  
);  

## Part Two

ALTER TABLE students  
	ADD street VARCHAR(255);  
ALTER TABLE students  
	ADD city VARCHAR(100);  
ALTER TABLE students  
	ADD state VARCHAR(100);  
ALTER TABLE students  
	ADD zip VARCHAR(5);  

ALTER TABLE courses  
	ADD section INT(2);  
ALTER TABLE courses  
	ADD year INT(4);  

CREATE TABLE grades (  
  id INT(10) AUTO_INCREMENT,  
  crn INT(11),  
  RIN INT(9),  
  grade INT(3) NOT NULL,  
  PRIMARY KEY (id),  
  FOREIGN KEY (crn) REFERENCES courses(crn),  
  FOREIGN KEY (RIN) REFERENCES students(RIN)  
);  

INSERT INTO courses(crn, prefix, number, title, section, year)  
VALUES (27709, 'ITWS', 2110, 'Web Systems Development', 01, 2020);  
INSERT INTO courses(crn, prefix, number, title, section, year)  
VALUES (25870, 'ITWS', 4310, 'Managing IT Resources', 01, 2020);  
INSERT INTO courses(crn, prefix, number, title, section, year)  
VALUES (94632, 'PSYC', 4730, 'Positive Psychology', 01, 2020);  
INSERT INTO courses(crn, prefix, number, title, section, year)  
VALUES (46443, 'CSCI', 1100, 'Computer Science I', 06, 2017);  

INSERT INTO students(RIN, RCSID, fname, lname, alias, phone, street, city, state, zip)  
VALUES (661610000, 'galles', 'Stephen', 'Gallegos', 'Stephen', '2036975822', '4509 Asylum Avenue', 'Wallingford', 'Connecticut', 06492);  
INSERT INTO students(RIN, RCSID, fname, lname, alias, phone, street, city, state, zip)  
VALUES (661712345, 'vasqua', 'Amanda', 'Vasquez', 'Amanda', '9369672651', '3075 Norma Avenue', 'Blanchard', 'Texas', 77530);  
INSERT INTO students(RIN, RCSID, fname, lname, alias, phone, street, city, state, zip)  
VALUES (661510768, 'wheelc', 'Clifford', 'Wheeler', 'Cliff', '2767797126', '1445 Payne Street', 'Wytheville', 'Virginia', 24382);  
INSERT INTO students(RIN, RCSID, fname, lname, alias, phone, street, city, state, zip)  
VALUES (661810552, 'andrea', 'Andrea', 'Andrews', 'Andrea', '2532670487', '1195 Hillcrest Drive', 'Tacoma', 'Washington', 98402);  
