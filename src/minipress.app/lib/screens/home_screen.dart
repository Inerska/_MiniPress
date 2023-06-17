import 'package:flutter/material.dart';
import 'package:todo_list_v1/models/article.dart';
import 'package:todo_list_v1/screens/article_screen.dart';
import 'package:todo_list_v1/services/api_service.dart';

class HomeScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
            'MiniPress.app'), // Affiche le titre de l'application dans la barre de navigation
      ),
      body: FutureBuilder<List<Article>>(
        future: ApiService
            .fetchArticles(), // Récupère la liste des articles à partir de l'API
        builder: (context, snapshot) {
          if (snapshot.hasData) {
            // Si les données sont disponibles
            final articles = snapshot.data!; // Obtient la liste d'articles
            return ListView.builder(
              itemCount: articles.length,
              itemBuilder: (context, index) {
                final article =
                    articles[index]; // Obtient un article à partir de la liste
                return ListTile(
                  title: Text(article.title), // Affiche le titre de l'article
                  subtitle: Text(article
                      .creationDate), // Affiche la date de création de l'article en tant que sous-titre
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => ArticleScreen(
                            articleId: article
                                .id), // Navigue vers la page ArticleScreen en passant l'ID de l'article sélectionné
                      ),
                    );
                  },
                );
              },
            );
          } else if (snapshot.hasError) {
            // Si une erreur s'est produite lors de la récupération des articles
            return Center(
                child: Text(
                    'Error: ${snapshot.error}')); // Affiche un message d'erreur
          }
          return Center(
              child:
                  CircularProgressIndicator()); // Affiche un indicateur de chargement en attendant les données
        },
      ),
    );
  }
}
