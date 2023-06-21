import 'package:flutter/material.dart';
import 'package:todo_list_v1/models/article.dart';
import 'package:todo_list_v1/screens/article_screen.dart';
import 'package:todo_list_v1/services/api_service.dart';

class CategoryArticlesScreen extends StatelessWidget {
  final int categoryId;

  CategoryArticlesScreen({required this.categoryId});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Articles - $categoryId'),
      ),
      body: FutureBuilder<List<Article>>(
        future: ApiService.fetchArticlesByCategory(categoryId),
        builder: (context, snapshot) {
          if (snapshot.hasData) {
            // Si les données sont disponibles
            final articles = snapshot.data!;
            return ListView.builder(
              itemCount: articles.length,
              itemBuilder: (context, index) {
                final article = articles[index];
                return ListTile(
                  title: Text(article.title),
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => ArticleScreen(
                          articleId: article.id,
                          articleTitle: article.title,
                        ),
                      ),
                    );
                  },
                );
              },
            );
          } else if (snapshot.hasError) {
            return Center(
              child: Text('Error: ${snapshot.error}'),
            );
          }
          return Center(
            child: CircularProgressIndicator(),
          );
        },
      ),
    );
  }
}
