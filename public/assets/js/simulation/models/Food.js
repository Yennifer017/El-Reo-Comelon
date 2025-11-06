export default class Food {
    constructor(name, urlImg, expiresAt, price, storageSpace, quantity) {
        this.name = name;
        this.urlImg = urlImg;
        this.expiresAt = expiresAt;   // en días, por ejemplo
        this.price = price;
        this.storageSpace = storageSpace;
        this.quantity = quantity;
    }
    

}