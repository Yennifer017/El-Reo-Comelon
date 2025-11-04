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
            <h2 class="text-5xl md:text-6xl font-bold mb-4 tracking-wide drop-shadow-lg">Agregar un platillo</h2>
        </div>
    </section>

    <x-feedback />

    <section class="relative m-12">

        <div>
            <form action="{{ route('dishes.store') }}" method="POST"
                class="bg-gray-900 p-6 rounded-2xl shadow-lg border border-neonLight max-w-3xl mx-auto">
                @csrf

                {{-- Nombre del platillo --}}
                <div class="mb-6">
                    <label for="name" class="block text-neonLight font-semibold mb-2">Nombre del platillo</label>
                    <input type="text" id="name" name="name"
                        class="w-full bg-gray-800 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-neonLight"
                        placeholder="Ej. Pollo a la plancha" required>
                </div>

                {{-- Jornada --}}
                <div class="mb-6">
                    <label for="journey" class="block text-neonLight font-semibold mb-2">Jornada</label>
                    <select id="journey" name="journey"
                        class="w-full bg-gray-800 text-white border border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-neonLight"
                        required>
                        <option value="">-- Selecciona una opción --</option>
                        <option value="BREAKFAST">Desayuno</option>
                        <option value="LUNCH">Almuerzo</option>
                        <option value="DINNER">Cena</option>
                    </select>
                </div>

                {{-- Lista de alimentos --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-neonLight mb-4">Alimentos requeridos</h2>

                    @forelse ($foods as $food)
                        <div
                            class="flex items-center justify-between mb-3 bg-gray-800 p-3 rounded-lg border border-gray-700">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="foods[{{ $food->id }}][selected]"
                                    id="food_{{ $food->id }}" value="1"
                                    class="w-5 h-5 text-neonLight focus:ring-neonLight accent-neonLight">
                                <label for="food_{{ $food->id }}"
                                    class="text-white font-medium">{{ $food->name }}</label>
                            </div>
                            <input type="number" name="foods[{{ $food->id }}][quantity]" placeholder="Cantidad"
                                step="any"
                                class="bg-gray-700 text-white border border-gray-600 rounded-lg p-2 w-36 focus:outline-none focus:ring-2 focus:ring-neonLight">

                        </div>
                    @empty
                        <p class="text-gray-400 italic text-center">No hay alimentos registrados.</p>
                    @endforelse
                </div>

                {{-- Botón --}}
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-neonBlue text-white px-6 py-3 rounded-lg font-semibold hover:scale-105 transition duration-300 shadow-lg">
                        Guardar platillo
                    </button>
                </div>
            </form>

        </div>
    </section>

    <x-footer />

</body>

</html>
