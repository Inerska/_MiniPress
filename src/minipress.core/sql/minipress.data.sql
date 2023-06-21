INSERT INTO auteur (nom, email, mot_de_passe)
VALUES ('John Doe', 'john@example.com', 'hashedpassword1'),
       ('Jane Doe', 'jane@example.com', 'hashedpassword2');

INSERT INTO categories (nom)
VALUES ('Sport'),
       ('Musique'),
       ('Technologie');

INSERT INTO articles (titre, resume, contenu, date_creation, auteur_id)
VALUES
  ('Les bienfaits du sport',
   'Découvrez les nombreux avantages de la pratique sportive',
   'Le sport contribue à améliorer la santé physique et mentale.',
   '2022-01-10 09:30:00',
   1),
  ('La musique est importante',
   'La musique a une certaine influence sur notre humeur et nos émotions',
   'La musique peut avoir un effet apaisant et stimulant.',
   '2022-02-15 14:45:00',
   1),
  ('Les dernières avancées technologiques',
   'Découvrez les innovations technologiques les plus récentes',
   'Les nouvelles technologies transforment notre façon de vivre.',
   '2022-03-20 17:15:00',
   2),
  ('Les meilleurs gadgets high tech',
   'Explorez les derniers gadgets hightech sur le marché',
   'Ces gadgets révolutionnaires rendent notre vie plus pratique et divertissante.',
   '2022-04-25 10:00:00',
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
