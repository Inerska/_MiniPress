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
  bool isAscending = true;
  String searchKeyword = '';

  @override
  void initState() {
    super.initState();
    fetchCategories();
  }

  Future<void> fetchCategories() async {
    try {
      final fetchedCategories = await ApiService.fetchCategories();

      setState(() {
        categories = [
          if (!categories.contains(Category(name: 'Liste des Articles', id: 0)))
            Category(name: 'Liste des Articles', id: 0),
          ...fetchedCategories
        ];
      });

      if (fetchedCategories.isNotEmpty) {
        selectCategory(categories.first);
      }
    } catch (error) {
      print('Failed to fetch categories: $error');
    }
  }

  void selectCategory(Category category) {
    setState(() {
      selectedCategory = category;
    });

    if (category.id == 0) {
      fetchAllArticles();
    } else {
      fetchArticlesByCategory(category.id);
    }
  }

  Future<void> fetchAllArticles() async {
    try {
      List<Article> fetchedArticles = await ApiService.fetchAllArticles();

      setState(() {
        articles = fetchedArticles;
      });

      updateArticles();
    } catch (error) {
      print('Failed to fetch articles: $error');
    }
  }

  Future<void> fetchArticlesByCategory(int categoryId) async {
    try {
      List<Article> fetchedArticles =
          await ApiService.fetchArticlesByCategory(categoryId);

      setState(() {
        articles = fetchedArticles;
      });

      updateArticles();
    } catch (error) {
      print('Failed to fetch articles by category: $error');
    }
  }

  Future<void> updateArticles() async {
    setState(() {
      articles.sort((a, b) {
        if (isAscending) {
          return a.creationDate.compareTo(b.creationDate);
        } else {
          return b.creationDate.compareTo(a.creationDate);
        }
      });
    });
  }

  void filterArticles() {
    if (searchKeyword.isEmpty) {
      if (selectedCategory!.name == 'Liste des Articles') {
        fetchAllArticles();
      } else {
        fetchArticlesByCategory(selectedCategory!.id);
      }
    } else {
      List<Article> filteredArticles = articles
          .where((article) =>
              article.title.toLowerCase().contains(searchKeyword.toLowerCase()))
          .toList();

      setState(() {
        articles = filteredArticles;
      });

      updateArticles();
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.purple,
        title: Text('MiniPress.app'),
      ),
      body: Column(
        children: [
          Container(
            padding: EdgeInsets.all(8),
            color: Colors.grey[800],
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Container(
                  width: 200,
                  child: DropdownButton<Category>(
                    value: selectedCategory ?? categories.first,
                    isExpanded: true,
                    items: [
                      ...categories.map((Category category) {
                        return DropdownMenuItem<Category>(
                          value: category,
                          child: Text(
                            category.name,
                            style: TextStyle(
                              color: selectedCategory == category
                                  ? Colors.blue
                                  : Colors.black,
                            ),
                          ),
                        );
                      }).toList(),
                    ],
                    onChanged: (Category? value) {
                      selectCategory(value!);
                    },
                  ),
                ),
                Container(
                  width: 200,
                  child: DropdownButton<String>(
                    isExpanded: true,
                    value: isAscending ? 'Tri ascendant' : 'Tri descendant',
                    items: [
                      'Tri ascendant',
                      'Tri descendant',
                    ].map((String option) {
                      return DropdownMenuItem<String>(
                        value: option,
                        child: Text(
                          option,
                          style: TextStyle(color: Colors.blue),
                        ),
                      );
                    }).toList(),
                    onChanged: (String? value) {
                      setState(() {
                        isAscending = value == 'Tri ascendant';
                      });
                      updateArticles();
                    },
                  ),
                ),
                Expanded(
                  child: Container(
                    margin: EdgeInsets.symmetric(horizontal: 8),
                    child: TextField(
                      decoration: InputDecoration(
                        hintText: 'Filtrer les articles',
                        filled: true,
                        fillColor: Colors.grey,
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(4),
                          borderSide: BorderSide.none,
                        ),
                        prefixIcon: Icon(
                          Icons.search,
                          color: Colors.grey[300],
                        ),
                      ),
                      style: TextStyle(color: Color.fromARGB(255, 37, 0, 0)),
                      onChanged: (value) {
                        setState(() {
                          searchKeyword = value;
                        });
                        filterArticles();
                      },
                    ),
                  ),
                ),
              ],
            ),
          ),
          Expanded(
            child: Container(
              color: Color.fromARGB(255, 125, 3, 3),
              child: Padding(
                padding: const EdgeInsets.all(8.0),
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
                              searchKeyword: searchKeyword,
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
            ),
          ),
        ],
      ),
    );
  }
}
