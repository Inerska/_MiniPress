INSERT INTO auteur (nom, email, mot_de_passe)
VALUES ('John Doe', 'john@example.com', 'hashedpassword1'),
       ('Jane Doe', 'jane@example.com', 'hashedpassword2');

INSERT INTO categories (nom)
VALUES ('Catégorie 1'),
       ('Catégorie 2'),
       ('Catégorie 3');

INSERT INTO articles (titre, resume, contenu, auteur_id)
VALUES ('Titre Article 1',
        'Résumé Article 1',
        '# Titre \n\n Contenu du premier paragraphe. \n\n Contenu du deuxième paragraphe. \n\n Contenu du troisième paragraphe.',
        1),
       ('Titre Article 2',
        'Résumé Article 2',
        '# Titre \n\n Contenu du premier paragraphe. \n\n Contenu du deuxième paragraphe. \n\n Contenu du troisième paragraphe.',
        1),
       ('Titre Article 3',
        'Résumé Article 3',
        '# Titre \n\n Contenu du premier paragraphe. \n\n Contenu du deuxième paragraphe. \n\n Contenu du troisième paragraphe.',
        2),
       ('Titre Article 4',
        'Résumé Article 4',
        '# Titre \n\n Contenu du premier paragraphe. \n\n Contenu du deuxième paragraphe. \n\n Contenu du troisième paragraphe.',
        2);


INSERT INTO article_categories (article_id, category_id)
VALUES (1, 1),
       (1, 2),
       (2, 2),
       (2, 3),
       (3, 1),
       (3, 3),
       (4, 1),
       (4, 2);
