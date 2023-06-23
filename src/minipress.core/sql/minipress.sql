-- Adminer 4.8.1 MySQL 8.0.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `article_categories`;
CREATE TABLE `article_categories` (
  `article_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`article_id`,`category_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `article_categories_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  CONSTRAINT `article_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `article_categories` (`article_id`, `category_id`) VALUES
(1,	1),
(2,	1),
(4,	1),
(5,	1),
(7,	1),
(8,	1),
(1,	2),
(3,	2),
(4,	2),
(6,	2),
(7,	2),
(2,	3),
(3,	3),
(5,	3),
(6,	3),
(8,	3);

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `resume` text,
  `contenu` text NOT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `auteur_id` int DEFAULT NULL,
  `published` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `auteur_id` (`auteur_id`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `articles` (`id`, `titre`, `resume`, `contenu`, `date_creation`, `auteur_id`, `published`) VALUES
(1,	'Article 1',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',	'# Article 1\r\n\r\n## Paragraph 1\r\n\r\nLorem ipsum dolor sit *amet*, **consectetur** a*dipiscing elit. Vivamus ut dictum nisi, quis consequat quam. Sed consectetur erat ac nisi aliquet, a hendrerit leo pellentesque.\r\n\r\n## Paragraph 2\r\n\r\nProin non mauris lobortis, hendrerit **ligula** in, ullamcorper massa. Sed sit amet neque cursus, malesuada lorem et, lacinia elit.\r\n\r\n## Paragraph 3\r\n\r\nAliquam in nibh id lorem laoreet elementum id eget mi. Quisque in lectus felis.',	'2003-06-22 12:59:34',	1,	0),
(2,	'Article 2',	'Proin non mauris lobortis, hendrerit ligula in.',	'# Article 2\r\n\r\n## Paragraph 1\r\n\r\n**Curabitur** at elit eu nunc consequat condimentum. Donec aliquam, massa et imperdiet ornare, est eros blandit ex, ut egestas nulla justo sit amet est.\r\n\r\n## Paragraph 2\r\n\r\nCras in sapien id nisi condimentum aliquet. Suspendisse potenti. Vestibulum consectetur orci non dui maximus, in elementum ligula egestas.\r\n\r\n## Paragraph 3\r\n\r\nDuis in neque enim. Sed in ornare sem, ac posuere orci. Phasellus laoreet lacinia ex, non viverra turpis pulvinar non.',	'2004-06-22 12:59:34',	2,	1),
(3,	'Article 3',	'Donec aliquam, massa et imperdiet ornare.',	'# Article 3\r\n\r\n## Paragraph 1\r\n\r\nNullam ac quam non **sem varius porta**. In id congue ante. Morbi nec erat purus. Donec a condimentum erat.\r\n\r\n## Paragraph 2\r\n\r\nPhasellus volutpat, tellus eget maximus posuere, erat ipsum pharetra lacus, ut rutrum nulla lectus at augue.\r\n\r\n## Paragraph 3\r\n\r\nEtiam cursus, sapien a eleifend gravida, dui purus tristique ipsum, id auctor quam orci non est.',	'2005-06-22 12:59:34',	2,	1),
(4,	'Article 4',	'Vestibulum consectetur orci non dui maximus.',	'# Article 4\r\n\r\n## Paragraph 1\r\n\r\nInteger commodo, sem sed vulputate rutrum, ante ligula pellentesque tellus, non viverra dui erat id lorem.\r\n\r\n## Paragraph 2\r\n\r\nVivamus cursus massa sit amet sem aliquet, non efficitur tortor interdum. Sed sem augue, auctor at efficitur id, posuere nec tellus.\r\n\r\n## Paragraph 3\r\n\r\nUt euismod tincidunt est, et porta lorem lobortis id. Integer varius, elit eget laoreet congue, diam nisl convallis diam, sit amet luctus mi neque non quam.',	'2006-06-22 12:59:34',	1,	0),
(5,	'Article 5',	'*Curabitur* at elit eu nunc **consequat** condimentum.',	'# Article 5\r\n\r\n## Paragraph 1\r\n\r\nCras sollicitudin, **justo nec pellentesque feugiat**, ligula turpis eleifend mi, at bibendum lacus mi quis libero.\r\n\r\n## Paragraph 2\r\n\r\nDuis euismod, ligula et commodo dapibus, erat erat iaculis odio, at interdum quam est in lectus.\r\n\r\n## Paragraph 3\r\n\r\nFusce consequat, ante sed rutrum gravida, turpis nulla tempus ligula, id ultrices mi turpis eget lorem.',	'2007-06-22 12:59:34',	2,	1),
(6,	'Article 6',	'Duis in neque enim. Sed in ornare sem.',	'# Article 6\r\n\r\n## Paragraph 1\r\n\r\nSed ultricies libero justo, at elementum turpis aliquam a. Donec a tortor ac neque egestas lacinia.\r\n\r\n## Paragraph 2\r\n\r\nIn quis neque at orci porttitor cursus. Pellentesque volutpat, mi ut varius vehicula, ipsum urna pulvinar nunc, et commodo nisl orci non metus.\r\n\r\n## Paragraph 3\r\n\r\nQuisque ullamcorper, felis sit amet egestas pulvinar, est ligula varius eros, non dignissim metus est sed metus.',	'2008-06-22 12:59:34',	1,	1),
(7,	'Article 7',	'Quisque ullamcorper, felis sit amet egestas pulvinar.',	'# Article 7\r\n\r\n ## Paragraph 1\r\n\r\n Nulla consequat, *enim* sed cursus varius, orci quam iaculis orci, in venenatis magna magna quis magna.\r\n\r\n## Paragraph 2\r\n\r\nVestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse sed justo ac nibh gravida suscipit.\r\n\r\n## Paragraph 3\r\n\r\nEtiam tincidunt, justo ac porttitor suscipit, est libero consequat nunc, non venenatis risus urna non libero.',	'2009-06-22 12:59:34',	1,	1),
(8,	'Article 8',	'Cras *sollicitudin*, **justo nec pellentesque** feugiat.',	'# Article 8\r\n\r\n## Paragraph 1\r\n\r\nSed facilisis, **quam sed rutrum** pellentesque, dolor urna egestas dolor, eu lobortis massa mi sed nulla.\r\n\r\n## Paragraph 2\r\n\r\nMorbi at magna ac neque ultricies aliquet. Aenean ut enim dolor. Maecenas sed sem at dolor bibendum commodo.\r\n\r\n## Paragraph 3\r\n\r\nNunc sed arcu eget quam commodo bibendum. Integer at nisi sed diam faucibus posuere at nec mauris.',	'2023-06-22 12:59:34',	2,	1);

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE `auteur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `auteur` (`id`, `nom`, `email`, `mot_de_passe`) VALUES
(1,	'John Doe',	'john@example.com',	'hashedpassword1'),
(2,	'Jane Doe',	'jane@example.com',	'hashedpassword2'),
(3,	'theoo',	'th30pelli@gmail.com',	'$argon2id$v=19$m=65536,t=4,p=1$UlE2dlBqVE1SZWFzTjluMA$EKgk2EwE6qwdzTWFqQTmuW0A37uxkVhwezqjsjb1NO8');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `categories` (`id`, `nom`) VALUES
(1,	'Sport'),
(2,	'Musique'),
(3,	'Technologie');

-- 2023-06-23 10:32:00
