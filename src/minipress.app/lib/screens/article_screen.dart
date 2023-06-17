import 'package:flutter/material.dart';
import 'package:flutter_html/flutter_html.dart';
import 'package:todo_list_v1/models/article.dart';
import 'package:todo_list_v1/utils/date_utils.dart' as utils;
import 'package:todo_list_v1/services/api_service.dart';

class ArticleScreen extends StatelessWidget {
  final int articleId; // ID de l'article à afficher

  ArticleScreen({required this.articleId});

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<Article>(
      future: ApiService.fetchArticle(
          articleId), // Récupère l'article à partir de l'API
      builder: (context, snapshot) {
        if (snapshot.hasData) {
          // Si les données sont disponibles
          final article = snapshot.data!; // Obtient l'instance de l'article
          return Scaffold(
            appBar: AppBar(
              title: Text(article
                  .title), // Affiche le titre de l'article dans la barre de navigation
            ),
            body: SingleChildScrollView(
              padding: EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    utils.DateUtils.formatDateTime(article
                        .creationDate), // Formate la date de création de l'article en utilisant la classe utilitaire DateUtils
                    style: TextStyle(
                      color: Colors.grey,
                      fontSize: 14.0,
                    ),
                  ),
                  SizedBox(height: 16.0),
                  Text(
                    article.title, // Affiche le titre de l'article
                    style: TextStyle(
                      fontSize: 20.0,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  SizedBox(height: 16.0),
                  if (article.summary !=
                      null) // Vérifie si un résumé est disponible
                    Text(
                      article
                          .summary!, // Affiche le résumé de l'article s'il existe
                      style: TextStyle(
                        fontSize: 16.0,
                        color: Colors.black54,
                      ),
                    ),
                  SizedBox(height: 16.0),
                  if (article.content !=
                      null) // Vérifie si un contenu est disponible
                    Container(
                      child: Html(
                        data: article
                            .content!, // Affiche le contenu de l'article en utilisant le widget Html pour interpréter le HTML
                      ),
                      margin: EdgeInsets.only(top: 8.0),
                    ),
                ],
              ),
            ),
          );
        } else if (snapshot.hasError) {
          // Si une erreur s'est produite lors de la récupération de l'article
          return Center(
              child: Text(
                  'Error: ${snapshot.error}')); // Affiche un message d'erreur
        }
        return Center(
            child:
                CircularProgressIndicator()); // Affiche un indicateur de chargement en attendant les données
      },
    );
  }
}
