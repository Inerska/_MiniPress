import 'package:flutter/material.dart';
import 'package:flutter_html/flutter_html.dart';
import 'package:todo_list_v1/models/article.dart';
import 'package:todo_list_v1/utils/date_utils.dart' as utils;
import 'package:todo_list_v1/services/api_service.dart';

class ArticleScreen extends StatelessWidget {
  final int articleId;
  final String articleTitle;

  ArticleScreen({required this.articleId, required this.articleTitle});

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<Article>(
      future: ApiService.fetchArticle(articleId),
      builder: (context, snapshot) {
        if (snapshot.hasData) {
          final article = snapshot.data!;
          return Scaffold(
            appBar: AppBar(
              title: Text(
                articleTitle,
                style: TextStyle(
                  fontSize: 24.0,
                  fontWeight: FontWeight.bold,
                  color: Colors.black, // Ajout de la couleur noire
                ),
              ),
              backgroundColor: Colors.deepPurple,
            ),
            backgroundColor: Colors.teal,
            body: SingleChildScrollView(
              padding: EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Container(
                    padding: EdgeInsets.symmetric(
                      vertical: 8.0,
                      horizontal: 16.0,
                    ),
                    decoration: BoxDecoration(
                      color: Colors.black,
                      borderRadius: BorderRadius.circular(8.0),
                      border: Border.all(
                        color: Colors.black,
                        width: 1.0,
                      ),
                    ),
                    child: RichText(
                      text: TextSpan(
                        text: utils.DateUtils.formatDateTime(
                            article.creationDate),
                        style: TextStyle(
                          color: Colors.red,
                          fontSize: 18.0,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                  ),
                  SizedBox(height: 16.0),
                  Text(
                    article.title,
                    style: TextStyle(
                      fontSize: 24.0,
                      fontWeight: FontWeight.bold,
                      color: Colors.black, // Ajout de la couleur noire
                    ),
                  ),
                  SizedBox(height: 24.0),
                  if (article.summary != null)
                    Container(
                      padding: EdgeInsets.all(16.0),
                      decoration: BoxDecoration(
                        color: Colors.grey[200],
                        borderRadius: BorderRadius.circular(8.0),
                      ),
                      child: Text(
                        article.summary!,
                        style: TextStyle(
                          fontSize: 18.0,
                          color: Colors.grey[800],
                        ),
                      ),
                    ),
                  SizedBox(height: 24.0),
                  if (article.content != null)
                    Container(
                      margin: EdgeInsets.only(top: 8.0),
                      decoration: BoxDecoration(
                        color: Colors.white,
                        border: Border.all(
                          color: Colors.grey[300]!,
                          width: 1.0,
                        ),
                      ),
                      child: Html(
                        data: article.content!,
                        style: {
                          "body": Style(fontSize: FontSize(20.0)),
                        },
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
