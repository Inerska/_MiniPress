INSERT INTO auteur (nom, email, mot_de_passe)
VALUES ('John Doe', 'john@example.com', 'hashedpassword1'),
       ('Jane Doe', 'jane@example.com', 'hashedpassword2');

INSERT INTO categories (nom)
VALUES ('Sport'),
       ('Musique'),
       ('Technologie');

INSERT INTO articles (titre, resume, contenu, auteur_id)
VALUES ('Les bienfaits du sport',
        'Découvrez les nombreux avantages de la pratique sportive',
        'Le sport contribue à améliorer la santé physique et mentale.',
        1),
       ('La musique c'est important',
        'Explorez l''influence de la musique sur notre humeur et nos émotions',
        'La musique peut avoir un effet apaisant et stimulant.',
        1),
       ('Les dernières avancées technologiques',
        'Découvrez les innovations technologiques les plus récentes',
        'Les nouvelles technologies transforment notre facon de vivre.',
        2),
       ('Les meilleurs gadgets high-tech',
        'Explorez les derniers gadgets high-tech sur le marché',
        'Ces gadgets révolutionnaires rendent notre vie plus pratique et divertissante.',
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
