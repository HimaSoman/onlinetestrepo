-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2021 at 04:08 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `questionnaire`
--

-- --------------------------------------------------------

--
-- Table structure for table `online_test`
--

DROP TABLE IF EXISTS `online_test`;
CREATE TABLE IF NOT EXISTS `online_test` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(400) NOT NULL,
  `answer_type` enum('checkbox','radio','text','number','dropdown') NOT NULL,
  `answer_options` text NOT NULL,
  `child_questions` varchar(50) DEFAULT NULL,
  `parent_question_id` int(11) DEFAULT NULL,
  `parent_question_condition` varchar(500) DEFAULT NULL,
  `readonly` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_test`
--

INSERT INTO `online_test` (`question_id`, `question`, `answer_type`, `answer_options`, `child_questions`, `parent_question_id`, `parent_question_condition`, `readonly`, `status`) VALUES
(1, 'Your Name', 'text', '', NULL, 0, NULL, NULL, 1),
(2, 'Your Age', 'number', '', NULL, 0, NULL, NULL, 1),
(3, 'Your educational qualifications', 'checkbox', 'SSLC|Plus Two|Degree|Diploma|Post Graduation', NULL, 0, NULL, NULL, 1),
(4, 'Experience Level', 'dropdown', '1-2 Years|2-5 Years|5 Plus years', NULL, 0, NULL, NULL, 1),
(5, 'Gender', 'radio', 'Male|Female', NULL, 0, NULL, NULL, 1),
(6, 'Type Of test', 'radio', 'PHP|HTML|MYSQL', '7|8|9', 0, NULL, NULL, 1),
(7, 'How can I display text with a PHP script?', 'text', '', '1', 6, 's:50:\"array(\'question_id\'=>6,\'answer_condition\'=>\'PHP\');\";', 1, 1),
(8, 'How to insert a copyright symbol on a browser page?', 'text', '', '1', 6, 's:51:\"array(\'question_id\'=>6,\'answer_condition\'=>\'HTML\');\";', 1, 1),
(9, 'What are the different tables present in MySQL?', 'checkbox', 'MyISAM|Heap|Merge|INNO DB|ISAM', '1', 6, 's:52:\"array(\'question_id\'=>6,\'answer_condition\'=>\'MYSQL\');\";', 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
