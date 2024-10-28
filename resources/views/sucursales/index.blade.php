<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 leading-tight">
            {{ __('Sucursales') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <!-- Mapa de Google -->
        <div id="map" class="w-full h-[600px] rounded-lg shadow-lg mb-6"></div>

        <!-- Lista de Sucursales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($sucursales as $sucursal)
                <div class="bg-yellow-500 p-4 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold text-black">{{ $sucursal->name }}</h3>
                    <p class="text-gray-800">{{ $sucursal->address }}</p>
                    <p class="text-gray-800">Latitud: {{ $sucursal->latitude }}</p>
                    <p class="text-gray-800">Longitud: {{ $sucursal->longitude }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Scripts de Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}"></script>
    <script>
        let map;

        function initMap() {
            const mapCenter = { lat: 14.6349, lng: -90.5069 }; // Centro del mapa

            map = new google.maps.Map(document.getElementById("map"), {
                center: mapCenter,
                zoom: 12,
            });

            const sucursales = @json($sucursales);

            sucursales.forEach(sucursal => {
                const marker = new google.maps.Marker({
                    position: { lat: parseFloat(sucursal.latitude), lng: parseFloat(sucursal.longitude) },
                    map: map,
                    title: sucursal.name,
                    icon: {
                        url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
                    }
                });

                const infoWindow = new google.maps.InfoWindow({
                    content: `<h3 style="color: #d32f2f;">${sucursal.name}</h3><p style="color: #333;">${sucursal.address}</p>`
                });

                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });
            });
        }

        // Inicializar el mapa al cargar la página
        window.onload = initMap;
    </script>
</x-app-layout>
