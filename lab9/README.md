Colleen - Completed part one and 1-5 of part two. Decided to change the phone into a varchar instead of an int to fix the size issue, as well as ensure that preceding 0's wouldn't be cut off.
Charles - Completed Part two 6-10.
Patricia - Completed some of Part 3. 
	- HTML forms for index.php
	- minor CSS: fonts, positioning
	- database connection + functionality for adding students

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

INSERT INTO grades(id, crn, RIN, grade)
VALUES (1, 94632, 661610000, 69);
INSERT INTO grades(id, crn, RIN, grade)
VALUES (2, 27709, 661810552, 98);
INSERT INTO grades(id, crn, RIN, grade)
VALUES (3, 27709, 661510768, 74);
INSERT INTO grades(id, crn, RIN, grade)
VALUES (4, 27709, 661712345, 99);
INSERT INTO grades(id, crn, RIN, grade)
VALUES (5, 25870, 661610000, 69);
INSERT INTO grades(id, crn, RIN, grade)
VALUES (6, 25870, 661810552, 100);
INSERT INTO grades(id, crn, RIN, grade)
VALUES (7, 25870, 661510768, 74);
INSERT INTO grades(id, crn, RIN, grade)
VALUES (8, 94632, 661712345, 75);
INSERT INTO grades(id, crn, RIN, grade)
VALUES (9, 27709, 661610000, 87);
INSERT INTO grades(id, crn, RIN, grade)
VALUES (10, 46443, 661810552, 87);

SELECT \* FROM students ORDER BY RIN, lname, RCSID, fname;

RIN RCSID fname lname alias phone street city state zip
661510768 wheelc Clifford Wheeler Cliff 2147483647 1445 Payne Street Wytheville Virginia 24382
661610000 galles Stephen Gallegos Stephen 2036975822 4509 Asylum Avenue Wallingford Connecticut 6492
661712345 vasqua Amanda Vasquez Amanda 2147483647 3075 Norma Avenue Blanchard Texas 77530
661810552 andrea Andrea Andrews Andrea 2147483647 1195 Hillcrest Drive Tacoma Washington 98402

SELECT RIN, fname, lname, street, city, state , zip FROM students
WHERE RIN IN(SELECT RIN FROM grades WHERE grade > 90)

RIN fname lname street city state zip
661712345 Amanda Vasquez 3075 Norma Avenue Blanchard Texas 77530
661810552 Andrea Andrews 1195 Hillcrest Drive Tacoma Washington 98402

SELECT c.prefix, c.number, c.title, g.crn, AVG(g.grade) AS AverageGrade FROM courses AS c INNER JOIN grades AS g ON c.crn = g.crn GROUP BY g.crn

prefix number title crn AverageGrade
ITWS 4310 Managing IT Resources 25870 81.0000
ITWS 2110 Web Systems Development 27709 89.5000
CSCI 1100 Computer Science I 46443 87.0000
PSYC 4730 Positive Psychology 94632 72.0000

SELECT c.prefix, c.number, c.title, g.crn, COUNT(g.crn) AS NumberStudents FROM courses AS c INNER JOIN grades AS g ON c.crn = g.crn GROUP BY g.crn

prefix number title crn NumberStudents
ITWS 4310 Managing IT Resources 25870 3
ITWS 2110 Web Systems Development 27709 4
CSCI 1100 Computer Science I 46443 1
PSYC 4730 Positive Psychology 94632 2
