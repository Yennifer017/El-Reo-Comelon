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

        {{-- Datos iniciales de la simulación --}}
        <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">
            <h2 class="text-xl font-semibold text-neonLight mb-3">Información de la simulación</h2>
            <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-400">
                <div>
                    <p><strong>Duración:</strong> {{ $simulationData['duration'] }} días</p>
                    <p><strong>Total de reos:</strong> {{ $simulationData['total_prisoners'] }}</p>
                    <p><strong>Menú estándar:</strong> {{ $standardMenu->name }}</p>
                    @if ($premiumMenu)
                        <p><strong>Menú premium:</strong> {{ $premiumMenu->name }}</p>
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

        {{-- Área del Canvas --}}
        <div class="bg-gray-900 p-4 rounded-xl shadow-lg text-center">
            <h3 class="text-lg font-semibold text-neonLight mb-2">Simulación en progreso</h3>
            <canvas id="simulationCanvas" width="900" height="400"
                class="w-full rounded-lg bg-gray-800 border border-gray-700"></canvas>
        </div>

        {{-- Consola de resultados --}}
        <div class="bg-black p-4 rounded-xl shadow-inner border border-gray-700 font-mono text-sm">
            <div id="consoleOutput" class="h-56 overflow-y-auto space-y-1">
                <p class="text-gray-400">[Sistema] Iniciando simulación...</p>
            </div>
        </div>
    </div>

    <script>
        
        window.simulationData = @json($simulationData);
        window.REO_IMG = "{{ asset('assets/img/reo.png') }}";

        window.premiumMenu = @json($premiumMenu ?? []);
        window.standardMenu = @json($standardMenu);
    </script>
    <script type="module" src="{{ asset('assets/js/simulation/Run.js') }}"></script>


    <x-footer />

</body>

</html>
