class Category {
  final int id; // ID de la catégorie
  final String name; // Nom de la catégorie

  Category({required this.id, required this.name});

  factory Category.fromJson(Map<String, dynamic> json) {
    return Category(
      id: json['id'], // Extraction de l'ID de la catégorie à partir du JSON
      name: json['nom'], // Extraction du nom de la catégorie à partir du JSON
    );
  }
}
