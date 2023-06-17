class Article {
  final int id; // ID de l'article
  final String title; // Titre de l'article
  final String creationDate; // Date de création de l'article
  final String author; // Auteur de l'article
  final String? summary; // Résumé de l'article (optionnel)
  final String? content; // Contenu de l'article (optionnel)

  Article({
    required this.id,
    required this.title,
    required this.creationDate,
    required this.author,
    this.summary,
    this.content,
  });

  factory Article.fromJson(Map<String, dynamic> json) {
    return Article(
      id: json['id'],
      title: json['title'],
      creationDate: json['creation_date'],
      author: json['author'],
      summary: json['summary'],
      content: json['content'],
    );
  }

  // Méthodes d'accès aux propriétés de l'article
  int get getId => id;
  String get getTitle => title;
  String get getCreationDate => creationDate;
  String get getAuthor => author;
  String? get getSummary => summary;
  String? get getContent => content;
}
