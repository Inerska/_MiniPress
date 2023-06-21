import 'package:flutter/material.dart';
import 'package:todo_list_v1/screens/article_screen.dart';
import 'package:todo_list_v1/services/api_service.dart';
import 'package:todo_list_v1/models/category.dart';
import 'package:todo_list_v1/models/article.dart';

class HomeScreen extends StatefulWidget {
  @override
  _HomeScreenState createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  Category? selectedCategory;
  List<Category> categories = [];
  List<Article> articles = [];

  @override
  void initState() {
    super.initState();
    fetchCategories();
  }

  Future<void> fetchCategories() async {
    try {
      final fetchedCategories = await ApiService.fetchCategories();

      setState(() {
        categories = fetchedCategories;
      });

      if (fetchedCategories.isNotEmpty) {
        selectCategory(fetchedCategories.first);
      }
    } catch (error) {
      print('Failed to fetch categories: $error');
    }
  }

  void selectCategory(Category category) {
    setState(() {
      selectedCategory = category;
    });
    fetchArticlesByCategory(category.id);
  }

  Future<void> fetchArticlesByCategory(int categoryId) async {
    try {
      final fetchedArticles = await ApiService.fetchArticle(categoryId);

      setState(() {
        articles = [fetchedArticles];
      });
    } catch (error) {
      print('Failed to fetch articles by category: $error');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.grey[800],
        title: Text('Mon Site'),
        actions: [
          Container(
            margin: EdgeInsets.symmetric(horizontal: 8),
            child: DropdownButton<Category>(
              value: selectedCategory,
              items: categories.map((Category category) {
                return DropdownMenuItem<Category>(
                  value: category,
                  child: Text(
                    category.name,
                    style: TextStyle(color: Colors.white),
                  ),
                );
              }).toList(),
              onChanged: (Category? value) {
                if (value != null) {
                  selectCategory(value);
                }
              },
            ),
          ),
          Container(
            margin: EdgeInsets.symmetric(horizontal: 8),
            child: DropdownButton<String>(
              items:
                  ['Trier croissant', 'Trier décroissant'].map((String option) {
                return DropdownMenuItem<String>(
                  value: option,
                  child: Text(
                    option,
                    style: TextStyle(color: Colors.white),
                  ),
                );
              }).toList(),
              onChanged: (String? value) {
                // Handle sort option change
              },
            ),
          ),
          Container(
            margin: EdgeInsets.symmetric(horizontal: 8),
            child: TextField(
              decoration: InputDecoration(
                hintText: 'Filtrer',
                filled: true,
                fillColor: Colors.grey[700],
                border: OutlineInputBorder(
                  borderRadius: BorderRadius.circular(4),
                  borderSide: BorderSide.none,
                ),
                prefixIcon: Icon(
                  Icons.search,
                  color: Colors.grey[300],
                ),
              ),
              style: TextStyle(color: Colors.white),
            ),
          ),
        ],
      ),
      body: Container(
        color: Colors.grey[200],
        child: Padding(
          padding: const EdgeInsets.all(8.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                'Liste des articles',
                style: TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.bold,
                ),
              ),
              SizedBox(height: 16),
              Expanded(
                child: GridView.builder(
                  gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                    crossAxisCount: 2,
                    mainAxisSpacing: 8,
                    crossAxisSpacing: 8,
                    childAspectRatio: 0.75,
                  ),
                  itemCount: articles.length,
                  itemBuilder: (context, index) {
                    final article = articles[index];
                    return GestureDetector(
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
                      child: Container(
                        color: Colors.white,
                        padding: EdgeInsets.all(8),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              article.title,
                              style: TextStyle(
                                fontSize: 16,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                            SizedBox(height: 4),
                            Text(
                              'Date de création: ${article.creationDate}',
                              style: TextStyle(
                                fontSize: 12,
                              ),
                            ),
                            SizedBox(height: 4),
                            Text(
                              'Auteur: ${article.author}',
                              style: TextStyle(
                                fontSize: 12,
                              ),
                            ),
                          ],
                        ),
                      ),
                    );
                  },
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
