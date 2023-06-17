import 'package:flutter/material.dart';
import 'package:todo_list_v1/screens/home_screen.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'MiniPress.app', // Titre de l'application
      theme: ThemeData(
        primarySwatch: Colors.blue, // Couleur principale de l'application
      ),
      home: HomeScreen(), // Page d'accueil de l'application
    );
  }
}
