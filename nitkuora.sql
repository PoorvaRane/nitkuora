-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2015 at 08:18 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nitkuora`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
`answer_id` int(10) NOT NULL,
  `answer_name` varchar(250) NOT NULL,
  `a_question_id` int(10) NOT NULL,
  `a_user_id` varchar(20) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `no_comments` int(3) NOT NULL,
  `no_upvotes` int(5) NOT NULL,
  `no_downvotes` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `answer_name`, `a_question_id`, `a_user_id`, `timestamp`, `no_comments`, `no_upvotes`, `no_downvotes`) VALUES
(1, 'ghjkbb jh  bk ', 767678, 'nidhi', '2015-11-12 11:55:28', 0, 0, 0),
(2, 'NIdhi sbeifie', 767678, 'nidhi', '2015-11-12 12:04:16', 0, 0, 0);

--
-- Triggers `answer`
--
DELIMITER //
CREATE TRIGGER `answer` AFTER INSERT ON `answer`
 FOR EACH ROW begin
declare coun int;
select count(*) into coun from audit;
set coun=coun+1;
insert into audit (audit_id,user1_id,answer_id) values (coun,new.a_user_id,new.answer_id);
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE IF NOT EXISTS `audit` (
  `audit_id` int(8) NOT NULL,
  `user1_id` varchar(8) NOT NULL,
  `user2_id` varchar(8) DEFAULT NULL,
  `question_id` int(8) DEFAULT NULL,
  `answer_id` int(8) DEFAULT NULL,
  `comment_id` int(8) DEFAULT NULL,
  `upvote_id` int(8) DEFAULT NULL,
  `downvote_id` int(8) NOT NULL,
  `topic_id` int(8) DEFAULT NULL,
  `time` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`audit_id`, `user1_id`, `user2_id`, `question_id`, `answer_id`, `comment_id`, `upvote_id`, `downvote_id`, `topic_id`, `time`) VALUES
(1, 'nidhi', NULL, 767677, NULL, NULL, NULL, 0, NULL, '0000-00-00 00:00:00.000000'),
(2, 'nidhi', NULL, 767678, NULL, NULL, NULL, 0, NULL, '0000-00-00 00:00:00.000000'),
(3, 'nidhi', NULL, 767679, NULL, NULL, NULL, 0, NULL, '0000-00-00 00:00:00.000000'),
(4, 'nidhi', NULL, 767680, NULL, NULL, NULL, 0, NULL, '0000-00-00 00:00:00.000000'),
(5, 'nidhi', NULL, 767681, NULL, NULL, NULL, 0, NULL, '0000-00-00 00:00:00.000000'),
(6, 'nidhi', NULL, 767682, NULL, NULL, NULL, 0, NULL, '0000-00-00 00:00:00.000000'),
(7, 'nidhi', NULL, 767683, NULL, NULL, NULL, 0, NULL, '0000-00-00 00:00:00.000000'),
(8, 'nidhi', NULL, NULL, 1, NULL, NULL, 0, NULL, '0000-00-00 00:00:00.000000'),
(9, 'nidhi', NULL, NULL, 2, NULL, NULL, 0, NULL, '0000-00-00 00:00:00.000000'),
(10, 'poorva', NULL, 767684, NULL, NULL, NULL, 0, NULL, '0000-00-00 00:00:00.000000'),
(11, 'nidhi', NULL, NULL, NULL, 1, NULL, 0, NULL, '0000-00-00 00:00:00.000000'),
(12, 'nidhi', NULL, NULL, NULL, 2, NULL, 0, NULL, '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
`comment_id` int(10) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `c_user_id` varchar(20) NOT NULL,
  `c_answer_id` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment`, `c_user_id`, `c_answer_id`, `timestamp`) VALUES
(1, 'sdvfb', 'nidhi', 0, '2015-11-12 06:59:10'),
(2, 'Nifdhdov', 'nidhi', 0, '2015-11-12 06:59:44');

--
-- Triggers `comment`
--
DELIMITER //
CREATE TRIGGER `comment` AFTER INSERT ON `comment`
 FOR EACH ROW begin
declare coun int;
select count(*) into coun from audit;
set coun=coun+1;
insert into audit (audit_id,user1_id,comment_id) values (coun,new.c_user_id,new.comment_id);
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `downvote`
--

CREATE TABLE IF NOT EXISTS `downvote` (
`downvote_id` int(10) NOT NULL,
  `d_user_id` varchar(20) NOT NULL,
  `d_answer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Triggers `downvote`
--
DELIMITER //
CREATE TRIGGER `downvote` AFTER INSERT ON `downvote`
 FOR EACH ROW begin
declare coun int;
select count(*) into coun from audit;
set coun=coun+1;
insert into audit (audit_id,user1_id,downvote_id) values (coun,new.d_user_id,new.downvote_id);
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `follower_following`
--

CREATE TABLE IF NOT EXISTS `follower_following` (
  `user1_id` varchar(20) NOT NULL,
  `user2_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follower_following`
--

INSERT INTO `follower_following` (`user1_id`, `user2_id`) VALUES
('nidhi', 'bala'),
('nidhi', 'deepthi'),
('nidhi', 'poorva'),
('nidhi', 'shruti');

-- --------------------------------------------------------

--
-- Table structure for table `follower_topic`
--

CREATE TABLE IF NOT EXISTS `follower_topic` (
  `user_id` varchar(20) NOT NULL,
  `topic_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follower_topic`
--

INSERT INTO `follower_topic` (`user_id`, `topic_id`) VALUES
('nidhi', 1),
('poorva', 1),
('bala', 2),
('nidhi', 2),
('shruti', 2),
('deepthi', 3),
('nidhi', 3),
('shruti', 3);

--
-- Triggers `follower_topic`
--
DELIMITER //
CREATE TRIGGER `t_no_followers` AFTER INSERT ON `follower_topic`
 FOR EACH ROW BEGIN
 
    UPDATE topic
    SET no_followers = no_followers + 1 WHERE topic_id = NEW.topic_id ; 
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`question_id` int(10) NOT NULL,
  `question_name` varchar(100) NOT NULL,
  `q_user_id` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `no_answers` int(5) NOT NULL DEFAULT '0',
  `no_topic` int(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=767685 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `question_name`, `q_user_id`, `timestamp`, `no_answers`, `no_topic`) VALUES
(767678, 'sdfvsdc', 'nidhi', '2015-11-09 16:05:34', 0, 1),
(767679, 'xx', 'nidhi', '2015-11-12 06:22:27', 0, 1),
(767681, ' cx cx', 'nidhi', '2015-11-12 06:22:51', 0, 1),
(767683, 'Question 1', 'nidhi', '2015-11-12 06:23:31', 0, 1),
(767684, 'blahhhhh', 'poorva', '2015-11-12 06:51:01', 0, 1);

--
-- Triggers `question`
--
DELIMITER //
CREATE TRIGGER `question` AFTER INSERT ON `question`
 FOR EACH ROW begin
declare coun int;
select count(*) into coun from audit;
set coun=coun+1;
insert into audit (audit_id,user1_id,question_id) values (coun,new.q_user_id,new.question_id);
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
`topic_id` int(10) NOT NULL,
  `topic_name` varchar(30) NOT NULL,
  `topic_description` varchar(300) NOT NULL,
  `no_followers` int(5) NOT NULL,
  `no_questions` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`topic_id`, `topic_name`, `topic_description`, `no_followers`, `no_questions`) VALUES
(1, 'Science', 'Science is la la la ', 2, 4),
(2, 'Philosophy', 'It is la la la la la', 3, 1),
(3, 'Animals', 'la la la la la ', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `topic_question`
--

CREATE TABLE IF NOT EXISTS `topic_question` (
  `topic_id` int(10) NOT NULL,
  `question_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic_question`
--

INSERT INTO `topic_question` (`topic_id`, `question_id`) VALUES
(1, 767678),
(1, 767679),
(1, 767681),
(1, 767683),
(2, 767684);

--
-- Triggers `topic_question`
--
DELIMITER //
CREATE TRIGGER `t_no_questions` AFTER INSERT ON `topic_question`
 FOR EACH ROW BEGIN
 
    UPDATE topic
    SET no_questions = no_questions + 1 WHERE topic_id = NEW.topic_id ; 
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `upvote`
--

CREATE TABLE IF NOT EXISTS `upvote` (
`upvote_id` int(10) NOT NULL,
  `u_user_id` varchar(20) NOT NULL,
  `u_answer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Triggers `upvote`
--
DELIMITER //
CREATE TRIGGER `upvote` AFTER INSERT ON `upvote`
 FOR EACH ROW begin
declare coun int;
select count(*) into coun from audit;
set coun=coun+1;
insert into audit (audit_id,user1_id,upvote_id) values (coun,new.u_user_id,new.upvote_id);
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `bio` longtext NOT NULL,
  `no_followers` int(5) NOT NULL DEFAULT '0',
  `no_topics_followed` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `picture`, `bio`, `no_followers`, `no_topics_followed`) VALUES
('bala', 'Balaji', 'b@b.com', 'b', NULL, 'I am Balaa', 0, 1),
('deepthi', 'Deepthi', 'd@d.com', 'd', NULL, 'DEEP THI', 0, 1),
('nidhi', 'Nidhi', 'nidhisridhar@gmail.com', 'n', NULL, 'Blah', 0, 3),
('poorva', 'Poorva', 'p@p.com', 'p', NULL, 'POOOOOOOO', 0, 1),
('shruti', 'Shruti', 's@s.com', 's', NULL, 'shruuuu', 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
 ADD PRIMARY KEY (`answer_id`), ADD KEY `afkey1` (`a_user_id`), ADD KEY `afkey2` (`a_question_id`);

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
 ADD PRIMARY KEY (`audit_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`comment_id`), ADD KEY `cfkey1` (`c_user_id`), ADD KEY `cfkey2` (`c_answer_id`);

--
-- Indexes for table `downvote`
--
ALTER TABLE `downvote`
 ADD PRIMARY KEY (`downvote_id`), ADD KEY `dfkey2` (`d_answer_id`), ADD KEY `dfkey1` (`d_user_id`);

--
-- Indexes for table `follower_following`
--
ALTER TABLE `follower_following`
 ADD PRIMARY KEY (`user1_id`,`user2_id`), ADD KEY `fffkey2` (`user2_id`);

--
-- Indexes for table `follower_topic`
--
ALTER TABLE `follower_topic`
 ADD PRIMARY KEY (`user_id`,`topic_id`), ADD KEY `ftfkey2` (`topic_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`question_id`), ADD UNIQUE KEY `question_name` (`question_name`), ADD KEY `qfkey` (`q_user_id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
 ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `topic_question`
--
ALTER TABLE `topic_question`
 ADD PRIMARY KEY (`topic_id`,`question_id`), ADD KEY `tqfkey2` (`question_id`);

--
-- Indexes for table `upvote`
--
ALTER TABLE `upvote`
 ADD PRIMARY KEY (`upvote_id`), ADD KEY `ufkey1` (`u_user_id`), ADD KEY `ufkey2` (`u_answer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
MODIFY `answer_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `downvote`
--
ALTER TABLE `downvote`
MODIFY `downvote_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
MODIFY `question_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=767685;
--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
MODIFY `topic_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `upvote`
--
ALTER TABLE `upvote`
MODIFY `upvote_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `question`
--
ALTER TABLE `question`
ADD CONSTRAINT `qfkey` FOREIGN KEY (`q_user_id`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
