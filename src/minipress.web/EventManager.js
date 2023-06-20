export class EventManager{
    constructor(apiManager, uiManager) {

        this.apiManager = apiManager;
        this.uiManager = uiManager;

        document.querySelector("#categories").addEventListener("change", (event) => {
            const selectedCategory = event.target.value;

            this.apiManager.fetchData("categories/"+selectedCategory+"/articles")
                .then(articles => {
                    this.uiManager.renderArticles(articles);
                })
                .catch(error => {
                    console.error(error);
                })
        });

    }

}