<div class="bg-gray-800 rounded-lg p-5 shadow-md">
    {{-- Encabezado del platillo --}}
    <div class="flex justify-between items-center mb-3">
        <h2 class="text-xl font-semibold text-white">{{ $dish->name }}</h2>
        @if ($dish->journey === 'BREAKFAST')
            <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-xs font-semibold">Desayuno</span>
        @elseif ($dish->journey === 'LUNCH')
            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs font-semibold">Almuerzo</span>
        @else
            <span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-xs font-semibold">Cena</span>
        @endif
    </div>

    {{-- Tabla de ingredientes / alimentos --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700 text-sm">
            <thead class="bg-gray-900 text-neonLight uppercase">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Alimento</th>
                    <th class="px-6 py-3 text-left">Cantidad</th>
                    <th class="px-6 py-3 text-left">Precio (Q)</th>
                    <th class="px-6 py-3 text-left">Subtotal (Q)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700 text-gray-300">
                @php
                    $total = 0;
                @endphp

                @foreach ($dish->requiredFood as $index => $req)
                    @php
                        $food = $req->food;
                    @endphp

                    @if ($food)
                        @php
                            $subtotal = $req->quantity * $food->price;
                            $total += $subtotal;
                        @endphp

                        <tr class="hover:bg-gray-700/40 transition duration-200">
                            <td class="px-6 py-3">{{ $index + 1 }}</td>
                            <td class="px-6 py-3 font-medium text-white">{{ $food->name }}
                            </td>
                            <td class="px-6 py-3">{{ $req->quantity }}</td>
                            <td class="px-6 py-3">Q{{ number_format($food->price, 2) }}</td>
                            <td class="px-6 py-3 text-neonLight font-semibold">
                                Q{{ number_format($subtotal, 2) }}</td>
                        </tr>
                    @endif
                @endforeach

                <!-- Fila de total -->
                <tr class="bg-gray-900 font-bold text-white">
                    <td colspan="4" class="px-6 py-3 text-right">TOTAL</td>
                    <td class="px-6 py-3 text-neonLight">Q{{ number_format($total, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
