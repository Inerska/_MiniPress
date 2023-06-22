import 'package:flutter/material.dart';
import 'package:flutter_html/flutter_html.dart';
import 'package:flutter_markdown/flutter_markdown.dart';
import 'package:markdown/markdown.dart' as md;
import 'package:todo_list_v1/models/article.dart';
import 'package:todo_list_v1/utils/date_utils.dart' as utils;
import 'package:todo_list_v1/services/api_service.dart';

class ArticleScreen extends StatelessWidget {
  final int articleId;
  final String articleTitle;
  final String searchKeyword;

  ArticleScreen({
    required this.articleId,
    required this.articleTitle,
    this.searchKeyword = '',
  });

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<Article>(
      future: ApiService.fetchArticle(articleId),
      builder: (context, snapshot) {
        if (snapshot.hasData) {
          final article = snapshot.data!;
          final filteredSummary =
              searchKeyword.isNotEmpty && article.summary != null
                  ? article.summary!.replaceAll(
                      RegExp('($searchKeyword)', caseSensitive: false),
                      '**\$1**',
                    )
                  : article.summary;

          String markdownContent = '';
          if (article.content != null) {
            markdownContent = article.content!;
          }

          final summaryHtml = md.markdownToHtml(filteredSummary ?? '');

          return Scaffold(
            appBar: AppBar(
              title: Text(
                articleTitle,
                style: TextStyle(
                  fontSize: 24.0,
                  fontWeight: FontWeight.bold,
                  color: Colors.black,
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
                          article.creationDate,
                        ),
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
                      color: Colors.black,
                    ),
                  ),
                  SizedBox(height: 16.0),
                  Text(
                    'Auteur: ${article.author}',
                    style: TextStyle(
                      fontSize: 18.0,
                      fontWeight: FontWeight.bold,
                      color: Colors.white,
                    ),
                  ),
                  SizedBox(height: 16.0),
                  if (summaryHtml.isNotEmpty)
                    Container(
                      padding: EdgeInsets.all(16.0),
                      decoration: BoxDecoration(
                        color: Colors.grey[200],
                        borderRadius: BorderRadius.circular(8.0),
                      ),
                      child: Html(data: summaryHtml),
                    ),
                  SizedBox(height: 16.0),
                  if (markdownContent.isNotEmpty)
                    MarkdownBody(
                      data: markdownContent,
                      styleSheet: MarkdownStyleSheet(
                        h1: TextStyle(fontSize: 24.0),
                        h2: TextStyle(fontSize: 22.0),
                        h3: TextStyle(fontSize: 20.0),
                        h4: TextStyle(fontSize: 18.0),
                        h5: TextStyle(fontSize: 16.0),
                        p: TextStyle(fontSize: 16.0),
                        blockquote: TextStyle(
                          fontSize: 16.0,
                          color: Colors.grey[600],
                          fontStyle: FontStyle.italic,
                        ),
                        code: TextStyle(
                          fontSize: 14.0,
                          color: Colors.grey[800],
                          fontFamily: 'monospace',
                        ),
                      ),
                    ),
                ],
              ),
            ),
          );
        } else if (snapshot.hasError) {
          return Scaffold(
            appBar: AppBar(
              title: Text(
                'Erreur',
                style: TextStyle(
                  fontSize: 24.0,
                  fontWeight: FontWeight.bold,
                  color: Colors.black,
                ),
              ),
              backgroundColor: Colors.red,
            ),
            body: Center(
              child: Text('Une erreur s\'est produite'),
            ),
          );
        }

        return Scaffold(
          appBar: AppBar(
            title: Text(
              articleTitle,
              style: TextStyle(
                fontSize: 24.0,
                fontWeight: FontWeight.bold,
                color: Colors.black,
              ),
            ),
            backgroundColor: Colors.deepPurple,
          ),
          body: Center(
            child: CircularProgressIndicator(),
          ),
        );
      },
    );
  }
}
