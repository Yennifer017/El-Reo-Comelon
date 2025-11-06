import Menu from './models/Menu.js';
import Dish from './models/Dish.js';
import Food from './models/Food.js';
import { parseMenuData } from './utils/Converter.js';

const canvas = document.getElementById('simulationCanvas');
const ctx = canvas.getContext('2d');
const consoleOutput = document.getElementById('consoleOutput');

const prisoners = window.simulationData.total_prisoners;
const duration = window.simulationData.duration;
let day = 1;

//menus
const premiumMenu = parseMenuData(window.premiumMenu);
const standardMenu = parseMenuData(window.standardMenu);

console.log(premiumMenu);
console.log(standardMenu);

// Personajes
const prisonerImg = new Image();
prisonerImg.src = window.REO_IMG;

const characters = [];
for (let i = 0; i < Math.min(prisoners, 50); i++) {
    characters.push({
        x: Math.random() * canvas.width,
        y: Math.random() * (canvas.height / 2) + 50,
        dx: (Math.random() - 0.5) * 3, // velocidad horizontal
        dy: (Math.random() - 0.5) * 2, // velocidad vertical
        size: 32 + Math.random() * 10,
        bob: Math.random() * Math.PI * 2 // fase de movimiento sinusoidal
    });
}

function drawPrisoners() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    characters.forEach(c => {
        // Movimiento base
        c.x += c.dx;
        c.y += c.dy + Math.sin(c.bob) * 0.5;
        c.bob += 0.1;

        // Rebotes horizontales
        if (c.x < 0 || c.x + c.size > canvas.width) c.dx *= -1;
        // Rebotes verticales
        if (c.y < 0 || c.y + c.size > canvas.height) c.dy *= -1;

        ctx.drawImage(prisonerImg, c.x, c.y, c.size, c.size);
    });
}

function logMessage(msg, showDay = false) {
    const p = document.createElement('p');
    if (showDay) {
        p.textContent = `[Día ${day}] ${msg}`;
    } else {
        p.textContent = `[Info] ${msg}`
    }
    p.classList.add('text-gray-300');
    consoleOutput.appendChild(p);
    consoleOutput.scrollTop = consoleOutput.scrollHeight;
}

function simulateDay() {
    drawPrisoners();
    logMessage(`Procesando actividades de ${prisoners} reos...`, true);
    day++;
    if (day <= duration) {
        setTimeout(simulateDay, 1000);
    } else {
        logMessage("Simulación finalizada ✅");
    }
}

function animate() {
    drawPrisoners();
    requestAnimationFrame(animate);
}

prisonerImg.onload = () => {
    animate();
    simulateDay();
};