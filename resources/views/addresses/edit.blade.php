<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Dirección') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <div class="bg-stone-800 p-6 rounded-lg shadow-lg">
            <form action="{{ route('addresses.update', $address->id) }}" method="POST" id="update-form">
                @csrf
                @method('PUT')


                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nombre de la Dirección')" />
                    <x-text-input id="name" class="block mt-1 w-full bg-stone-700 text-white" type="text" name="name" :value="old('name', isset($address) ? $address->name : '')" required autocomplete="off" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div> 
                
                <div class="mb-4">
                    <x-input-label for="address" :value="__('Dirección')" />
                    <x-text-input id="address" class="block mt-1 w-full bg-stone-700 text-white" type="text" name="address" :value="$address->address" required autocomplete="off" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Campos ocultos para latitud y longitud -->
                <input type="hidden" name="latitude" id="latitude" value="{{ $address->latitude }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ $address->longitude }}">

                <!-- Mapa de Google -->
                <div id="map" class="w-full h-96 mb-4 rounded-lg"></div>

                <div class="flex justify-between">
                    <x-primary-button class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded">
                        {{ __('Actualizar Dirección') }}
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
            const initialPosition = { lat: {{ $address->latitude }}, lng: {{ $address->longitude }} };

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
                geocoder.geocode({ 'location': marker.getPosition() }, function (results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            map.setCenter(marker.getPosition());
                            document.getElementById('address').value = results[0].formatted_address;
                            document.getElementById('latitude').value = marker.getPosition().lat();
                            document.getElementById('longitude').value = marker.getPosition().lng();
                        }
                    }
                });
            });

            // Evento al hacer click en el mapa
            map.addListener('click', function (event) {
                marker.setPosition(event.latLng);
                map.setCenter(event.latLng);

                // Actualizar latitud y longitud
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();

                geocoder.geocode({ 'location': event.latLng }, function (results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            document.getElementById('address').value = results[0].formatted_address;
                        }
                    }
                });
            });
        }

        // Inicializar el mapa al cargar la página
        window.onload = initMap;

        // Funcionalidad del botón de regresar
        document.getElementById('back-button').addEventListener('click', function () {
            if (confirm('¿Deseas guardar los cambios antes de regresar?')) {
                document.getElementById('update-form').submit();
            } else {
                window.location.href = '{{ route('addresses.index') }}';
            }
        });
    </script>
</x-app-layout>
