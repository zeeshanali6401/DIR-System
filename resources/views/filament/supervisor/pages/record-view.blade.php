<x-filament-panels::page>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
        @foreach ($record->images as $item)
            @php
                $extension = pathinfo($item, PATHINFO_EXTENSION);
                $videoExtensions = ['mp4', 'avi', 'mov']; // add other video extensions as needed
            @endphp
            <div class="relative overflow-hidden rounded-lg shadow-lg bg-white">
                @if (in_array($extension, $videoExtensions))
                    <video controls class="w-full h-64 object-cover">
                        <source src="{{ asset('storage/' . $item) }}">
                    </video>
                @else
                    <img src="{{ asset('storage/' . $item) }}" alt="" class="w-full h-64 object-cover">
                @endif
                <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black to-transparent">
                    <p class="text-white text-sm">File: {{ $item }}</p>
                </div>
            </div>
        @endforeach
    </div>

</x-filament-panels::page>
