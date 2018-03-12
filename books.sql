

DROP DATABASE IF EXISTS books;

CREATE DATABASE books;

DROP TABLE IF EXISTS `book_info`;

CREATE TABLE IF NOT EXISTS `book_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `review` varchar(500) NOT NULL,
  `name_of_submitter` varchar(50) NOT NULL,
  `email_of_submitter` varchar(100) NOT NULL,
  `link_to_online_store` varchar(250) NOT NULL,
  `image_of_book` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`id`, `title`, `genre`, `review`, `name_of_submitter`, `email_of_submitter`, `link_to_online_store`, `image_of_book`) VALUES
(1, '1984', 'dystopia', 'Written in 1948, 1984 was George Orwellâ€™s chilling prophecy about the future. And while 1984 has come and gone, his dystopian vision of a government that will do anything to control the narrative is timelier than ever...\r\n', 'BURAK KAYA', 'boroppi01@gmail.com', 'https://www.amazon.com/1984-Signet-Classics-George-Orwell/dp/0451524934', '1984.jpg'),
(2, 'The Hobbit', 'High fantasy', 'Bilbo Baggins is a hobbit who enjoys a comfortable, unambitious life, rarely traveling any farther than his pantry or cellar. But his contentment is disturbed when the wizard Gandalf and a company of dwarves arrive on his doorstep one day to whisk him away on an adventure.', 'BURAK KAYA', 'boroppi01@gmail.com', 'https://www.amazon.com/Hobbit-J-R-Tolkien/dp/054792822X', 'hobbit.jpg'),
(3, 'The Idiot', 'Philosophical novel', 'One of the towering figures of Russian literature, Fyodor Dostoyevsky depicted with remarkable insight the depth and complexity of the human soul. In this literary classic, he focuses on Prince Myshkin â€” a nobleman whose gentle, child-like nature, and refusal to be offended by anything has earned him the nickname of \"the idiot.\"', 'BURAK KAYA', 'boroppi01@gmail.com', 'https://www.amazon.ca/Idiot-Fyodor-Dostoyevsky/dp/0486432130/', 'theidiot.jpg');
COMMIT;

