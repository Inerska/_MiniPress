export class UIManager {
    constructor() {
        // Initialisez les propriétés nécessaires pour la gestion de l'interface utilisateur
    }

    renderCategories(categories){
        const categoriesList = document.querySelector("#categories");

        for(const category of categories){
            const option = document.createElement("option");
            option.value = category.id;
            option.textContent = category.nom;
            categoriesList.appendChild(option);
        }
    }

    renderArticles(articles) {
        const articlesList = document.querySelector("#articles");
        articlesList.innerHTML = "";

        for (const article of articles) {
            const li = document.createElement("li");
            li.classList.add("bg-white", "shadow-md", "rounded-lg", "p-4");
            li.style.position = "relative"; // Ajouter la position relative

            const title = document.createElement("h3");
            title.classList.add("text-lg", "font-semibold", "mb-2");
            title.textContent = article.titre;

            const date = document.createElement("p");
            date.classList.add("text-gray-700");
            date.textContent = article.date_creation;

            const author = document.createElement("span");
            author.classList.add("absolute", "top-0", "right-0", "bg-gray-300", "text-gray-700", "px-2", "py-1", "rounded-md", "text-xs");
            author.textContent = "ID : " + article.auteur_id;

            li.appendChild(title);
            li.appendChild(date);
            li.appendChild(author);

            articlesList.appendChild(li);
        }
    }

}
