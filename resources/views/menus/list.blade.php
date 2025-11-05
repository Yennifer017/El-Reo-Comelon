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
            <h2 class="text-5xl md:text-6xl font-bold mb-4 tracking-wide drop-shadow-lg">Menús</h2>
        </div>
    </section>

    <x-feedback />

    <!-- Sección: agregar -->
    <section class="mx-4 md:mx-auto max-w-4xl mt-12 w-full">
        <div class="text-center mb-6">
            <a id="toggleFormBtn" href="/menus/create"
                class="bg-neonLight text-gray-900 px-8 py-3 rounded-full font-semibold hover:scale-105 transform transition duration-300 shadow-lg">
                + Agregar Menu
            </a>
        </div>
    </section>

    <!-- Sección: lista -->
    <section class="mx-4 md:mx-auto max-w-6xl mt-16 mb-12 w-full">
        <h3 class="text-3xl font-bold mb-8 text-center text-neonLight">Lista de Menús</h3>

        <div>
            @if (!$menus->isEmpty())
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900 text-neonLight uppercase text-sm">
                        <tr>
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Nombre del Menú</th>
                            <th class="px-6 py-3 text-left">Tipo</th>
                            <th class="px-6 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700 text-gray-300">
                        @foreach ($menus as $index => $menu)
                            <tr class="hover:bg-gray-700/40 transition duration-200">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-semibold text-white">{{ $menu->name }}</td>
                                <td class="px-6 py-4">
                                    @if ($menu->is_premium)
                                        <span
                                            class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-xs font-semibold">
                                            Premium
                                        </span>
                                    @else
                                        <span
                                            class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs font-semibold">
                                            Estándar
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    {{-- Botón Detalles --}}
                                    <a href="{{ route('menus.show', $menu->id) }}"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold 
               hover:bg-blue-700 hover:scale-105 transition duration-200">
                                        Detalles
                                    </a>

                                    {{-- Botón Eliminar --}}
                                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-4 py-2 rounded-lg font-semibold 
                   hover:bg-red-700 hover:scale-105 transition duration-200">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="col-span-full text-center text-gray-400 text-xl py-12">
                    No hay menús registrados todavía.
                </div>
            @endIf
        </div>
    </section>

</body>

</html>
