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
        <div class="bg-gradient-to-r from-neonBlue to-blue-600 text-center rounded-2xl mx-4 md:mx-auto max-w-5xl p-12 shadow-2xl border border-neonLight">
            <h2 class="text-5xl md:text-6xl font-bold mb-4 tracking-wide drop-shadow-lg">El Reo Comelón</h2>
            <p class="text-gray-300 mb-8 text-lg md:text-xl drop-shadow-sm">
                Simulación de gestión de procesos de comestibles en prisión
            </p>
            <a href="#simulaciones" class="inline-block bg-neonLight text-gray-900 px-8 py-4 rounded-full font-semibold text-lg shadow-lg hover:scale-105 transform transition duration-300">
                Empezar simulación
            </a>
        </div>
    </section>

    <x-footer />

</body>
</html>
