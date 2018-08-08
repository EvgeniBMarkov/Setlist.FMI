SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `setlistfmi` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `setlistfmi`;

CREATE TABLE `courses` (
  `id` mediumint(9) NOT NULL,
  `title` varchar(60) NOT NULL,
  `lecturer` varchar(60) NOT NULL,
  `discipline` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `courses` (`id`, `title`, `lecturer`, `discipline`) VALUES
(1, 'Last Dance', 'Tom Petty', 'Rock'),
(2, 'Fade to Black', 'Metallica', 'Metal'),
(3, 'subject1', 'mod', 'SI'),
(4, 'subject2', 'mod', 'KN');

CREATE TABLE `enrollment` (
  `FacID` mediumint(8) UNSIGNED NOT NULL,
  `CourseID` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `enrollment` (`FacID`, `CourseID`) VALUES
(0, 1),
(1, 2),
(2, 1),
(2, 2),
(1, 3),
(2, 3),
(1, 4),
(2, 4);

CREATE TABLE `users` (
  `FacID` mediumint(9) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Clearance` int(11) NOT NULL,
  `Fullname` varchar(60) NOT NULL,
  `Email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`FacID`, `Username`, `Password`, `Clearance`, `Fullname`, `Email`) VALUES
(0, 'admin', 'admin', 0, '', 'eugenious96@gmail.com'),
(1, 'mod', 'mod', 1, '', 'evgenibmarkov@gmail.com'),
(2, 'user', 'user', 2, '', '');

CREATE TABLE `videos` (
  `VideoLink` varchar(127) NOT NULL,
  `CourseID` smallint(5) UNSIGNED NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `videos` (`VideoLink`, `CourseID`, `Date`) VALUES
('https://www.youtube.com/watch?v=aowSGxim_O8', 1, '2018-06-30 13:01:50'),
('https://www.youtube.com/watch?v=SMSZALOGF_M', 1, '2018-06-30 13:02:20'),
('https://www.youtube.com/watch?v=8BfG_GQSf-E', 1, '2018-06-30 13:03:51'),
('https://www.youtube.com/watch?v=WEQnzs8wl6E', 2, '2018-06-30 13:11:22'),
('https://www.youtube.com/watch?v=0FMfsT11pdA', 2, '2018-06-30 13:11:50');


ALTER TABLE `courses`
  ADD UNIQUE KEY `courseid` (`id`);

ALTER TABLE `enrollment`
  ADD KEY `FacID` (`FacID`);

ALTER TABLE `users`
  ADD KEY `FacID` (`FacID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
