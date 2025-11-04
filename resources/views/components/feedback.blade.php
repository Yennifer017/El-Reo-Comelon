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
