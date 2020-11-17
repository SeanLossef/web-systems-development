-- Dumping structure for table websyslab9.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `crn` int(11) NOT NULL,
  `prefix` varchar(4) NOT NULL,
  `number` smallint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `section` int(2) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  PRIMARY KEY (`crn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `courses` (`crn`, `prefix`, `number`, `title`, `section`, `year`) VALUES
	(25870, 'ITWS', 4310, 'Managing IT Resources', 1, 2020),
	(27709, 'ITWS', 2110, 'Web Systems Development', 1, 2020),
	(46443, 'CSCI', 1100, 'Computer Science I', 6, 2017),
	(94632, 'PSYC', 4730, 'Positive Psychology', 1, 2020);

-- Dumping structure for table websyslab9.grades
CREATE TABLE IF NOT EXISTS `grades` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `crn` int(11) DEFAULT NULL,
  `RIN` int(9) DEFAULT NULL,
  `grade` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `crn` (`crn`),
  KEY `RIN` (`RIN`),
  CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`crn`) REFERENCES `courses` (`crn`),
  CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`RIN`) REFERENCES `students` (`RIN`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO `grades` (`id`, `crn`, `RIN`, `grade`) VALUES
	(1, 94632, 661610000, 69),
	(2, 27709, 661810552, 98),
	(3, 27709, 661510768, 74),
	(4, 27709, 661712345, 99),
	(5, 25870, 661610000, 69),
	(6, 25870, 661810552, 100),
	(7, 25870, 661510768, 74),
	(8, 94632, 661712345, 75),
	(9, 27709, 661610000, 87),
	(10, 46443, 661810552, 87);

-- Dumping structure for table websyslab9.students
CREATE TABLE IF NOT EXISTS `students` (
  `RIN` int(9) NOT NULL,
  `RCSID` char(7) DEFAULT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `phone` int(10) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`RIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `students` (`RIN`, `RCSID`, `fname`, `lname`, `alias`, `phone`, `street`, `city`, `state`, `zip`) VALUES
	(661510768, 'wheelc', 'Clifford', 'Wheeler', 'Cliff', 2147483647, '1445 Payne Street', 'Wytheville', 'Virginia', '24382'),
	(661610000, 'galles', 'Stephen', 'Gallegos', 'Stephen', 2036975822, '4509 Asylum Avenue', 'Wallingford', 'Connecticut', '6492'),
	(661712345, 'vasqua', 'Amanda', 'Vasquez', 'Amanda', 2147483647, '3075 Norma Avenue', 'Blanchard', 'Texas', '77530'),
	(661810552, 'andrea', 'Andrea', 'Andrews', 'Andrea', 2147483647, '1195 Hillcrest Drive', 'Tacoma', 'Washington', '98402');
