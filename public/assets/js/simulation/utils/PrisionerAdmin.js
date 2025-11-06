export default class PrisionerAdmin {
    constructor(prisoners, imgSrc, canvas, ctx) {
        this.prisoners = prisoners;
        this.characters = [];
        this.canvas = canvas;
        this.ctx = ctx;
        this.prisonerImg = new Image();
        this.prisonerImg.src = imgSrc;

        for (let i = 0; i < Math.min(prisoners, 50); i++) {
            this.characters.push({
                x: Math.random() * this.canvas.width,
                y: Math.random() * (this.canvas.height / 2) + 50,
                dx: (Math.random() - 0.5) * 3, // velocidad horizontal
                dy: (Math.random() - 0.5) * 2, // velocidad vertical
                size: 32 + Math.random() * 10,
                bob: Math.random() * Math.PI * 2 // fase del movimiento sinusoidal
            });
        }
    }

    getPrisionerImg(){
        return this.prisonerImg;
    }

    drawPrisoners() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        this.characters.forEach(c => {
            // Movimiento base
            c.x += c.dx;
            c.y += c.dy + Math.sin(c.bob) * 0.5;
            c.bob += 0.1;

            // Rebotes horizontales
            if (c.x < 0 || c.x + c.size > this.canvas.width) c.dx *= -1;
            // Rebotes verticales
            if (c.y < 0 || c.y + c.size > this.canvas.height) c.dy *= -1;

            this.ctx.drawImage(this.prisonerImg, c.x, c.y, c.size, c.size);
        });
    }
}
