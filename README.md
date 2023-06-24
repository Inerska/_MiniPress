## Membres
- [Alexis C. GRIDEL](https://github.com/Inerska)
- [Samuel POMIN](https://github.com/Leonarddoo)
- [Théo PELLIZZARI](https://github.com/pellizza1u)


## Installation en localhost
- cd src/minipress.core 
- composer install/update
- docker compose up -d

installer la bd sur adminer : localhost:4500 
shéma et données sql : voir dans le dossier sql a la racine de minipress.core

## Test du projet : 
**minipress.core :** 
* localhost:8080/admin
* Tester l'api : voir le fichier api.md a la racine du projet

*PS :  requetes supplémentaires si nécessaires : GET `/api/v1/categories/$id`, GET `/api/v1/articles`, GET `/api/v1/auteurs`*

**minipress.web :**
- Il suffit simplement de lancer un serveur web en local. Notamment avec `php -S localhost:80`.
- Une fois cela fait, il sera possible d'accèder au site, il faut cependant faire attention d'avoir minipress.core de lancé.

**minipress.app :** 
* `cd src/minipress.app `
* `flutter pub get`
* `flutter run`



                 








