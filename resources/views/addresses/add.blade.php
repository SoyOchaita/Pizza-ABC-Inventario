<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Añadir Dirección') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <div class="bg-stone-800 p-6 rounded-lg shadow-lg">
            <form action="{{ route('addresses.store') }}" method="POST" id="add-form">
                @csrf

                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nombre de la Dirección')" />
                    <x-text-input id="name" class="block mt-1 w-full bg-stone-700 text-white" type="text" name="name" :value="old('name', isset($address) ? $address->name : '')" required autocomplete="off" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
                <div class="mb-4">
                    <x-input-label for="address" :value="__('Dirección')" />
                    <x-text-input id="address" class="block mt-1 w-full bg-stone-700 text-white" type="text" name="address" :value="old('address')" required autocomplete="off" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Campos ocultos para latitud y longitud -->
                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                <!-- Mapa de Google -->
                <div id="map" class="w-full h-[450px] mb-4 rounded-lg"></div>

                <div class="flex justify-between">
                    <x-primary-button class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded">
                        {{ __('Guardar Dirección') }}
                    </x-primary-button>
                    
                    <!-- Botón de regresar -->
                    <button type="button" id="back-button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        {{ __('Regresar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts de Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places"></script>
    <script>
        let map;
        let marker;
        let geocoder;
        let autocomplete;

        function initMap() {
            const initialPosition = { lat: 14.6349, lng: -90.5069 }; // Coordenadas iniciales (ejemplo)

            map = new google.maps.Map(document.getElementById("map"), {
                center: initialPosition,
                zoom: 14,
            });

            marker = new google.maps.Marker({
                position: initialPosition,
                map: map,
                draggable: true,
            });

            geocoder = new google.maps.Geocoder();

            autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'));
            autocomplete.bindTo('bounds', map);

            // Evento al cambiar el autocomplete
            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();

                if (!place.geometry) {
                    return;
                }

                // Centrar el mapa y mover el marcador
                map.setCenter(place.geometry.location);
                marker.setPosition(place.geometry.location);

                // Actualizar latitud y longitud
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
            });

            // Evento al mover el marcador
            marker.addListener('dragend', function () {
                updatePosition(marker.getPosition());
            });

            // Evento al hacer clic en el mapa
            map.addListener('click', function (e) {
                const clickedPosition = e.latLng;
                marker.setPosition(clickedPosition);
                updatePosition(clickedPosition);
            });
        }

        function updatePosition(position) {
            geocoder.geocode({ 'location': position }, function (results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        map.setCenter(position);
                        document.getElementById('address').value = results[0].formatted_address;
                        document.getElementById('latitude').value = position.lat();
                        document.getElementById('longitude').value = position.lng();
                    }
                }
            });
        }

        // Inicializar el mapa al cargar la página
        window.onload = initMap;

        // Funcionalidad del botón de regresar
        document.getElementById('back-button').addEventListener('click', function () {
            if (confirm('¿Deseas regresar sin guardar los cambios?')) {
                window.location.href = '{{ route('addresses.index') }}';
            }
        });
    </script>
</x-app-layout>
