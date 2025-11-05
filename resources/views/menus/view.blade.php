<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/configuration/tailwindConf.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-900 font-techno text-white min-h-screen flex flex-col">

    <x-navbar />

    <section class="relative mt-12">
        <div
            class="bg-gradient-to-r from-neonBlue to-blue-600 text-center rounded-2xl mx-4 md:mx-auto max-w-5xl p-12 shadow-2xl border border-neonLight">
            <h2 class="text-5xl md:text-6xl font-bold mb-4 tracking-wide drop-shadow-lg">Detalle de menu</h2>
        </div>
    </section>

    <section class="p-6">
        <div class="bg-gray-900 text-gray-300 rounded-xl shadow-lg p-6 border border-gray-800">

            {{-- Encabezado del menú --}}
            <div class="mb-6 border-b border-gray-700 pb-4">
                <h1 class="text-3xl font-bold text-neonLight">{{ $menu->name }}</h1>
                <p class="mt-2 text-gray-400">
                    Tipo:
                    @if ($menu->is_premium)
                        <span class="text-yellow-400 font-semibold">Premium</span>
                    @else
                        <span class="text-green-400 font-semibold">Normal</span>
                    @endif
                </p>
            </div>

            {{-- Lista de platillos --}}
            <div class="space-y-8">
                @foreach ($menu->dishMenus as $dishMenu)
                    @php
                        $dish = $dishMenu->dish;
                    @endphp

                    @if ($dish)
                        @include('partials.recipe', ['dish' => $dish])
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <x-footer />

</body>

</html>
