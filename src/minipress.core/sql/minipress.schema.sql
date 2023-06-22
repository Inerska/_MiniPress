DROP TABLE IF EXISTS auteur;
CREATE TABLE auteur
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    nom          VARCHAR(100)        NOT NULL,
    email        VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(100)        NOT NULL
);

DROP TABLE IF EXISTS articles;
CREATE TABLE articles
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    titre         VARCHAR(255) NOT NULL,
    resume        TEXT,
    contenu       TEXT         NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    auteur_id     INT,
    published    BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (auteur_id) REFERENCES auteur (id)
);

DROP TABLE IF EXISTS categories;
CREATE TABLE categories
(
    id  INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

DROP TABLE IF EXISTS article_categories;
CREATE TABLE article_categories
(
    article_id  INT,
    category_id INT,
    PRIMARY KEY (article_id, category_id),
    FOREIGN KEY (article_id) REFERENCES articles (id),
    FOREIGN KEY (category_id) REFERENCES categories (id)
);
