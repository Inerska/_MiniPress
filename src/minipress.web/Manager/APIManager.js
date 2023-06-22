import {Article} from "../Model/Article.js";
import {Category} from "../Model/Category.js";

export class APIManager {
    constructor() {
        this.baseURL = 'http://127.0.0.1:8080/api/v1';
    }

    fetchData(endpoint) {
        const url = `${this.baseURL}${endpoint}`;

        return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de la récupération des données de l\'API.');
                }
                return response.json();
            })
            .then(data => {
                return data['data'];
            })
            .catch(error => {
                throw error;
            });
    }


    convertDataToCategories(data){
        return data.map(item => {
            return new Category(
                item.id,
                item.nom
            );
        });
    }

    convertDataToArticles(data){
        return data.map(item => {
            return new Article(
                null,
                item.titre,
                null,
                null,
                item.date_creation,
                item.auteur_id,
                item.url
            );
        });
    }

    convertDataToArticle(data){
        return new Article(
            data.id,
            data.titre,
            data.resume,
            data.contenu,
            data.date_creation,
            data.auteur_id,
            null
        );
    }

    getEndPointByCategory(category){
        if (category === "none"){
            return "/articles"
        }else{
            return "/categories/"+category+"/articles";
        }
    }

    reloadArticles(author) {
        const category = document.querySelector("#categories").value;
        const endPoint = this.getEndPointByCategory(category);

        return this.fetchData(endPoint)
            .then(data => {
                let advancedArticles = this.convertDataToArticles(data).map(article => {
                    return this.fetchData(article.url)
                        .then(data => {
                            return this.convertDataToArticle(data);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });

                // Utilisation de Promise.all pour attendre que toutes les promesses se terminent
                return Promise.all(advancedArticles)
                    .then(articles => {

                        // Filtrer par auteur
                        if (typeof author !== 'undefined' && author !== null) {
                            articles = articles.filter(article => article.auteurId === author);
                        }

                        const filter = document.querySelector("#filter").value;
                        const isChecked = document.querySelector("#include-content").checked;

                        if (filter !== "") {
                            articles = articles.filter(article => {
                                if (isChecked) {
                                    // Filtrer si le titre inclut le filtre OU si le contenu inclut le titre
                                    return article.titre.includes(filter) || article.contenu.includes(filter);
                                } else {
                                    // Filtrer uniquement si le titre inclut le filtre
                                    return article.titre.includes(filter);
                                }
                            });
                        }

                        // Trier les articles
                        const selectedSort = document.querySelector("#sort").value;
                        articles = Article.sortByDate(articles, selectedSort);

                        return articles;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            })
            .catch(error => {
                console.error(error);
            });
    }


}

