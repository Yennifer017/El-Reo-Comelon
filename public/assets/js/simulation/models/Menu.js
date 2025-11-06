import Dish from './Dish.js';

export default class Menu {
    constructor(name, isPremium, breakfast, lunch, dinner) {
        this.name = name;
        this.isPremium = isPremium;
        this.breakfast = breakfast instanceof Dish ? breakfast : null;
        this.lunch = lunch instanceof Dish ? lunch : null;
        this.dinner = dinner instanceof Dish ? dinner : null;
    }

    totalCost() {
        return (
            this.breakfast.totalPrice() +
            this.lunch.totalPrice() +
            this.dinner.totalPrice()
        );
    }
}
