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
            <h2 class="text-5xl md:text-6xl font-bold mb-4 tracking-wide drop-shadow-lg">Platillos</h2>
        </div>
    </section>

    <!-- feedback -->
    <section class="mx-4 md:mx-auto max-w-6xl mt-3 w-full">
        @if (session('success'))
            <div class="bg-green-600 text-white p-3 rounded-lg text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-600 text-white p-3 rounded-lg text-center mb-4">
                <ul class="list-none">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </section>

    <!-- Sección: agregar -->
    <section class="mx-4 md:mx-auto max-w-4xl mt-12 w-full">
        <div class="text-center mb-6">
            <button id="toggleFormBtn"
                class="bg-neonLight text-gray-900 px-8 py-3 rounded-full font-semibold hover:scale-105 transform transition duration-300 shadow-lg">
                + Agregar platillo
            </button>
        </div>
    </section>

    <!-- Sección: lista -->
    <section class="mx-4 md:mx-auto max-w-6xl mt-16 mb-12 w-full">
        <h3 class="text-3xl font-bold mb-8 text-center text-neonLight">Lista de Platillos</h3>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3" x-data="{ openModal: false, editFoodId: null, editName: '', editPrice: 0, editSpace: 0, editUrlImage: '', editExpiresAt: 0 }">
            @forelse($dishes as $dish)
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900 text-neonLight uppercase text-sm">
                        <tr>
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Nombre</th>
                            <th class="px-6 py-3 text-left">Jornada</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700 text-gray-300">
                        @foreach ($dishes as $index => $dish)
                            <tr class="hover:bg-gray-700/40 transition duration-200">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-semibold text-white">{{ $dish->nombre }}</td>
                                <td class="px-6 py-4">
                                    @if ($dish->journey === 'BREAKFAST')
                                        <span
                                            class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-xs font-semibold">Desayuno</span>
                                    @elseif ($dish->journey === 'LUNCH')
                                        <span
                                            class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs font-semibold">Almuerzo</span>
                                    @else
                                        <span
                                            class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-xs font-semibold">Cena</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <button
                                        class="bg-blue-500 px-4 py-2 rounded-lg font-semibold hover:scale-105 transition duration-300">
                                        Detalles
                                    </button>
                                    <form action="{{ route('dishes.destroy', $dish->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 px-4 py-2 rounded-lg font-semibold hover:scale-105 transition duration-300">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @empty
                <div class="col-span-full text-center text-gray-400 text-xl py-12">
                    No hay platillos registrados todavía.
                </div>
            @endforelse
        </div>
    </section>

</body>

</html>
