import Food from './Food.js';

export default class Dish {
    constructor(name, journey, ingredients = []) {
        this.name = name;
        this.journey = journey;
        this.ingredients = ingredients.map(i => i instanceof Food ? i : null);
    }

    totalStorage() {
        return this.ingredients.reduce((sum, f) => sum + f.storageSpace, 0);
    }

    totalPrice() {
        return this.ingredients.reduce((sum, f) => sum + f.price, 0);
    }
}