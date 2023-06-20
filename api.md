
## Routes

### GET /api/v1/articles[?sort=(date-asc, date-desc, auteur)]

```json
{
  "statusCode": 200,
  "data": [
    {
      "titre": "Titre Article 1",
      "date_creation": "2023-06-15 08:33:46",
      "auteur_id": 1,
      "url": "TODO"
    }
  ]
}
```

### GET /api/v1/categories

```json
{
  "statusCode": 200,
  "data": [
    {
      "id": 1,
      "nom": "Cat\u00e9gorie 1"
    }
  ]
}
```

### GET /api/v1/articles/{id}

```json
{
    "statusCode": 200,
    "data": {
        "id": 1,
        "titre": "Titre Article 1",
        "resume": "R\u00e9sum\u00e9 Article 1",
        "contenu": "Contenu Article 1",
        "date_creation": "2023-06-15 08:33:46",
        "auteur_id": 1
    }
}
```

### GET /api/v1/categories/{id}/articles

```json
{
  "statusCode": 200,
  "data": [
    {
      "title": "Titre Article 2",
      "creation_date": "2023-06-15 08:33:46",
      "url": "TODO"
    }
  ]
}
```

### GET /api/v1/auteurs/{id}/articles

```json
{
  "statusCode": 200,
  "data": [
    {
      "id": 3,
      "titre": "Titre Article 3",
      "resume": "R\u00e9sum\u00e9 Article 3",
      "contenu": "Contenu Article 3",
      "date_creation": "2023-06-15 08:33:46",
      "auteur_id": 2
    }
  ]
}
```
