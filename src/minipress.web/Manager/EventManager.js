export class EventManager{
    constructor(apiManager, uiManager) {

        this.apiManager = apiManager;
        this.uiManager = uiManager;

        //Lancement de la recherche avec les paramètres.
        document.querySelector("#search").addEventListener("click", (event) => {
            this.apiManager.reloadArticles()
                .then(articles => {
                    this.uiManager.renderArticles(articles);
                })
                .catch(error => {
                    console.error(error);
                });
        });

        document.querySelector("#showAllArticles").addEventListener("click", () => {
            document.querySelector("#articlePage").style.display = "none";
            document.querySelector("#mainPage").style.display = "flex";
        })

    }

    addArticleHover(li){
        li.addEventListener("mouseover", () => {
            li.classList.add("cursor-pointer")
        });
    }

}