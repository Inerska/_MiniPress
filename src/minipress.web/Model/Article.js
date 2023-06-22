export class Article {
    constructor(id, titre, resume, contenu, dateCreation, auteurId, url) {
        this.id = id;
        this.titre = titre;
        this.resume = resume;
        this.contenu = contenu;
        this.dateCreation = dateCreation;
        this.auteurId = auteurId;
        this.url = url;
    }


    static sortByDate(articles, sort) {
        switch (sort) {
            case "asc":
                return articles.sort(function(a, b) {
                    const dateA = new Date(a.dateCreation);
                    const dateB = new Date(b.dateCreation);
                    return dateA - dateB;
                });
            case "desc":
                return articles.sort(function(a, b) {
                    const dateA = new Date(a.dateCreation);
                    const dateB = new Date(b.dateCreation);
                    return dateB - dateA;
                });
            default:
                return articles;
        }
    }

    static filterByName(name){

    }
}
