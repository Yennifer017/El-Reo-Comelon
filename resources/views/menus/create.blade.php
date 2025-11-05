<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Reo Comelón - Alimentos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/configuration/tailwindConf.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-900 font-techno text-white min-h-screen flex flex-col">

    <x-navbar />

    <section class="relative mt-12">
        <div
            class="bg-gradient-to-r from-neonBlue to-blue-600 text-center rounded-2xl mx-4 md:mx-auto max-w-5xl p-12 shadow-2xl border border-neonLight">
            <h2 class="text-5xl md:text-6xl font-bold mb-4 tracking-wide drop-shadow-lg">Crear </h2>
        </div>
    </section>

    <x-feedback />

    <section class="max-w-6xl mx-auto px-6 py-8">
        <form method="POST" action="{{ route('menus.store') }}" class="bg-gray-800 p-6 rounded-2xl shadow-lg">
            @csrf

            {{-- Nombre del menú y checkbox premium --}}
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1">
                    <label for="name" class="block text-white font-semibold mb-2">Nombre del menú</label>
                    <input type="text" name="name" id="name"
                        class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-neonLight"
                        placeholder="Ej: Menú Chapín" required>
                </div>

                <!-- Checkbox Premium -->
                <div class="mt-2 md:mt-0 flex items-center gap-3">
                    <!-- hidden para enviar 0 si no está marcado -->
                    <input type="hidden" name="is_premium" value="0">
                    <label class="flex items-center cursor-pointer select-none">
                        <input type="checkbox" name="is_premium" value="1"
                            class="w-5 h-5 accent-neonLight rounded">
                        <span class="ml-2 text-gray-200 font-medium">Premium</span>
                    </label>
                </div>
            </div>

            {{-- Contenedor de 3 columnas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Desayuno --}}
                <div class="bg-gray-900 border border-gray-700 rounded-xl p-5 shadow-inner">
                    <h4 class="text-lg font-bold text-yellow-400 mb-3 text-center">Desayuno</h4>
                    <label class="block text-gray-300 mb-2">Selecciona el plato</label>
                    <select name="breakfast_dish_id"
                        class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        required>
                        <option value="">-- Selecciona un desayuno --</option>
                        @foreach ($breakfasts as $dish)
                            <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Almuerzo --}}
                <div class="bg-gray-900 border border-gray-700 rounded-xl p-5 shadow-inner">
                    <h4 class="text-lg font-bold text-green-400 mb-3 text-center">Almuerzo</h4>
                    <label class="block text-gray-300 mb-2">Selecciona el plato</label>
                    <select name="lunch_dish_id"
                        class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-400"
                        required>
                        <option value="">-- Selecciona un almuerzo --</option>
                        @foreach ($lunchs as $dish)
                            <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Cena --}}
                <div class="bg-gray-900 border border-gray-700 rounded-xl p-5 shadow-inner">
                    <h4 class="text-lg font-bold text-blue-400 mb-3 text-center">Cena</h4>
                    <label class="block text-gray-300 mb-2">Selecciona el plato</label>
                    <select name="dinner_dish_id"
                        class="w-full bg-gray-700 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required>
                        <option value="">-- Selecciona una cena --</option>
                        @foreach ($dinners as $dish)
                            <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Botón --}}
            <div class="text-center mt-8">
                <button type="submit"
                    class="bg-neonLight text-black font-bold px-6 py-3 rounded-lg hover:scale-105 transition duration-300">
                    Guardar Menú
                </button>
            </div>
        </form>
    </section>


</body>

</html>
