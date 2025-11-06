import Menu from './models/Menu.js';
import Dish from './models/Dish.js';
import Food from './models/Food.js';
import { parseMenuData } from './utils/Converter.js';
import PrisionerAdmin from './utils/PrisionerAdmin.js';
import DayStatistic from './statistics/DayStatistic.js';

const canvas = document.getElementById('simulationCanvas');
const ctx = canvas.getContext('2d');
const consoleOutput = document.getElementById('consoleOutput');

const prisoners = window.simulationData.total_prisoners;
const duration = window.simulationData.duration;
let day = 1;

const percentagePremium = window.simulationData.premium_preference;
const statistics = [];

//menus
const premiumMenu = parseMenuData(window.premiumMenu);
const standardMenu = parseMenuData(window.standardMenu);

// Personajes
const prisionerAdmin = new PrisionerAdmin(prisoners, window.REO_IMG, canvas, ctx);

function logMessage(msg, showDay = false) {
    const p = document.createElement('p');
    if (showDay) {
        p.textContent = `[Día ${day}] ${msg}`;
        p.classList.add('text-blue-300');
    } else {
        p.textContent = `    [Info] ${msg}`
        p.classList.add('text-gray-300');
    }
    consoleOutput.appendChild(p);
    consoleOutput.scrollTop = consoleOutput.scrollHeight;
}

function simulateDay() {
    prisionerAdmin.drawPrisoners();
    logMessage(`Procesando actividades de ${prisoners} reos...`, true);
    day++;

    const dayStatistic = new DayStatistic();
    //por cada prisionero guardar un registro de lo que pidio
    for (let i = 0; i < prisoners; i++) {
        const random = Math.floor(Math.random() * 100); // número entre 0 y 99
        if (random < percentagePremium) {
            dayStatistic.incrementTotalPremiumMenu(premiumMenu);
        } else {
            dayStatistic.incrementTotalStandartMenu(standardMenu);
        }
    }
    logMessage(dayStatistic.getMenusLog());
    logMessage(dayStatistic.getDishesLog());
    statistics.push(dayStatistic);


    //pasar al siguiente dia
    if (day <= duration) {
        setTimeout(simulateDay, 1000);
    } else {
        logMessage("Simulación finalizada... Calculando resultados... ");
    }
}

function animate() {
    prisionerAdmin.drawPrisoners();
    requestAnimationFrame(animate);
}

prisionerAdmin.getPrisionerImg().onload = () => {
    animate();
    simulateDay();
};