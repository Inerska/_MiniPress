import {APIManager} from "./APIManager.js";
import {UIManager} from "./UIManager.js";
import {EventManager} from "./EventManager.js";

class App {
    constructor() {
        this.apiManager = new APIManager();
        this.uiManager = new UIManager();
        this.eventManager = new EventManager(this.apiManager, this.uiManager);
    }

    async init() {

        this.apiManager.fetchData("categories")
            .then(categories => {
                this.uiManager.renderCategories(categories)
            })
            .catch(error => {
                console.error(error);
            })

        this.apiManager.fetchData("articles")
            .then(articles => {
                this.uiManager.renderArticles(articles)
            })
            .catch(error => {
                console.error(error);
            })
    }
}
const app = new App();
app.init();
