-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 13, 2024 at 05:19 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pza-project`
--
CREATE DATABASE IF NOT EXISTS `pza-project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `pza-project`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` varchar(10) DEFAULT 'draft',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(12, 'Communication Skills', 'published'),
(11, 'Psychology of Success', 'published'),
(10, 'Personal Development', 'published'),
(9, 'Life Balance', 'published'),
(8, 'Self-Care', 'published'),
(13, 'Professional Development', 'published'),
(14, 'Wellness', 'published'),
(15, 'Productivity Tips', 'published'),
(16, 'Time Management', 'published'),
(17, 'Nature Exploration', 'published'),
(18, 'Travel and Adventure', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'draft',
  `summary` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image`, `created_at`, `status`, `summary`) VALUES
(31, 'The Art of Mindful Living: Finding Peace in a Hectic World', '<figure class=\"image image-style-side\"><img style=\"aspect-ratio:1024/1024;\" src=\"http://vanilla-php-blog.com/uploads/the-art-of-mindful-living.png\" width=\"1024\" height=\"1024\"></figure><p>&nbsp;</p><p>In our fast-paced society, finding moments of peace and tranquility can seem like a distant dream. Explore the principles of mindful living in this post, and discover how you can cultivate mindfulness in your daily life. From practicing gratitude to embracing the present moment, learn how mindfulness can help you find serenity amidst the chaos.</p>', 'the-art-of-mindful-living.png', '2024-06-12 12:10:56', 'published', 'In our fast-paced society, finding moments of peace and tranquility can seem like a distant dream. Explore the principles of mindful living in this post, and discover how you can cultivate mindfulness in your daily life. From practicing gratitude to embracing the present moment, learn how mindfulness can help you find serenity amidst the chaos.'),
(32, 'Unlocking the Power of Positive Thinking', '<figure class=\"image image-style-side\"><img style=\"aspect-ratio:1024/1024;\" src=\"http://vanilla-php-blog.com/uploads/unlocking-the-power-of-positive-thinking.png\" width=\"1024\" height=\"1024\"></figure><p>&nbsp;</p><p>Your thoughts have the power to shape your reality. In this post, we delve into the transformative effects of positive thinking. Discover how adopting a positive mindset can improve your mood, enhance your relationships, and even boost your physical health. With a few simple mindset shifts, you can unleash the incredible power of positivity in your life.</p>', 'unlocking-the-power-of-positive-thinking.png', '2024-06-12 12:10:56', 'published', 'Your thoughts have the power to shape your reality. In this post, we delve into the transformative effects of positive thinking. Discover how adopting a positive mindset can improve your mood, enhance your relationships, and even boost your physical health. With a few simple mindset shifts, you can unleash the incredible power of positivity in your life.'),
(34, 'Mastering the Art of Effective Communication', '<figure class=\"image image-style-side\"><img style=\"aspect-ratio:1024/1024;\" src=\"http://vanilla-php-blog.com/uploads/mastering-the-art-of-effective-communication.png\" width=\"1024\" height=\"1024\"></figure><p>&nbsp;</p><p>Communication is the cornerstone of every successful relationship, both personally and professionally. In this post, we share practical tips for enhancing your communication skills and fostering meaningful connections with others. From active listening to assertive expression, learn how to communicate with clarity, empathy, and confidence. Unlock the secrets to becoming a master communicator today!</p>', 'mastering-the-art-of-effective-communication.png', '2024-06-12 12:10:56', 'published', 'Communication is the cornerstone of every successful relationship, both personally and professionally. In this post, we share practical tips for enhancing your communication skills and fostering meaningful connections with others. From active listening to assertive expression, learn how to communicate with clarity, empathy, and confidence. Unlock the secrets to becoming a master communicator today!'),
(33, 'The Ultimate Guide to Self-Care: Prioritizing Your Well-being', '<figure class=\"image image-style-side\"><img style=\"aspect-ratio:1024/1024;\" src=\"http://vanilla-php-blog.com/uploads/the-ultimate-guide-to-selfcare-prioritizing-your-wellbeing.png\" width=\"1024\" height=\"1024\"></figure><p>&nbsp;</p><p>Self-care isn\'t just a luxury—it\'s a necessity for maintaining your physical, emotional, and mental health. In this comprehensive guide, we explore the various aspects of self-care, from nourishing your body with healthy food to nurturing your soul with activities you love. Make self-care a priority and watch as your overall well-being flourishes.</p>', 'the-ultimate-guide-to-selfcare-prioritizing-your-wellbeing.png', '2024-06-12 12:10:56', 'published', 'Self-care isn\'t just a luxury—it\'s a necessity for maintaining your physical, emotional, and mental health. In this comprehensive guide, we explore the various aspects of self-care, from nourishing your body with healthy food to nurturing your soul with activities you love. Make self-care a priority and watch as your overall well-being flourishes.'),
(30, '10 Easy Ways to Boost Your Productivity', '<figure class=\"image image-style-side\"><img style=\"aspect-ratio:1024/1024;\" src=\"http://vanilla-php-blog.com/uploads/10-easy-ways-to-boost-your-productivity.png\" width=\"1024\" height=\"1024\"></figure><p>&nbsp;</p><p>Are you struggling to stay focused and efficient throughout the day? Here are ten simple techniques to supercharge your productivity. From setting specific goals to mastering time management skills, these tips will help you accomplish more in less time, leaving you feeling accomplished and in control of your schedule.</p>', '10-easy-ways-to-boost-your-productivity.png', '2024-06-12 12:10:56', 'published', 'Are you struggling to stay focused and efficient throughout the day? Here are ten simple techniques to supercharge your productivity. From setting specific goals to mastering time management skills, these tips will help you accomplish more in less time, leaving you feeling accomplished and in control of your schedule.'),
(36, 'Exploring the Wonders of Nature', '<p>In the heart of the lush green forest, where the sunlight dances through the leaves, lies a world of enchantment waiting to be discovered. From the tranquil streams to the towering trees, every corner is filled with life and beauty. Join us on a journey to explore the wonders of nature.<br>&nbsp;</p><figure class=\"image\"><img style=\"aspect-ratio:1024/1024;\" src=\"http://vanilla-php-blog.com/uploads/exploring-the-wonders-of-nature.png\" width=\"1024\" height=\"1024\"></figure>', 'exploring-the-wonders-of-nature.png', '2024-06-12 17:12:48', 'published', 'In the heart of the lush green forest, where the sunlight dances through the leaves, lies a world of enchantment waiting to be discovered. From the tranquil streams to the towering trees, every corner is filled with life and beauty. Join us on a journey to explore the wonders of nature.');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
CREATE TABLE IF NOT EXISTS `post_categories` (
  `post_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`post_id`, `category_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(30, 15),
(30, 16),
(31, 8),
(32, 10),
(32, 11),
(33, 8),
(33, 14),
(34, 12),
(34, 13),
(36, 17),
(36, 18),
(44, 1),
(44, 3),
(44, 7);

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
CREATE TABLE IF NOT EXISTS `post_tags` (
  `post_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(30, 20),
(30, 21),
(30, 26),
(31, 13),
(31, 14),
(31, 25),
(32, 15),
(32, 16),
(32, 25),
(33, 13),
(33, 14),
(33, 24),
(34, 17),
(34, 18),
(34, 24),
(36, 22),
(36, 23),
(36, 26),
(41, 3),
(41, 4),
(41, 5),
(41, 6),
(41, 7),
(41, 8),
(41, 9),
(42, 6),
(42, 7),
(43, 4),
(43, 5),
(43, 6),
(44, 4),
(44, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` varchar(10) DEFAULT 'draft',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `status`) VALUES
(18, 'Active Listening', 'published'),
(15, 'Positive Mindset', 'published'),
(17, 'Effective Speaking', 'published'),
(16, 'Motivation', 'published'),
(14, 'Stress Management', 'published'),
(13, 'Mindfulness Practices', 'published'),
(20, 'Goal Setting', 'published'),
(21, 'Organization', 'published'),
(22, 'Nature Photography', 'published'),
(23, 'Wildlife Observation', 'published'),
(24, 'Popular', 'published'),
(25, 'Trending', 'published'),
(26, 'Latest', 'published');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
