<!DOCTYPE html>
<html lang="id">

</html>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tracking Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                   
                    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                    <style>
                        #map {
                            height: 500px; /* Tinggi peta */
                            width: 100%; /* Lebar peta */
                        }
                    </style>
                </head>
                <body>
             
                    <div id="map"></div>
                
                    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                    <script>
                        // Koordinat lokasi kendaraan
                        var vehicleLocation = [-7.329496, 108.3628597]; // Ganti dengan koordinat kendaraan
                
                        // Membuat peta
                        var map = L.map('map').setView(vehicleLocation, 12);
                
                        // Menambahkan layer peta
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '© OpenStreetMap'
                        }).addTo(map);
                
                        // Menambahkan marker untuk lokasi kendaraan
                        var marker = L.marker(vehicleLocation).addTo(map)
                            .bindPopup('Lokasi Kendaraan: B 5678 DEF')
                            .openPopup();
                    </script>
                
                </body>
            </div>
        </div>
    </div>

</x-app-layout>