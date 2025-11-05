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

    <section class="relative mt-12">
        <div
            class="bg-gradient-to-r from-neonBlue to-blue-600 text-center rounded-2xl mx-4 md:mx-auto max-w-5xl p-12 shadow-2xl border border-neonLight">
            <h2 class="text-5xl md:text-6xl font-bold mb-4 tracking-wide drop-shadow-lg">Inicializar la simulación</h2>
        </div>
    </section>

    <x-feedback />

    <section class="container mx-auto py-8 px-20">

        <form method="POST" action="{{ route('simulation.start') }}"
            class="bg-gray-800 p-6 rounded-2xl shadow-lg space-y-8">
            @csrf

            <div>
    <h3 class="text-2xl font-semibold text-white mb-4 border-b border-gray-600 pb-2">
        Configuración general
    </h3>

    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label for="duration" class="block text-gray-300 font-medium mb-2">
                Duración de la simulación (días)
            </label>
            <input type="number" name="duration" id="duration" min="1" required
                class="w-full bg-gray-900 text-white rounded-lg px-4 py-2 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-neonLight">
        </div>

        <div>
            <label for="total_prisoners" class="block text-gray-300 font-medium mb-2">
                Total de reos
            </label>
            <input type="number" name="total_prisoners" id="total_prisoners" min="1" required
                class="w-full bg-gray-900 text-white rounded-lg px-4 py-2 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-neonLight">
        </div>

        <div>
            <label for="general_purchase_cost" class="block text-gray-300 font-medium mb-2">
                Costo general de compras (Q)
            </label>
            <input type="number" step="0.01" name="general_purchase_cost" id="general_purchase_cost" min="0" required
                class="w-full bg-gray-900 text-white rounded-lg px-4 py-2 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-neonLight"
                placeholder="Ejemplo: 1500.00">
        </div>

        <div>
            <label for="perishable_purchase_cost" class="block text-gray-300 font-medium mb-2">
                Costo de compras perecederas (Q)
            </label>
            <input type="number" step="0.01" name="perishable_purchase_cost" id="perishable_purchase_cost" min="0" required
                class="w-full bg-gray-900 text-white rounded-lg px-4 py-2 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-neonLight"
                placeholder="Ejemplo: 500.00">
        </div>
    </div>
</div>



            <div>
                <h3 class="text-2xl font-semibold text-white mb-4 border-b border-gray-600 pb-2">
                    Elección de menús
                </h3>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="standard_menu" class="block text-gray-300 font-medium mb-2">
                            Menú estándar (requerido)
                        </label>
                        <select name="standard_menu" id="standard_menu" required
                            class="w-full bg-gray-900 text-white rounded-lg px-4 py-2 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-neonLight">
                            <option value="">-- Selecciona un menú estándar --</option>
                            @foreach ($standarMenus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="premium_menu" class="block text-gray-300 font-medium mb-2">
                            Menú premium (opcional)
                        </label>
                        <select name="premium_menu" id="premium_menu"
                            class="w-full bg-gray-900 text-white rounded-lg px-4 py-2 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-neonLight">
                            <option value="">-- Selecciona un menú premium --</option>
                            @foreach ($premiumMenus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="premium_preference" class="block text-gray-300 font-medium mb-2">
                        Porcentaje de preferencia para menús premium (%)
                    </label>
                    <input type="number" name="premium_preference" id="premium_preference" min="0"
                        max="100" value="0"
                        class="w-full bg-gray-900 text-white rounded-lg px-4 py-2 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-neonLight">
                </div>
            </div>

            <div>
                <h3 class="text-2xl font-semibold text-white mb-4 border-b border-gray-600 pb-2">Espacios de bodega</h3>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="main_storage" class="block text-gray-300 font-medium mb-2">
                            Espacio en bodega principal (m²)
                        </label>
                        <input type="number" name="main_storage" id="main_storage" min="1" required
                            class="w-full bg-gray-900 text-white rounded-lg px-4 py-2 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-neonLight">
                    </div>

                    <div>
                        <label for="alt_storage" class="block text-gray-300 font-medium mb-2">
                            Espacio en bodega alternativa (m²)
                        </label>
                        <input type="number" name="alt_storage" id="alt_storage" min="0"
                            class="w-full bg-gray-900 text-white rounded-lg px-4 py-2 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-neonLight">
                    </div>
                </div>
            </div>

            <div class="text-center pt-6">
                <button type="submit"
                    class="bg-neonLight text-gray-900 font-semibold px-6 py-3 rounded-lg hover:scale-105 transform transition duration-300 shadow-lg">
                    Iniciar Simulación
                </button>
            </div>
        </form>

    </section>


    <x-footer />

</body>

</html>
