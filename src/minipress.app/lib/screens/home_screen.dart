import 'package:flutter/material.dart';
import 'package:todo_list_v1/models/category.dart';
import 'package:todo_list_v1/services/api_service.dart';

class HomeScreen extends StatefulWidget {
  @override
  _HomeScreenState createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  late Future<List<Category>> _categories;

  @override
  void initState() {
    super.initState();
    _categories = ApiService.fetchCategories();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('MiniPress'),
      ),
      body: FutureBuilder<List<Category>>(
        future: _categories,
        builder: (context, AsyncSnapshot<List<Category>> snapshot) {
          if (snapshot.hasData) {
            List<Category>? categories = snapshot.data;
            if (categories != null) {
              return ListView.builder(
                itemCount: categories.length,
                itemBuilder: (context, index) {
                  Category category = categories[index];
                  return ListTile(
                    title: Text(category.name),
                  );
                },
              );
            } else {
              return Center(
                child: Text('Categories data is null'),
              );
            }
          } else if (snapshot.hasError) {
            return Center(
              child: Text('Failed to fetch categories'),
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
