INSERT INTO auteur (nom, email, mot_de_passe)
VALUES ('John Doe', 'john@example.com', 'hashedpassword1'),
       ('Jane Doe', 'jane@example.com', 'hashedpassword2')
ON DUPLICATE KEY UPDATE nom = VALUES(nom), email = VALUES(email), mot_de_passe = VALUES(mot_de_passe);

INSERT INTO categories (nom)
VALUES ('Sport'),
       ('Musique'),
       ('Technologie')
ON DUPLICATE KEY UPDATE nom = VALUES(nom);

INSERT INTO articles (titre, resume, contenu, date_creation, auteur_id)
VALUES
    ('Article 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
     '# Article 1\n
     ## Paragraph 1\n
     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ut dictum nisi, quis consequat quam. Sed consectetur erat ac nisi aliquet, a hendrerit leo pellentesque.\n
     ## Paragraph 2\n
     Proin non mauris lobortis, hendrerit ligula in, ullamcorper massa. Sed sit amet neque cursus, malesuada lorem et, lacinia elit.\n
     ## Paragraph 3\n
     Aliquam in nibh id lorem laoreet elementum id eget mi. Quisque in lectus felis.',
     NOW(), 1),

    ('Article 2', 'Proin non mauris lobortis, hendrerit ligula in.',
     '# Article 2\n
     ## Paragraph 1\n
     Curabitur at elit eu nunc consequat condimentum. Donec aliquam, massa et imperdiet ornare, est eros blandit ex, ut egestas nulla justo sit amet est.\n
     ## Paragraph 2\n
     Cras in sapien id nisi condimentum aliquet. Suspendisse potenti. Vestibulum consectetur orci non dui maximus, in elementum ligula egestas.\n
     ## Paragraph 3\n
     Duis in neque enim. Sed in ornare sem, ac posuere orci. Phasellus laoreet lacinia ex, non viverra turpis pulvinar non.',
     NOW(), 2),

    ('Article 3', 'Donec aliquam, massa et imperdiet ornare.',
     '# Article 3\n
     ## Paragraph 1\n
     Nullam ac quam non sem varius porta. In id congue ante. Morbi nec erat purus. Donec a condimentum erat.\n
     ## Paragraph 2\n
     Phasellus volutpat, tellus eget maximus posuere, erat ipsum pharetra lacus, ut rutrum nulla lectus at augue.\n
     ## Paragraph 3\n
     Etiam cursus, sapien a eleifend gravida, dui purus tristique ipsum, id auctor quam orci non est.',
     NOW(), 3),

    ('Article 4', 'Vestibulum consectetur orci non dui maximus.',
     '# Article 4\n
     ## Paragraph 1\n
     Integer commodo, sem sed vulputate rutrum, ante ligula pellentesque tellus, non viverra dui erat id lorem.\n
     ## Paragraph 2\n
     Vivamus cursus massa sit amet sem aliquet, non efficitur tortor interdum. Sed sem augue, auctor at efficitur id, posuere nec tellus.\n
     ## Paragraph 3\n
     Ut euismod tincidunt est, et porta lorem lobortis id. Integer varius, elit eget laoreet congue, diam nisl convallis diam, sit amet luctus mi neque non quam.',
     NOW(), 1),

    ('Article 5', 'Curabitur at elit eu nunc consequat condimentum.',
     '# Article 5\n
     ## Paragraph 1\n
     Cras sollicitudin, justo nec pellentesque feugiat, ligula turpis eleifend mi, at bibendum lacus mi quis libero.\n
     ## Paragraph 2\n
     Duis euismod, ligula et commodo dapibus, erat erat iaculis odio, at interdum quam est in lectus.\n
     ## Paragraph 3\n
     Fusce consequat, ante sed rutrum gravida, turpis nulla tempus ligula, id ultrices mi turpis eget lorem.',
     NOW(), 2),

    ('Article 6', 'Duis in neque enim. Sed in ornare sem.',
     '# Article 6\n
     ## Paragraph 1\n
     Sed ultricies libero justo, at elementum turpis aliquam a. Donec a tortor ac neque egestas lacinia.\n
     ## Paragraph 2\n
     In quis neque at orci porttitor cursus. Pellentesque volutpat, mi ut varius vehicula, ipsum urna pulvinar nunc, et commodo nisl orci non metus.\n
     ## Paragraph 3\n
     Quisque ullamcorper, felis sit amet egestas pulvinar, est ligula varius eros, non dignissim metus est sed metus.',
     NOW(), 3),

    ('Article 7', 'Quisque ullamcorper, felis sit amet egestas pulvinar.',
     '# Article 7\n
     ## Paragraph 1\n
     Nulla consequat, enim sed cursus varius, orci quam iaculis orci, in venenatis magna magna quis magna.\n
     ## Paragraph 2\n
     Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse sed justo ac nibh gravida suscipit.\n
     ## Paragraph 3\n
     Etiam tincidunt, justo ac porttitor suscipit, est libero consequat nunc, non venenatis risus urna non libero.',
     NOW(), 1),

    ('Article 8', 'Cras sollicitudin, justo nec pellentesque feugiat.',
     '# Article 8\n
     ## Paragraph 1\n
     Sed facilisis, quam sed rutrum pellentesque, dolor urna egestas dolor, eu lobortis massa mi sed nulla.\n
     ## Paragraph 2\n
     Morbi at magna ac neque ultricies aliquet. Aenean ut enim dolor. Maecenas sed sem at dolor bibendum commodo.\n
     ## Paragraph 3\n
     Nunc sed arcu eget quam commodo bibendum. Integer at nisi sed diam faucibus posuere at nec mauris.',
     NOW(), 2)
ON DUPLICATE KEY UPDATE titre = VALUES(titre), resume = VALUES(resume), contenu = VALUES(contenu), date_creation = VALUES(date_creation), auteur_id = VALUES(auteur_id);

INSERT INTO article_categories (article_id, category_id)
VALUES (1, 1),
       (1, 2),
       (2, 1),
       (2, 3),
       (3, 2),
       (3, 3),
       (4, 1),
       (4, 2),
       (5, 1),
       (5, 3),
       (6, 2),
       (6, 3),
       (7, 1),
       (7, 2),
       (8, 1),
       (8, 3)
ON DUPLICATE KEY UPDATE article_id = VALUES(article_id), category_id = VALUES(category_id);
