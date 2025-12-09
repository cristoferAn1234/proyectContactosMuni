<x-app-layout>
    <div class="flex" style="height: 100vh; overflow: hidden;">
        <!-- Sidebar -->
        @include('layouts.asideBar')

        <!-- Contenido principal -->
        <main class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-800">
            <!-- Header con búsqueda -->
            <div class="bg-white dark:bg-gray-900 shadow-md p-6 flex-shrink-0">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                        <i class="fas fa-map-marked-alt"></i> Ubicación de Organizaciones
                    </h2>
                    <p style="color: #00ADED;" class="mb-4">
                        Busca y localiza las organizaciones de Costa Rica en el mapa interactivo
                    </p>
                    
                    <!-- Barra de búsqueda -->
                    <div class="flex gap-3 items-center">
                        <div class="flex-1">
                            <div class="relative">
                                <i class="fas fa-search absolute left-1 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    id="searchInput" 
                                    class="w-full px-4 py-3 pl-11 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white" 
                                    placeholder="Buscar: 'muni', 'caja', 'cooperativa', 'ONG', etc."
                                    autocomplete="off">
                            </div>
                        </div>
                        <button 
                            id="searchBtn" 
                            class="px-6 py-3 text-white rounded-lg hover:opacity-90 transition-all" 
                            style="background-color: #00ADED;">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        <button 
                            id="clearBtn" 
                            class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all">
                            <i class="fas fa-redo"></i> Limpiar
                        </button>
                    </div>

                    <!-- Contador de resultados -->
                    <div id="resultsCount" class="mt-3 text-sm text-gray-600 dark:text-gray-400"></div>

                    <!-- Leyenda de colores -->
                    <div class="mt-4 flex flex-wrap gap-4 text-xs">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full" style="background-color: #00ADED;"></div>
                            <span class="text-gray-700 dark:text-gray-300">Municipalidad / Gobierno Local</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full" style="background-color: #f84d4d;"></div>
                            <span class="text-gray-700 dark:text-gray-300">Institución Pública</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full" style="background-color: #4CAF50;"></div>
                            <span class="text-gray-700 dark:text-gray-300">Cooperativa</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full" style="background-color: #FF9800;"></div>
                            <span class="text-gray-700 dark:text-gray-300">Consorcio</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full" style="background-color: #9C27B0;"></div>
                            <span class="text-gray-700 dark:text-gray-300">ONG</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenedor del mapa - FLEX GROW para ocupar espacio restante -->
            <div class="flex-1 relative">
                <div id="map" style="width: 100%; height: 100%;"></div>
                
                <!-- Loading spinner -->
                <div id="loadingSpinner" class="hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20">
                    <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4" style="border-color: #00ADED;"></div>
                </div>
            </div>
        </main>
    </div>

    <!-- Mapbox CSS -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    
    <!-- Mapbox JS -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>

    <script>
        // Token de Mapbox (público - pk.)
        mapboxgl.accessToken = 'pk.eyJ1IjoieWVzY2EiLCJhIjoiY205dWwxNnVoMDNmbTJsb2VjOTB3YnMwciJ9.WBq2Zn2X1JnkJ_39zwlQjQ';

        // Deshabilitar telemetría de Mapbox (evita errores de AdBlock)
        if (typeof mapboxgl !== 'undefined') {
            mapboxgl.setRTLTextPlugin = function() {};
        }

        // Inicializar el mapa centrado en Costa Rica
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [-84.0907, 9.9281], // Centro de Costa Rica
            zoom: 7.5,
            attributionControl: true,
            trackResize: true,
            preserveDrawingBuffer: true
        });

        // Agregar controles de navegación
        map.addControl(new mapboxgl.NavigationControl(), 'top-right');
        map.addControl(new mapboxgl.FullscreenControl(), 'top-right');

        // Array para almacenar los marcadores actuales
        let currentMarkers = [];

        // Función para limpiar marcadores existentes
        function clearMarkers() {
            currentMarkers.forEach(marker => marker.remove());
            currentMarkers = [];
        }

        // Función para agregar marcadores al mapa
        function addMarkers(markers) {
            clearMarkers();

            console.log('Agregando', markers.length, 'marcadores:', markers);

            markers.forEach(markerData => {
                console.log('Marcador:', markerData.label, 'en [lng, lat]:', [markerData.longitude, markerData.latitude]);
                
                // Crear el elemento del marcador
                const el = document.createElement('div');
                el.className = 'custom-marker';
                el.style.backgroundColor = markerData.color || '#00ADED';
                el.style.width = '20px';
                el.style.height = '20px';
                el.style.borderRadius = '50%';
                el.style.border = '3px solid white';
                el.style.boxShadow = '0 2px 4px rgba(0,0,0,0.3)';
                el.style.cursor = 'pointer';

                // Crear popup con tooltip
                const popup = new mapboxgl.Popup({
                    offset: 25,
                    closeButton: true,
                    closeOnClick: false,
                    maxWidth: '300px'
                }).setHTML(markerData.tooltip);

                // Crear y agregar el marcador
                const marker = new mapboxgl.Marker(el)
                    .setLngLat([markerData.longitude, markerData.latitude])
                    .setPopup(popup)
                    .addTo(map);

                currentMarkers.push(marker);

                // Mostrar popup al hacer hover
                el.addEventListener('mouseenter', () => {
                    popup.addTo(map);
                });
            });

            // Ajustar el mapa para mostrar todos los marcadores
            if (markers.length > 0) {
                const bounds = new mapboxgl.LngLatBounds();
                markers.forEach(marker => {
                    bounds.extend([marker.longitude, marker.latitude]);
                });
                map.fitBounds(bounds, { padding: 50, maxZoom: 12 });
            }
        }

        // Función para realizar búsqueda
        function searchOrganizations(query = '') {
            const spinner = document.getElementById('loadingSpinner');
            const resultsCount = document.getElementById('resultsCount');
            
            spinner.classList.remove('hidden');
            resultsCount.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Buscando organizaciones...';
            
            fetch(`/ubicacion/search?q=${encodeURIComponent(query)}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                spinner.classList.add('hidden');
                
                if (data.success) {
                    addMarkers(data.markers);
                    
                    if (data.count === 0) {
                        resultsCount.innerHTML = '<i class="fas fa-info-circle text-yellow-600"></i> No se encontraron organizaciones' + 
                            (query ? ` que coincidan con "${query}"` : ' con coordenadas registradas');
                    } else if (query) {
                        resultsCount.innerHTML = `<i class="fas fa-check-circle text-green-600"></i> Se encontraron <strong>${data.count}</strong> organizaciones que coinciden con "<strong>${query}</strong>"`;
                    } else {
                        resultsCount.innerHTML = `<i class="fas fa-check-circle text-green-600"></i> Mostrando <strong>${data.count}</strong> organizaciones en total`;
                    }
                } else {
                    resultsCount.innerHTML = '<i class="fas fa-exclamation-triangle text-red-500"></i> Error al cargar las ubicaciones';
                }
            })
            .catch(error => {
                spinner.classList.add('hidden');
                console.error('Error:', error);
                resultsCount.innerHTML = '<i class="fas fa-exclamation-triangle text-red-500"></i> Error al realizar la búsqueda. Verifica la conexión.';
            });
        }

        // Event listeners
        document.getElementById('searchBtn').addEventListener('click', () => {
            const query = document.getElementById('searchInput').value;
            searchOrganizations(query);
        });

        document.getElementById('searchInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const query = document.getElementById('searchInput').value;
                searchOrganizations(query);
            }
        });

        document.getElementById('clearBtn').addEventListener('click', () => {
            document.getElementById('searchInput').value = '';
            searchOrganizations();
        });

        // Cargar todas las organizaciones al iniciar
        map.on('load', () => {
            // Forzar resize del mapa después de cargar
            setTimeout(() => {
                map.resize();
            }, 100);
            
            searchOrganizations();
        });

        // Manejar errores del mapa
        map.on('error', (e) => {
            console.error('Error en el mapa:', e);
            document.getElementById('resultsCount').innerHTML = 
                '<i class="fas fa-exclamation-triangle text-red-500"></i> Error al cargar el mapa. Verifica tu conexión a internet.';
        });

        // Verificar que Mapbox GL esté disponible
        if (typeof mapboxgl === 'undefined') {
            console.error('Mapbox GL JS no está cargado');
            document.getElementById('resultsCount').innerHTML = 
                '<i class="fas fa-exclamation-triangle text-red-500"></i> Error: Mapbox GL JS no se pudo cargar.';
        }

        // Resize al cambiar tamaño de ventana
        window.addEventListener('resize', () => {
            map.resize();
        });
    </script>

    <style>
        /* Asegurar que el mapa sea visible */
        #map {
            position: relative;
            width: 100%;
            height: 100%;
            min-height: 500px;
            background-color: #e0e0e0;
        }

        /* Canvas del mapa */
        .mapboxgl-canvas {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }

        .mapboxgl-popup-content {
            padding: 12px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .mapboxgl-popup-close-button {
            font-size: 20px;
            padding: 4px 8px;
            color: #666;
        }

        .mapboxgl-popup-close-button:hover {
            background-color: #f0f0f0;
            color: #000;
        }

        .custom-marker:hover {
            transform: scale(1.2);
            transition: transform 0.2s;
        }

        #searchInput:focus {
            outline: none;
        }

        /* Forzar visibilidad del canvas */
        .mapboxgl-map {
            position: relative !important;
            width: 100% !important;
            height: 100% !important;
        }
    </style>
</x-app-layout>
