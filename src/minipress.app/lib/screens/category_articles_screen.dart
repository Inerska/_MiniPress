import 'package:flutter/material.dart';
import 'package:todo_list_v1/models/article.dart';
import 'package:todo_list_v1/screens/article_screen.dart';
import 'package:todo_list_v1/services/api_service.dart';

class CategoryArticlesScreen extends StatelessWidget {
  final String category; // Catégorie d'articles à afficher

  CategoryArticlesScreen({required this.category});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
            'Articles - $category'), // Affiche le titre de la catégorie dans la barre de navigation
      ),
      body: FutureBuilder<List<Article>>(
        future: ApiService.fetchArticlesByCategory(
            category), // Récupère la liste des articles par catégorie
        builder: (context, snapshot) {
          if (snapshot.hasData) {
            // Si les données sont disponibles
            final articles = snapshot.data!; // Obtient la liste d'articles
            return ListView.builder(
              itemCount: articles.length,
              itemBuilder: (context, index) {
                final article = articles[index];
                return ListTile(
                  title: Text(article
                      .title), // Affiche le titre de l'article dans la liste
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => ArticleScreen(
                          articleId: article
                              .id, // Passe l'ID de l'article à l'écran de l'article
                          articleTitle: article
                              .title, // Passe le titre de l'article à l'écran de l'article
                        ),
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
                  'Error: ${snapshot.error}'), // Affiche un message d'erreur
            );
          }
          return Center(
            child:
                CircularProgressIndicator(), // Affiche un indicateur de chargement en attendant les données
          );
        },
      ),
    );
  }
}
