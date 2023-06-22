export class UIManager {
    constructor(apiManager) {
        this.apiManager = apiManager;
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

            const link = document.createElement("a");
            link.style.textDecoration = "none";

            const title = document.createElement("h3");
            title.classList.add("text-lg", "font-semibold", "mb-2");
            title.textContent = article.titre;

            const date = document.createElement("p");
            date.classList.add("text-gray-700");
            date.textContent = "Date : " + article.dateCreation;

            const author = document.createElement("span");
            author.classList.add("absolute", "top-0", "right-0", "bg-gray-300", "text-gray-700", "px-2", "py-1", "rounded-md", "text-xs");
            author.textContent = "Auteur : " + article.auteurId;

            li.addEventListener("mouseover", () => {
                li.classList.add("cursor-pointer")
            });

            li.addEventListener("click", (event) => {
                document.querySelector("#mainPage").style.display = "none";
                document.querySelector("#articlePage").style.display = "flex";

                this.apiManager.fetchData(article.url)
                    .then(data => {
                        const article = this.apiManager.convertDataToArticle(data);
                        this.renderArticle(article);
                    })
                    .catch(error => {
                        console.error(error);
                    })
            });

            author.addEventListener("click", (event) => {
                event.stopPropagation();

                this.apiManager.reloadArticles(article.auteurId)
                    .then(articles => {
                        this.renderArticles(articles);
                    })
                    .catch(error => {
                        console.error(error);
                    });

            });

            link.appendChild(title);
            link.appendChild(date);
            link.appendChild(author);
            li.appendChild(link);

            articlesList.appendChild(li);
        }
    }

    renderArticle(article){


        const title = document.createElement("h2");
        title.classList.add("text-2xl", "font-semibold", "mb-4", "text-center");
        title.textContent = article.titre;

        const author = document.createElement("p");
        author.classList.add("text-gray-500", "mb-2", "text-center");
        author.textContent = "Auteur:" + article.auteurId + ", Date de création:" + article.dateCreation;

        const resume = document.createElement("p");
        resume.classList.add("text-gray-700", "mb-6", "text-center");
        resume.innerHTML = this.convertMarkdownHeadersToHTML(article.resume);

        const div = document.createElement("div");
        div.classList.add("prose", "text-center");

        const content = document.createElement("p");
        content.innerHTML = this.convertMarkdownHeadersToHTML(article.contenu);

        div.appendChild(content);

        const details = document.querySelector("#articleDetails");
        details.appendChild(title);
        details.appendChild(author);
        details.appendChild(resume);
        details.appendChild(div);
        details.appendChild(content);

    }

    convertMarkdownHeadersToHTML(markdown) {
        const converter = new showdown.Converter();
        return converter.makeHtml(markdown);
    }


}
