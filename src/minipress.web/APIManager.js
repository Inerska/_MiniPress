import {Config} from "./Config.js";

export class APIManager {
    constructor() {
        // Initialisez les propriétés nécessaires pour la gestion des API
    }

    fetchData(endpoint) {
        const url = `${Config.baseURL}/${endpoint}`;

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
}

