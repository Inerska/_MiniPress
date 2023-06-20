import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:todo_list_v1/models/article.dart';
import 'package:todo_list_v1/models/category.dart';

class ApiService {
  static Future<List<Article>> fetchArticlesByCategory(String category) async {
    final response = await http.get(
      Uri.http('127.0.0.1:8080', '/api/v1/categories/$category/articles'),
    );

    final data = json.decode(response.body);

    print(data);

    if (data.statusCode == 200) {
      final articlesData = data['data'] as List<dynamic>;
      final articles = articlesData
          .map((articleData) => Article.fromJson(articleData))
          .toList();
      return articles;
    } else {
      throw Exception('Failed to fetch articles by category');
    }
  }

  static Future<List<Category>> fetchCategories() async {
    final response = await http.get(
      Uri.parse('http://127.0.0.1:8080/api/v1/categories'),
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      final categoriesData = data['data'] as List<dynamic>;
      final categories = categoriesData
          .map((categoryData) => Category.fromJson(categoryData))
          .toList();
      return categories;
    } else {
      throw Exception('Failed to fetch categories');
    }
  }

  // Méthode statique pour récupérer un article spécifique
  static Future<Article> fetchArticle(int articleId) async {
    final response = await http.get(
      Uri.parse('http://127.0.0.1:8080/api/v1/articles/$articleId'),
    );

    final data = json.decode(response.body);

    if (response.statusCode == 200) {
      final articleData = data['data'];
      final article = Article.fromJson(
          articleData); // Convertit les données en un objet Article
      print(article);
      return article; // Retourne l'article
    } else {
      throw Exception(
          'Failed to fetch article'); // Lance une exception si la requête a échoué
    }
  }
}
