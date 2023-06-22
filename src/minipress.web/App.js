import {APIManager} from "./Manager/APIManager.js";
import {UIManager} from "./Manager/UIManager.js";
import {EventManager} from "./Manager/EventManager.js";


class App {
    constructor() {
        this.apiManager = new APIManager();
        this.uiManager = new UIManager(this.apiManager);
        this.eventManager = new EventManager(this.apiManager, this.uiManager);
    }

    async init() {

        this.apiManager.fetchData("/categories")
            .then(data => {
                const categories = this.apiManager.convertDataToCategories(data);
                this.uiManager.renderCategories(categories)
            })
            .catch(error => {
                console.error(error);
            })

        //Afficher les articles
        this.apiManager.fetchData("/articles")
            .then(data => {
                const articles = this.apiManager.convertDataToArticles(data);
                this.uiManager.renderArticles(articles);
            })
            .catch(error => {
                console.error(error);
            });


    }
}
const app = new App();
app.init();
