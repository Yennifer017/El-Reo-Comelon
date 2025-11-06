import Menu from '../models/Menu.js';
import Dish from '../models/Dish.js';
import Food from '../models/Food.js';

/**
 * Convierte la estructura enviada por Laravel en una instancia de Menu en JS
 * @param {Object} data - Objeto crudo recibido desde Laravel (via @json)
 * @returns {Menu|null}
 */
export function parseMenuData(data) {
    if (!data) return null;

    // Extraer los campos básicos
    const name = data.name || "Sin nombre";
    const isPremium = !!data.isPremium;

    // Función auxiliar para crear un Dish a partir de los datos anidados
    function parseDish(dishData) {
        if (!dishData || !dishData.name) return null;

        const ingredients = (dishData.required_food || [])
            .filter(rf => rf.food) // asegurarnos de que tenga 'food'
            .map(rf => {
                const f = rf.food;
                return new Food(
                    f.name ?? "Desconocido",
                    f.url_image ?? "",
                    f.expires_at ?? 0,
                    parseFloat(f.price ?? 0),
                    parseFloat(f.space ?? 0),
                    parseFloat(rf.quantity ?? 0)
                );
            });

        return new Dish(dishData.name, dishData.journey, ingredients);
    }
    
    // Convertir cada comida
    let breakfast = null;
    let lunch = null;
    let dinner = null;

    for (let i = 0; i < data.dish_menus.length; i++) {
        const dishMenu = data.dish_menus[i];
        let currentDish = parseDish(dishMenu.dish);
        switch (currentDish.journey) {
            case 'BREAKFAST':
                breakfast = currentDish;
                break;
            case 'LUNCH':
                lunch = currentDish;
                break;
            default:
                dinner = currentDish;
                break;
        }
    }

    // Crear el Menu final
    return new Menu(name, isPremium, breakfast, lunch, dinner);
}
