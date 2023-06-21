import 'package:flutter/material.dart';
import 'package:flutter_html/flutter_html.dart';
import 'package:todo_list_v1/models/article.dart';
import 'package:todo_list_v1/utils/date_utils.dart' as utils;
import 'package:todo_list_v1/services/api_service.dart';

class ArticleScreen extends StatelessWidget {
  final int articleId; // ID de l'article à afficher
  final String articleTitle; // Titre de l'article

  ArticleScreen({required this.articleId, required this.articleTitle});

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<Article>(
      future: ApiService.fetchArticle(articleId),
      builder: (context, snapshot) {
        if (snapshot.hasData) {
          // Si les données sont disponibles
          final article = snapshot.data!;
          return Scaffold(
            appBar: AppBar(
              title: Text(articleTitle),
            ),
            body: SingleChildScrollView(
              padding: EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    utils.DateUtils.formatDateTime(article.creationDate),
                    style: TextStyle(
                      color: Colors.grey,
                      fontSize: 14.0,
                    ),
                  ),
                  SizedBox(height: 16.0),
                  Text(
                    article.title,
                    style: TextStyle(
                      fontSize: 20.0,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  SizedBox(height: 16.0),
                  if (article.summary != null)
                    Text(
                      article.summary!,
                      style: TextStyle(
                        fontSize: 16.0,
                        color: Colors.black54,
                      ),
                    ),
                  SizedBox(height: 16.0),
                  if (article.content != null)
                    Container(
                      margin: EdgeInsets.only(top: 8.0),
                      child: Html(
                        data: article.content!,
                      ),
                    ),
                ],
              ),
            ),
          );
        } else if (snapshot.hasError) {
          return Center(child: Text('Error: ${snapshot.error}'));
        }

        return Center(child: CircularProgressIndicator());
      },
    );
  }
}
