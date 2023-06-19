import 'dart:io';

class Article {
  final int id; // ID de l'article
  final String title; // Titre de l'article
  final String creationDate; // Date de création de l'article
  final String author; // Auteur de l'article
  final String? summary; // Résumé de l'article (optionnel)
  final String? content; // Contenu de l'article (optionnel)

  Article({
    this.id = 0,
    required this.title,
    required this.creationDate,
    required this.author,
    this.summary,
    this.content,
  });

  static Article fromJson(Map<String, dynamic> json) {
    print("get $json");

    int id = 0;
    if(json['url'] != null) {
      try {
        id = int.parse(json['url'].split('/').last);
      } catch (e) {
        id = 0;
      }
    }

    return Article(
      id: json['id'] ?? id,
      title: json['titre'] ?? '',
      creationDate: json['date_creation'],
      author: json['auteur_id']?.toString() ?? '',
      summary: json['resume'],
      content: json['contenu'],
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
