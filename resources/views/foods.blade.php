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
            <h2 class="text-5xl md:text-6xl font-bold mb-4 tracking-wide drop-shadow-lg">Alimentos</h2>
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

    <!-- Sección: agregar alimento -->
    <section class="mx-4 md:mx-auto max-w-4xl mt-12 w-full">
        <div class="text-center mb-6">
            <button id="toggleFormBtn"
                class="bg-neonLight text-gray-900 px-8 py-3 rounded-full font-semibold hover:scale-105 transform transition duration-300 shadow-lg">
                + Agregar Alimento
            </button>
        </div>

        <!-- Formulario oculto -->
        <div id="formContainer"
            class="hidden bg-gray-800 p-6 rounded-2xl border border-neonLight shadow-2xl transition-all duration-300">
            <h3 class="text-2xl font-bold mb-4 text-neonLight">Nuevo Alimento</h3>

            <form method="POST" action="{{ route('food.store') }}" class="grid gap-4 md:grid-cols-2">
                @csrf
                <div>
                    <label for="name" class="block text-gray-300 mb-2">Nombre del alimento</label>
                    <input id="name" name="name" type="text"
                        class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 focus:border-neonLight focus:ring focus:ring-neonLight/40 outline-none"
                        placeholder="Ej. Bolsa de arroz">
                </div>

                <div>
                    <label for="price" class="block text-gray-300 mb-2">Precio (Q)</label>
                    <input id="price" name="price" type="number" step="0.01"
                        class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 focus:border-neonLight focus:ring focus:ring-neonLight/40 outline-none"
                        placeholder="Ej. 15.00">
                </div>

                <div>
                    <label for="space" class="block text-gray-300 mb-2">Espacio ocupado (m³)</label>
                    <input id="space" name="space" type="number" step="0.01"
                        class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 focus:border-neonLight focus:ring focus:ring-neonLight/40 outline-none"
                        placeholder="Ej. 0.25">
                </div>

                <div>
                    <label for="url_image" class="block text-gray-300 mb-2">URL de imagen</label>
                    <input id="url_image" name="url_image" type="text"
                        class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 focus:border-neonLight focus:ring focus:ring-neonLight/40 outline-none"
                        placeholder="https://...">
                </div>

                <div class="md:col-span-2">
                    <label for="expires_at" class="block text-gray-300 mb-2">Días hasta vencer</label>
                    <input id="expires_at" name="expires_at" type="number"
                        class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 focus:border-neonLight focus:ring focus:ring-neonLight/40 outline-none"
                        placeholder="Ej. 30">
                </div>

                <div class="md:col-span-2 text-right">
                    <button type="submit"
                        class="bg-neonLight text-gray-900 px-6 py-3 rounded-full font-semibold hover:scale-105 transform transition duration-300 shadow-lg">
                        Guardar alimento
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Sección: lista de alimentos -->
    <section class="mx-4 md:mx-auto max-w-6xl mt-16 mb-12 w-full">
        <h3 class="text-3xl font-bold mb-8 text-center text-neonLight">Lista de Alimentos</h3>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3" x-data="{ openModal: false, editFoodId: null, editName: '', editPrice: 0, editSpace: 0, editUrlImage: '', editExpiresAt: 0 }">
            @forelse($foods as $food)
                <div
                    class="bg-gray-800 border border-neonLight rounded-2xl p-6 shadow-lg hover:shadow-neonLight/40 transition duration-300 flex flex-col justify-between">

                    <div class="w-full h-48 mb-4 border border-gray-700 rounded-xl overflow-hidden">
                        <img src="{{ $food->url_image ?? 'https://via.placeholder.com/400x400' }}"
                            alt="{{ $food->name }}" class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1">
                        <h4 class="text-2xl font-bold mb-2 text-white">{{ $food->name }}</h4>
                        <p class="text-gray-400 text-sm mb-2">
                            Espacio ocupado: <span class="font-semibold">{{ $food->space }} m³</span>
                        </p>
                        <p class="text-gray-300 mb-2">
                            Días hasta vencer: <span class="font-semibold">{{ $food->expires_at }}</span>
                        </p>
                        <p class="text-neonLight font-semibold mb-6">
                            Precio: Q{{ number_format($food->price, 2) }}
                        </p>
                    </div>

                    <div class="flex justify-between mt-auto gap-2">
                        <!-- Botón Editar -->
                        <button
                            @click="openModal = true; editFoodId = {{ $food->id }}; editName='{{ $food->name }}'; editPrice={{ $food->price }}; editSpace={{ $food->space }}; editUrlImage='{{ $food->url_image }}'; editExpiresAt={{ $food->expires_at }}"
                            class="bg-blue-500 flex-1 px-4 py-2 rounded-lg font-semibold hover:scale-105 transition duration-300">
                            Editar
                        </button>

                        <!-- Eliminar -->
                        <form action="{{ route('food.destroy', $food->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 w-full px-4 py-2 rounded-lg font-semibold hover:scale-105 transition duration-300">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400 text-xl py-12">
                    No hay alimentos registrados todavía.
                </div>
            @endforelse

            <!-- Modal -->
            <div x-show="openModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-gray-800 p-6 rounded-2xl border border-neonLight shadow-2xl w-full max-w-lg relative">
                    <h3 class="text-2xl font-bold mb-4 text-neonLight">Editar Alimento</h3>
                    <form :action="`/food/${editFoodId}`" method="POST" class="grid gap-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-gray-300 mb-2">Nombre</label>
                            <input type="text" name="name" x-model="editName"
                                class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 focus:border-neonLight focus:ring focus:ring-neonLight/40 outline-none">
                        </div>

                        <div>
                            <label class="block text-gray-300 mb-2">Precio</label>
                            <input type="number" step="0.01" name="price" x-model="editPrice"
                                class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 focus:border-neonLight focus:ring focus:ring-neonLight/40 outline-none">
                        </div>

                        <div>
                            <label class="block text-gray-300 mb-2">Espacio ocupado</label>
                            <input type="number" step="0.01" name="space" x-model="editSpace"
                                class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 focus:border-neonLight focus:ring focus:ring-neonLight/40 outline-none">
                        </div>

                        <div>
                            <label class="block text-gray-300 mb-2">URL de imagen</label>
                            <input type="text" name="url_image" x-model="editUrlImage"
                                class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 focus:border-neonLight focus:ring focus:ring-neonLight/40 outline-none">
                        </div>

                        <div>
                            <label class="block text-gray-300 mb-2">Días hasta vencer</label>
                            <input type="number" name="expires_at" x-model="editExpiresAt"
                                class="w-full p-3 rounded-lg bg-gray-900 border border-gray-700 focus:border-neonLight focus:ring focus:ring-neonLight/40 outline-none">
                        </div>

                        <div class="flex justify-end gap-2 mt-4">
                            <button type="button" @click="openModal=false"
                                class="bg-gray-600 px-4 py-2 rounded-lg font-semibold hover:scale-105 transition duration-300">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="bg-neonLight text-gray-900 px-4 py-2 rounded-lg font-semibold hover:scale-105 transition duration-300">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById("toggleFormBtn").addEventListener("click", () => {
            const form = document.getElementById("formContainer");
            form.classList.toggle("hidden");
        });
    </script>

</body>

</html>
