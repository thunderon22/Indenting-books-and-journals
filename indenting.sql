-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 22, 2023 at 08:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indenting`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_new_books`
--

CREATE TABLE `add_new_books` (
  `book_name` varchar(50) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `edition` varchar(5) DEFAULT NULL,
  `isbn` varchar(20) NOT NULL,
  `publisher` varchar(50) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `cost` int(10) DEFAULT NULL,
  `field` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_new_books`
--

INSERT INTO `add_new_books` (`book_name`, `author`, `edition`, `isbn`, `publisher`, `year`, `cost`, `field`) VALUES
('To Kill a Mockingbird', 'Harper Lee', '50th ', '978-0-06-112008-4', 'HarperCollins', 1960, 1500, 'Fiction'),
('Database System Concepts', 'Abraham Silberschatz, Henry F. Korth, S. Sudarshan', '7th', '978-0-07-802215-9', 'McGraw-Hill Education', 2019, 6000, 'Databases'),
('Computer Networks', 'Andrew S. Tanenbaum, David J. Wetherall', '5th', '978-0-13-212695-3', 'Pearson', 2010, 4000, 'Networking'),
('Clean Code: A Handbook of Agile Software Craftsman', 'Robert C. Martin', '1st', '978-0-13-235088-4', 'Prentice Hall', 2008, 2500, 'Software Development'),
('Artificial Intelligence: A Modern Approach', 'Stuart Russell, Peter Norvig', '4th', '978-0-13-461099-5', 'Pearson', 2020, 5000, 'Artificial Intelligence'),
('The Pragmatic Programmer: Your Journey to Mastery', 'Andrew Hunt, David Thomas', '20th ', '978-0-13-595705-9', 'Addison-Wesley Professional', 2019, 3000, 'Software Development'),
('Introduction to Algorithms', 'Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, Clifford Stein', '3rd', '978-0-262-53305-8', 'MIT Press', 2009, 4500, 'Computer Science'),
('Introduction to Psychology', 'James W. Kalat', '11th', '978-1-133-94131-5', 'Cengage Learning', 2016, 900, 'Psychology'),
('Data Science for Beginners', 'Jake VanderPlas', '1st', '978-1-234-56789-0', 'O-Reilly Media', 2022, 3000, 'Data Science'),
('The Great Gatsby', 'F. Scott Fitzgerald', '1st', '978-3-16-148410-0', 'Scribner', 1925, 1600, 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `approved_books`
--

CREATE TABLE `approved_books` (
  `book_name` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `edition` varchar(5) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `cost` int(10) NOT NULL,
  `field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approved_books`
--

INSERT INTO `approved_books` (`book_name`, `author`, `edition`, `isbn`, `publisher`, `year`, `cost`, `field`) VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', '1st', '978-3-16-148410-0', 'Scribner', 1925, 1600, 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `approved_journals`
--

CREATE TABLE `approved_journals` (
  `journalName` varchar(30) NOT NULL,
  `journalNumber` int(30) NOT NULL,
  `publisher` varchar(30) NOT NULL,
  `year` int(4) NOT NULL,
  `field` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approved_journals`
--

INSERT INTO `approved_journals` (`journalName`, `journalNumber`, `publisher`, `year`, `field`) VALUES
('Journal 7', 97531, 'Health Sciences', 2021, 'Health');

-- --------------------------------------------------------

--
-- Table structure for table `create_new_user`
--

CREATE TABLE `create_new_user` (
  `fname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `create_new_user`
--

INSERT INTO `create_new_user` (`fname`, `username`, `password`) VALUES
('Mulkalla Naveen', 'naveen@gmail.com', 'Naveen_891'),
('Praveen', 'praveen@gmail.com', 'Pra298_1'),
('Raghu Nani', 'raghu@gmail.com', 'Niousd98#'),
('Sumanth', 'suman@gmail.com', 'Suman_848'),
('Sunny', 'sunny@gmail.com', 'Sunny_567');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `journalName` varchar(30) NOT NULL,
  `journalNumber` int(30) NOT NULL,
  `publisher` varchar(30) NOT NULL,
  `year` int(4) NOT NULL,
  `field` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`journalName`, `journalNumber`, `publisher`, `year`, `field`) VALUES
('Cognitive Science', 49734, 'Oxford', 2000, 'Computer Science'),
('Hello', 97343, 'MIT Press', 2019, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `suggested_books`
--

CREATE TABLE `suggested_books` (
  `book_name` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `edition` varchar(5) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `cost` int(10) NOT NULL,
  `field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggested_books`
--

INSERT INTO `suggested_books` (`book_name`, `author`, `edition`, `isbn`, `publisher`, `year`, `cost`, `field`) VALUES
('Computer Networks', 'Andrew S. Tanenbaum, David J. Wetherall', '5th', '978-0-13-212695-3', 'Pearson', 2010, 4000, 'Networking');

-- --------------------------------------------------------

--
-- Table structure for table `suggested_journals`
--

CREATE TABLE `suggested_journals` (
  `journalName` varchar(30) NOT NULL,
  `journalNumber` int(30) NOT NULL,
  `publisher` varchar(30) NOT NULL,
  `year` int(4) NOT NULL,
  `field` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggested_journals`
--

INSERT INTO `suggested_journals` (`journalName`, `journalNumber`, `publisher`, `year`, `field`) VALUES
('Journal 1', 12345, ' ABC Publications', 2023, ' Science'),
('Journal 7', 97531, 'Health Sciences', 2021, 'Health');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
('1', 'admin1@gmail.com', 'Password@123'),
('2', 'admin2@gmail.com', 'Password_123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_new_books`
--
ALTER TABLE `add_new_books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `approved_books`
--
ALTER TABLE `approved_books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `approved_journals`
--
ALTER TABLE `approved_journals`
  ADD PRIMARY KEY (`journalNumber`);

--
-- Indexes for table `create_new_user`
--
ALTER TABLE `create_new_user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`journalNumber`);

--
-- Indexes for table `suggested_books`
--
ALTER TABLE `suggested_books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `suggested_journals`
--
ALTER TABLE `suggested_journals`
  ADD PRIMARY KEY (`journalNumber`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
