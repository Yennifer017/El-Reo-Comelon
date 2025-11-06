import Menu from '../models/Menu.js';
import Dish from '../models/Dish.js';
import Food from '../models/Food.js';

export default class DayStatistic {
    constructor() {
        this.totalPremiumMenu = 0;
        this.totalStandartMenu = 0;
        this.dishStatistics = {};
        this.foodStatistics = {};
    }

    getTotalPremiumMenu() {
        return this.totalPremiumMenu;
    }

    getTotalStandartMenu() {
        return this.totalStandartMenu;
    }

    getDishStatistics() {
        return this.dishStatistics;
    }

    getFoodStatistics() {
        return this.foodStatistics;
    }

    incrementTotalPremiumMenu(menu) {
        this.totalPremiumMenu++;
        this._addStatistics(menu);
    }

    incrementTotalStandartMenu(menu) {
        this.totalStandartMenu++;
        this._addStatistics(menu);
    }

    _addStatistics(menu) {
        // recorrer los platillos del menú
        for (const dishKey of ['breakfast', 'lunch', 'dinner']) {
            const dish = menu[dishKey];
            if (!dish) continue;

            // actualizar estadísticas de platillos
            if (!this.dishStatistics[dish.name]) {
                this.dishStatistics[dish.name] = 1;
            } else {
                this.dishStatistics[dish.name]++;
            }

            // actualizar estadísticas de alimentos dentro del platillo
            if (dish.ingredients && Array.isArray(dish.ingredients)) {
                for (const food of dish.ingredients) {
                    if (!this.foodStatistics[food.name]) {
                        this.foodStatistics[food.name] = {
                            quantity: food.quantity,
                            food: food
                        };
                    } else {
                        this.foodStatistics[food.name].quantity += food.quantity;
                    }
                }
            }
        }
    }

    getMenusLog(){
        return `Total de menus premium: ${this.totalPremiumMenu}, total de menus estandar: ${this.totalStandartMenu}`;
    }

    getDishesLog() {
        let text = '';
        text += "Estadísticas de platillos: \n";
        for (const [dishName, count] of Object.entries(this.dishStatistics)) {
            text += ` - ${dishName}: ${count}\n`;
        }
        return text;
    }
}