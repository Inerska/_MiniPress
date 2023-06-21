export class EventManager{
    constructor(apiManager, uiManager) {

        this.apiManager = apiManager;
        this.uiManager = uiManager;

        document.querySelector("#categories").addEventListener("change", (event) => {
            const selectedCategory = event.target.value;

            document.querySelector("#sort").value = "asc";

            this.apiManager.fetchData("categories/"+selectedCategory+"/articles")
                .then(articles => {
                    this.uiManager.renderArticles(articles);
                })
                .catch(error => {
                    console.error(error);
                })
        });

        document.querySelector("#sort").addEventListener("change", (event) => {
            const selectedSort = event.target.value;

            this.apiManager.fetchData("articles?sort="+selectedSort)
                .then(articles => {
                    this.uiManager.renderArticles(articles);
                })
                .catch(error => {
                    console.error(error);
                })
        });

    }

}