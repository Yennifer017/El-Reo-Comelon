<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Reo Comelón</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/configuration/tailwindConf.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-900 font-techno text-white min-h-screen flex flex-col">

    <x-navbar />

    <div class="max-w-6xl mx-auto mt-10 space-y-8 text-gray-200">

        {{-- 🔹 Datos iniciales de la simulación --}}
        <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">
            <h2 class="text-xl font-semibold text-neonLight mb-3">Información de la simulación</h2>
            <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-400">
                <div>
                    <p><strong>Duración:</strong> {{ $simulationData['duration'] }} días</p>
                    <p><strong>Total de reos:</strong> {{ $simulationData['total_prisoners'] }}</p>
                    <p><strong>Menú estándar:</strong> {{ $simulationData['standard_menu']->name }}</p>
                    @if ($simulationData['premium_menu'])
                        <p><strong>Menú premium:</strong> {{ $simulationData['premium_menu']->name }}</p>
                        <p><strong>Preferencia premium:</strong> {{ $simulationData['premium_preference'] }}%</p>
                    @else
                        <p><strong>Menú premium:</strong> No seleccionado</p>
                    @endif
                </div>
                <div>
                    <p><strong>Bodega principal:</strong> {{ $simulationData['main_storage'] }} m²</p>
                    <p><strong>Bodega alternativa:</strong> {{ $simulationData['alt_storage'] }} m²</p>
                    <p><strong>Costo de compra general:</strong>
                        Q{{ number_format($simulationData['general_purchase_cost'], 2) }}</p>
                    <p><strong>Costo de compra perecederos:</strong>
                        Q{{ number_format($simulationData['perishable_purchase_cost'], 2) }}</p>
                </div>
            </div>
        </div>

        {{-- 🔹 Área del Canvas --}}
        <div class="bg-gray-900 p-4 rounded-xl shadow-lg text-center">
            <h3 class="text-lg font-semibold text-neonLight mb-2">Simulación en progreso</h3>
            <canvas id="simulationCanvas" width="900" height="400"
                class="w-full rounded-lg bg-gray-800 border border-gray-700"></canvas>
        </div>

        {{-- 🔹 Consola de resultados --}}
        <div class="bg-black p-4 rounded-xl shadow-inner border border-gray-700 font-mono text-sm">
            <div id="consoleOutput" class="h-56 overflow-y-auto space-y-1">
                <p class="text-gray-400">[Sistema] Iniciando simulación...</p>
            </div>
        </div>
    </div>

    {{-- 🔹 Script para manejar los datos y animación --}}
    <script>
        // Pasamos los datos PHP a JavaScript
        window.simulationData = @json($simulationData);

        const canvas = document.getElementById('simulationCanvas');
        const ctx = canvas.getContext('2d');
        const consoleOutput = document.getElementById('consoleOutput');

        const prisoners = window.simulationData.total_prisoners;
        const duration = window.simulationData.duration;
        let day = 1;

        // Personajes
        const prisonerImg = new Image();
        prisonerImg.src = "{{ asset('assets/img/reo.png') }}";

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
            if(showDay){
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
            logMessage(`Procesando actividades de ${prisoners} reos...`);
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
    </script>


    <x-footer />

</body>

</html>
