import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:todo_list_v1/models/article.dart';
import 'package:todo_list_v1/models/category.dart';

class ApiService {
  static const String baseUrl = 'http://127.0.0.1:8080/api/v1';

  static Future<List<Article>> fetchAllArticles() async {
    final response = await http.get(
      Uri.parse('$baseUrl/articles'),
    );

    final data = json.decode(response.body);

    if (response.statusCode == 200) {
      final articlesData = data['data'] as List<dynamic>;
      final articles = articlesData
          .map((articleData) => Article.fromJson(articleData))
          .toList();

      return articles;
    } else {
      throw Exception('Failed to fetch all articles');
    }
  }

  static Future<List<Article>> fetchArticlesByCategory(int categoryId) async {
    final response = await http.get(
      Uri.parse('$baseUrl/categories/$categoryId/articles'),
    );

    final data = json.decode(response.body);

    if (response.statusCode == 200) {
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
      Uri.parse('$baseUrl/categories'),
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

  static Future<Article> fetchArticle(int articleId) async {
    final response = await http.get(
      Uri.parse('$baseUrl/articles/$articleId'),
    );

    final data = json.decode(response.body);

    if (response.statusCode == 200) {
      final articleData = data['data'];
      final article = Article.fromJson(articleData);
      return article;
    } else {
      throw Exception('Failed to fetch article');
    }
  }
}
