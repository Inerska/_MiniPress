class Article {
  final int id;
  final String title;
  final String creationDate;
  final String author;
  final String? summary;
  final String? content;

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
    if (json['id'] != null) {
      id = json['id'];
    } else if (json['url'] != null) {
      try {
        id = int.parse(json['url'].split('/').last);
      } catch (e) {
        id = 0;
      }
    }

    return Article(
      id: id,
      title: json['titre'] ?? '',
      creationDate: json['date_creation'],
      author: json['auteur_id']?.toString() ?? '',
      summary: json['resume'],
      content: json['contenu'],
    );
  }
}
