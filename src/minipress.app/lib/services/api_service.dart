import 'dart:convert';
import 'dart:io';
import 'package:http/http.dart' as http;
import 'package:todo_list_v1/models/article.dart';
import 'package:todo_list_v1/models/category.dart';

class ApiService {
  // Méthode statique pour récupérer la liste des articles
  static Future<List<Article>> fetchArticles() async {
    final response = await http.get(Uri.http(
        '127.0.0.1:8080', '/api/v1/articles')); // Appel à l'API pour récupérer les articles

    final data = json.decode(response.body);

    if (data['statusCode'] == 200) {
      final articlesData =
          data['data'] as List<dynamic>; // Obtient les données des articles

      var articles = <Article>[];

      for (var article in articlesData) {
        articles.add(Article.fromJson(article));
        print("Après ajout d'un article");
      }

      print("fin loop");

      return articles.toList();
    } else {
      throw Exception(
          'Failed to fetch articles'); // Lance une exception si la requête a échoué
    }
  }

  // Méthode statique pour récupérer un article spécifique
  static Future<Article> fetchArticle(int articleId) async {
    final response = await http.get(Uri.parse(
        '/api/v1/articles/$articleId')); // Appel à l'API pour récupérer l'article spécifié par son ID

    if (response.statusCode == 200) {
      // Si la requête a réussi
      final jsonData = json.decode(response.body); // Décode la réponse JSON
      final articleData = jsonData['data']; // Obtient les données de l'article
      final article = Article.fromJson(
          articleData); // Convertit les données en un objet Article
      return article; // Retourne l'article
    } else {
      throw Exception(
          'Failed to fetch article'); // Lance une exception si la requête a échoué
    }
  }

  // Méthode statique pour récupérer la liste des catégories
  static Future<List<Category>> fetchCategories() async {
    final response = await http.get(Uri.parse(
        '/api/v1/categories')); // Appel à l'API pour récupérer les catégories

    if (response.statusCode == 200) {
      // Si la requête a réussi
      final jsonData = json.decode(response.body); // Décode la réponse JSON
      final categoriesData = jsonData['data']
          as List<dynamic>; // Obtient les données des catégories
      final categories = categoriesData
          .map((data) => Category.fromJson(data))
          .toList(); // Convertit les données en une liste d'objets Category
      return categories; // Retourne la liste des catégories
    } else {
      throw Exception(
          'Failed to fetch categories'); // Lance une exception si la requête a échoué
    }
  }

  // Méthode statique pour récupérer la liste des articles par catégorie
  static Future<List<Article>> fetchArticlesByCategory(int categoryId) async {
    final response = await http.get(Uri.parse(
        '/api/v1/categories/$categoryId/articles')); // Appel à l'API pour récupérer les articles d'une catégorie spécifiée par son ID

    if (response.statusCode == 200) {
      // Si la requête a réussi
      final jsonData = json.decode(response.body); // Décode la réponse JSON
      final articlesData =
          jsonData['data'] as List<dynamic>; // Obtient les données des articles
      final articles = articlesData
          .map((data) => Article.fromJson(data))
          .toList(); // Convertit les données en une liste d'objets Article
      return articles; // Retourne la liste des articles
    } else {
      throw Exception(
          'Failed to fetch articles by category'); // Lance une exception si la requête a échoué
    }
  }
}
