<x-app-layout>
    <div class="flex" style="height: 100vh; overflow: hidden;">
        <!-- Sidebar -->
        @include('layouts.asideBar')

        <!-- Contenido principal -->
        <main class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-800">
            <!-- Header -->
            <div class="bg-white dark:bg-gray-900 shadow-md p-6 flex-shrink-0">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-2xl font-semibold mb-2" style="color: #1f2937 !important;">
                        <i class="fas fa-map-marked-alt"></i> Mapa de Ubicación
                    </h2>
                    <p style="color: #00ADED;">
                        Busca cualquier lugar en Costa Rica: municipalidades, instituciones, comercios, direcciones y más
                    </p>
                </div>
            </div>

            <!-- Contenedor del mapa -->
            <div class="flex-1 relative">
                <div id="map" style="width: 100%; height: 100%;"></div>
                
                <!-- Contenedor de notificaciones toast -->
                <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 10000;"></div>
            </div>
        </main>
    </div>

    <!-- Mapbox CSS -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    
    <!-- Mapbox JS -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>

    <script>
        // Token de Mapbox (público - pk.)
        const ACCESS_TOKEN = 'pk.eyJ1IjoieWVzY2EiLCJhIjoiY205dWwxNnVoMDNmbTJsb2VjOTB3YnMwciJ9.WBq2Zn2X1JnkJ_39zwlQjQ';
        mapboxgl.accessToken = ACCESS_TOKEN;

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

        // Array para almacenar los marcadores de búsqueda
        let searchMarkers = [];

        // Función para limpiar marcadores anteriores
        function clearMarkers() {
            searchMarkers.forEach(marker => marker.remove());
            searchMarkers = [];
        }

        // Función para mostrar notificaciones toast
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.style.cssText = `
                background-color: ${type === 'error' ? '#ef4444' : type === 'success' ? '#10b981' : '#3b82f6'};
                color: white;
                padding: 16px 24px;
                border-radius: 8px;
                margin-bottom: 10px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                display: flex;
                align-items: center;
                gap: 12px;
                min-width: 300px;
                animation: slideIn 0.3s ease-out;
            `;
            
            const icon = type === 'error' ? '❌' : type === 'success' ? '✅' : 'ℹ️';
            toast.innerHTML = `
                <span style="font-size: 20px;">${icon}</span>
                <span style="flex: 1; font-size: 14px;">${message}</span>
                <button onclick="this.parentElement.remove()" style="background: none; border: none; color: white; cursor: pointer; font-size: 20px; padding: 0; margin: 0; line-height: 1;">×</button>
            `;
            
            document.getElementById('toast-container').appendChild(toast);
            
            // Auto-remover después de 5 segundos
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.style.animation = 'slideOut 0.3s ease-in';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 5000);
        }

        // Función para buscar lugares usando Mapbox Geocoding API
        async function searchPlaces(query) {
            if (!query || query.trim() === '') return;

            // Limpiar marcadores anteriores
            clearMarkers();

            try {
                // Búsqueda con fuzzyMatch para mejores resultados
                const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(query)}.json?` +
                    `access_token=${ACCESS_TOKEN}&` +
                    `country=CR&` +
                    `language=es&` +
                    `limit=10&` +
                    `types=poi,address,place,locality,neighborhood,district,region&` +
                    `fuzzyMatch=true&` +
                    `proximity=-84.0907,9.9281`;

                const response = await fetch(url);
                const data = await response.json();

                if (data.features && data.features.length > 0) {
                    showToast(`Se encontraron ${data.features.length} resultados para "${query}"`, 'success');

                    // Crear un bounds para ajustar la vista del mapa
                    const bounds = new mapboxgl.LngLatBounds();

                    // Agregar marcador para cada resultado
                    data.features.forEach((feature, index) => {
                        const [lng, lat] = feature.center;
                        
                        // Extender bounds
                        bounds.extend([lng, lat]);

                        // Crear elemento del marcador
                        const el = document.createElement('div');
                        el.className = 'search-marker';
                        
                        // Crear el contenedor interno para el marcador
                        const markerInner = document.createElement('div');
                        markerInner.style.backgroundColor = '#EA4335';
                        markerInner.style.width = '25px';
                        markerInner.style.height = '25px';
                        markerInner.style.borderRadius = '50% 50% 50% 0';
                        markerInner.style.border = '3px solid white';
                        markerInner.style.boxShadow = '0 3px 6px rgba(0,0,0,0.4)';
                        markerInner.style.transform = 'rotate(-45deg)';
                        markerInner.style.position = 'relative';
                        markerInner.style.cursor = 'pointer';

                        // Número dentro del marcador
                        const numberLabel = document.createElement('div');
                        numberLabel.style.position = 'absolute';
                        numberLabel.style.top = '50%';
                        numberLabel.style.left = '50%';
                        numberLabel.style.transform = 'translate(-50%, -50%) rotate(45deg)';
                        numberLabel.style.color = 'white';
                        numberLabel.style.fontSize = '11px';
                        numberLabel.style.fontWeight = 'bold';
                        numberLabel.textContent = index + 1;
                        
                        markerInner.appendChild(numberLabel);
                        el.appendChild(markerInner);

                        // Crear popup con información
                        const popup = new mapboxgl.Popup({
                            offset: 25,
                            closeButton: true,
                            maxWidth: '300px'
                        }).setHTML(`
                            <div style="padding: 8px;">
                                <h3 style="font-weight: bold; font-size: 14px; margin-bottom: 6px; color: #1a73e8;">
                                    ${feature.text || feature.place_name}
                                </h3>
                                <p style="font-size: 12px; color: #666; margin-bottom: 4px;">
                                    ${feature.place_name}
                                </p>
                                ${feature.properties.category ? `
                                    <p style="font-size: 11px; color: #888;">
                                        <i class="fas fa-tag"></i> ${feature.properties.category}
                                    </p>
                                ` : ''}
                                <p style="font-size: 11px; color: #888; margin-top: 4px;">
                                    <i class="fas fa-map-marker-alt"></i> ${lat.toFixed(6)}, ${lng.toFixed(6)}
                                </p>
                            </div>
                        `);

                        // Crear y agregar el marcador
                        const marker = new mapboxgl.Marker(el)
                            .setLngLat([lng, lat])
                            .setPopup(popup)
                            .addTo(map);

                        searchMarkers.push(marker);

                        // Abrir popup del primer resultado
                        if (index === 0) {
                            marker.togglePopup();
                        }
                    });

                    // Ajustar la vista del mapa para mostrar todos los resultados
                    map.fitBounds(bounds, {
                        padding: { top: 100, bottom: 100, left: 100, right: 100 },
                        maxZoom: 15
                    });

                } else {
                    showToast(`No se encontraron resultados para "${query}".`, 'error');
                }

            } catch (error) {
                showToast('Error al realizar la búsqueda. Por favor, intenta de nuevo.', 'error');
            }
        }

        // Crear el control de búsqueda personalizado
        class SearchControl {
            onAdd(map) {
                this._map = map;
                this._container = document.createElement('div');
                this._container.className = 'mapboxgl-ctrl mapboxgl-ctrl-group';
                this._container.style.width = '350px';
                this._container.style.maxWidth = '90vw';

                // Crear el formulario de búsqueda
                const searchForm = document.createElement('form');
                searchForm.style.display = 'flex';
                searchForm.style.backgroundColor = 'white';
                searchForm.style.borderRadius = '4px';
                searchForm.style.overflow = 'hidden';
                searchForm.style.boxShadow = '0 2px 4px rgba(0,0,0,0.2)';

                // Input de búsqueda
                const searchInput = document.createElement('input');
                searchInput.type = 'text';
                searchInput.placeholder = 'Buscar en Costa Rica...';
                searchInput.style.flex = '1';
                searchInput.style.border = 'none';
                searchInput.style.padding = '10px 15px';
                searchInput.style.fontSize = '14px';
                searchInput.style.outline = 'none';
                searchInput.style.height = '44px';

                // Botón de búsqueda
                const searchButton = document.createElement('button');
                searchButton.type = 'submit';
                searchButton.innerHTML = '<i class="fas fa-search"></i>';
                searchButton.style.border = 'none';
                searchButton.style.backgroundColor = '#1a73e8';
                searchButton.style.color = 'white';
                searchButton.style.padding = '0';
                searchButton.style.width = '44px';
                searchButton.style.height = '44px';
                searchButton.style.display = 'flex';
                searchButton.style.alignItems = 'center';
                searchButton.style.justifyContent = 'center';
                searchButton.style.cursor = 'pointer';
                searchButton.style.fontSize = '14px';
                searchButton.style.transition = 'background-color 0.2s';

                searchButton.addEventListener('mouseenter', () => {
                    searchButton.style.backgroundColor = '#1557b0';
                });

                searchButton.addEventListener('mouseleave', () => {
                    searchButton.style.backgroundColor = '#1a73e8';
                });

                // Botón de limpiar
                const clearButton = document.createElement('button');
                clearButton.type = 'button';
                clearButton.innerHTML = '<i class="fas fa-times"></i>';
                clearButton.style.border = 'none';
                clearButton.style.backgroundColor = '#f1f3f4';
                clearButton.style.color = '#666';
                clearButton.style.padding = '0';
                clearButton.style.width = '44px';
                clearButton.style.height = '44px';
                clearButton.style.display = 'none';
                clearButton.style.alignItems = 'center';
                clearButton.style.justifyContent = 'center';
                clearButton.style.cursor = 'pointer';
                clearButton.style.fontSize = '14px';
                clearButton.style.transition = 'background-color 0.2s';

                clearButton.addEventListener('mouseenter', () => {
                    clearButton.style.backgroundColor = '#e8eaed';
                });

                clearButton.addEventListener('mouseleave', () => {
                    clearButton.style.backgroundColor = '#f1f3f4';
                });

                // Event listeners
                searchForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const query = searchInput.value.trim();
                    if (query) {
                        searchPlaces(query);
                        clearButton.style.display = 'flex';
                    }
                });

                searchInput.addEventListener('input', () => {
                    if (searchInput.value.trim() === '') {
                        clearButton.style.display = 'none';
                    }
                });

                clearButton.addEventListener('click', () => {
                    searchInput.value = '';
                    clearButton.style.display = 'none';
                    clearMarkers();
                    map.flyTo({
                        center: [-84.0907, 9.9281],
                        zoom: 7.5
                    });
                });

                searchForm.appendChild(searchInput);
                searchForm.appendChild(clearButton);
                searchForm.appendChild(searchButton);
                this._container.appendChild(searchForm);

                return this._container;
            }

            onRemove() {
                this._container.parentNode.removeChild(this._container);
                this._map = undefined;
            }
        }

        // Cuando el mapa termine de cargar
        map.on('load', () => {
            // Agregar el control de búsqueda personalizado
            map.addControl(new SearchControl(), 'top-left');

            // Forzar resize del mapa
            setTimeout(() => {
                map.resize();
            }, 100);
        });

        // Manejar errores del mapa
        map.on('error', (e) => {
            console.error('Error en el mapa:', e);
        });

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

        /* Estilos para los marcadores de búsqueda */
        .search-marker {
            width: 25px;
            height: 25px;
            cursor: pointer;
        }

        .search-marker:hover > div {
            transform: rotate(-45deg) scale(1.15);
            transition: transform 0.2s ease;
        }

        /* Estilos para los popups */
        .mapboxgl-popup-content {
            padding: 0;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .mapboxgl-popup-close-button {
            font-size: 18px;
            padding: 8px 10px;
            color: #666;
            right: 5px;
            top: 5px;
        }

        .mapboxgl-popup-close-button:hover {
            background-color: #f0f0f0;
            color: #000;
            border-radius: 50%;
        }

        /* Punta del popup más estilizada */
        .mapboxgl-popup-tip {
            border-top-color: white !important;
        }

        /* Contenedor de controles del mapa */
        .mapboxgl-ctrl-top-left {
            margin-top: 10px;
            margin-left: 10px;
        }

        .mapboxgl-ctrl-top-right {
            margin-top: 10px;
            margin-right: 10px;
        }

        /* Forzar visibilidad del canvas */
        .mapboxgl-map {
            position: relative !important;
            width: 100% !important;
            height: 100% !important;
        }

        /* Animaciones para las notificaciones toast */
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    </style>
</x-app-layout>
