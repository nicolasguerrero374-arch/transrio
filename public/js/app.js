let map;
let markers = [];
let rutasLayers = [];
let paradasDataGlobal = [];
let rutasDataGlobal = [];
let vehiculosMarkers = {};

let userMarker = null;
let userCircle = null;
let userLatLng = null;
let primeraVezUbicacion = true;
let watchId = null;

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btnMenu')?.addEventListener('click', toggleMenu);
    initMap();
});

function toggleMenu() {
    document.getElementById('sideMenu').classList.toggle('active');
}

function initMap() {
    map = L.map('map').setView([5.422, -75.702], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    setTimeout(() => { map.invalidateSize(); }, 300);
    crearBotonFlotante();

    // puntos de las paradas

    fetch('/api/paradas').then(r => r.json()).then(paradas => {
        paradasDataGlobal = paradas;
        paradas.forEach(p => {
            let color = p.tipo === 'bus' ? 'green' : p.tipo === 'mototaxi' ? 'red' : p.tipo === 'taxi' ? 'gold' : p.tipo === 'jeep' ? 'orange' : p.tipo === 'pirata' ? 'black' : p.tipo === 'chiva' ? 'purple' : 'blue';
            let icon = L.divIcon({ className: 'custom-pin', html: `<div style="background:${color};width:18px;height:18px;border-radius:50%;border:2px solid white;box-shadow:0 0 3px black"></div>` });
            let m = L.marker([p.lat, p.lng], { icon }).addTo(map);
            m.paradaData = p;
            m.on('click', () => mostrarParada(p));
            markers.push(m);
        });
    });

    // LEE el ID DE LA RUTA DESDE LA URL
    let rutaId = null;
    const params = new URLSearchParams(window.location.search);
    if (params.get('ruta')) {
        rutaId = params.get('ruta');
    }
    const esModoVivo = params.get('vivo') === '1';

    if (rutaId) {
        fetch(`api/rutas/${rutaId}`).then(r => r.json()).then(data => {
            let ruta = Array.isArray(data) ? data[0] : data;
            if (data.data) ruta = data.data;
            if (data.ruta) ruta = data.ruta;

            if (ruta && ruta.coordenadas && ruta.coordenadas.length > 2) {
                let line = L.polyline(ruta.coordenadas, { color: 'blue', weight: 4 }).addTo(map);
                line.bindTooltip(`${ruta.nombre}`, { permanent: false });
                line.rutaData = ruta;
                rutasLayers.push(line);
                map.fitBounds(line.getBounds(), { padding: [30, 30] });
            }
        });

        // SOLO SI ES MODO VIVO - VEHICULOS
        if (esModoVivo) {
            function getIcono(t) {
                if (!t) return '🚌'; t = t.toLowerCase();
                if (t.includes('jeep')) return '🚙';
                if (t.includes('moto')) return '🛺';
                if (t.includes('taxi')) return '🚕';
                return '🚌';
            }
            function getColor(t) {
                if (!t) return '#00B050'; t = t.toLowerCase();
                if (t.includes('jeep')) return '#FF8C00';
                if (t.includes('taxi')) return '#FFD700';
                if (t.includes('moto')) return '#FF0000';
                return '#00B050';
            }
            function cargarVehiculos() {
                fetch('/api/vehiculos').then(r => r.json()).then(vs => {
                    vs.filter(v => String(v.ruta_id) == String(rutaId)).forEach(v => {
                        if (!v.lat) return;
                        const ll = [v.lat, v.lng];
                        if (vehiculosMarkers[v.id]) vehiculosMarkers[v.id].setLatLng(ll);
                        else {
                            const ico = L.divIcon({ html: `<div style="background:${getColor(v.tipo)};width:38px;height:38px;border-radius:50%;border:3px solid white;display:flex;align-items:center;justify-content:center;font-size:20px;box-shadow:0 3px 8px rgba(0,0,0,0.5);">${getIcono(v.tipo)}</div>`, className: '', iconSize: [38, 38], iconAnchor: [19, 19] });
                            vehiculosMarkers[v.id] = L.marker(ll, { icon: ico }).addTo(map).bindPopup(`${getIcono(v.tipo)} ${v.placa} - En Vivo`);
                        }
                    });
                    // Si el conductor deja de transmitir, borrarlo del mapa
                    const idsActivos = vs.filter(v => String(v.ruta_id) === String(rutaId)).map(v => v.id);
                    Object.keys(vehiculosMarkers).forEach(id => {
                        if (!idsActivos.includes(parseInt(id))) {
                            if (map.hasLayer(vehiculosMarkers[id])) {
                                map.removeLayer(vehiculosMarkers[id]);
                            }
                            delete vehiculosMarkers[id];
                        }
                    });
                });
            }
            cargarVehiculos();
            setInterval(cargarVehiculos, 4000);
        }
    }
    // Si no hay rutaId, no se pinta ninguna linea. Solo quedan los puntos.
}
function a12Horas(hora) {
    if (!hora || hora === 'N/A') return 'N/A';
    let [h, m] = hora.split(':');
    h = parseInt(h);
    let ampm = h >= 12 ? 'PM' : 'AM';
    h = h % 12 || 12;
    return `${h}:${m} ${ampm}`;
}

function mostrarParada(p) {
    document.getElementById('modalNombre').innerText = p.nombre;
    document.getElementById('modalFoto').src = p.foto ? '/storage/' + p.foto : 'https://via.placeholder.com/400x300?text=' + p.nombre;
    document.getElementById('modalRutas').innerText = p.rutas ? p.rutas.map(r => r.nombre).join(', ') : 'Sin asignar';
    document.getElementById('modalPrimera').innerText = a12Horas(p.hora_primera);
    document.getElementById('modalUltima').innerText = a12Horas(p.hora_ultima);
    document.getElementById('modalTotal').innerText = p.rutas ? p.rutas.length : 0;
    document.getElementById('modalParada').classList.remove('hidden');
}
function cerrarModal() { document.getElementById('modalParada').classList.add('hidden'); }

// ---  BUSCADOR DE DESTINO ---
function buscarDestino() {
    let q = document.getElementById('buscadorDestino').value.toLowerCase().trim();
    if (!q) return;

    // 1. Buscar en RUTAS primero (ej: Supia)
    let rutaEncontrada = rutasDataGlobal.find(r => r.nombre.toLowerCase().includes(q) || (r.destino && r.destino.toLowerCase().includes(q)));
    if (rutaEncontrada && rutaEncontrada.coordenadas && rutaEncontrada.coordenadas.length) {
        map.fitBounds(rutaEncontrada.coordenadas);
        document.getElementById('sugerencia').innerHTML = `Ruta encontrada: <b>${rutaEncontrada.nombre}</b>. Te sirve para ir a <b>${q}</b>`;
        document.getElementById('sugerencia').classList.remove('hidden');
        return;
    }

    // 2. Buscar en PARADAS
    let encontrado = markers.find(m => m.paradaData.nombre.toLowerCase().includes(q) || (m.paradaData.descripcion && m.paradaData.descripcion.toLowerCase().includes(q)));
    if (encontrado) {
        map.setView([encontrado.paradaData.lat, encontrado.paradaData.lng], 17);
        document.getElementById('sugerencia').innerHTML = `Dirígete a <b>${encontrado.paradaData.nombre}</b>. Allí salen hacia <b>${q}</b>`;
        document.getElementById('sugerencia').classList.remove('hidden');
        mostrarParada(encontrado.paradaData);
    } else {
        document.getElementById('sugerencia').innerHTML = `No encontramos directo a <b>${q}</b>, pero ve al <b>terminal</b>, andén 3. Salen buses cada 30 min.`;
        document.getElementById('sugerencia').classList.remove('hidden');
    }
}

// ---  FILTRO DE TRANSPORTE ---
function filtrarTransporte() {
    let q = document.getElementById('buscadorTransporte').value.toLowerCase().trim();

    // Filtra paradas
    markers.forEach(m => {
        if (q === '' || m.paradaData.tipo.toLowerCase().includes(q) || q.includes(m.paradaData.tipo.toLowerCase())) {
            m.addTo(map);
        } else {
            map.removeLayer(m);
        }
    });

    // Filtra rutas
    rutasLayers.forEach(line => {
        let tipoRuta = (line.rutaData.tipo || line.rutaData.nombre || '').toLowerCase();
        if (q === '' || tipoRuta.includes(q) || q.includes(tipoRuta)) {
            line.addTo(map);
        } else {
            map.removeLayer(line);
        }
    });

    if (q !== '') {
        document.getElementById('sugerencia').innerHTML = `Mostrando solo transporte tipo: <b>${q}</b>`;
        document.getElementById('sugerencia').classList.remove('hidden');
    }
}
//boton de ubicacion

function crearBotonFlotante() {
    // Crea el estilo
    const style = document.createElement('style');
    style.innerHTML = `
        .btn-ubicacion-flotante {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background: white;
            border: 2px solid #0d6efd;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        .btn-ubicacion-flotante:active { transform: scale(0.95); }
    `;
    document.head.appendChild(style);

    const btn = document.createElement('button');
    btn.className = 'btn-ubicacion-flotante';
    btn.innerHTML = '📍';
    btn.title = 'Mi ubicación';
    btn.onclick = () => {
        if (userMarker) { // Si está prendido, apágalo
            map.removeLayer(userMarker);
            map.removeLayer(userCircle);
            userMarker = null;
            userCircle = null;
            primeraVezUbicacion = true;
            if (watchId) navigator.geolocation.clearWatch(watchId);
            watchId = null;
            userLatLng = null;
            btn.innerHTML = '📍';
            if (sugerenciaDiv) sugerenciaDiv.innerHTML = 'Ubicación apagada mi vida';
        } else { // Si está apagado, préndelo
            iniciarUbicacionUsuario();
            btn.innerHTML = '✖️';
        }
    }



    document.getElementById('map').appendChild(btn);
}

function iniciarUbicacionUsuario() {
    const sugerenciaDiv = document.getElementById('sugerencia');

    if (!navigator.geolocation) {
        if (sugerenciaDiv) sugerenciaDiv.innerHTML = "Tu cel no soporta geolocalización mi vida";
        return;
    }

    if (sugerenciaDiv) sugerenciaDiv.innerHTML = "Buscándote en Riosucio... 📡";

    watchId = navigator.geolocation.watchPosition(
        onUbicacionEncontrada,
        onErrorUbicacion,
        {
            enableHighAccuracy: true, // Para que sea preciso en Riosucio
            maximumAge: 0,
            timeout: 10000
        }
    );
}

function onUbicacionEncontrada(pos) {
    const lat = pos.coords.latitude;
    const lng = pos.coords.longitude;
    const accuracy = pos.coords.accuracy;
    userLatLng = [lat, lng];

    const sugerenciaDiv = document.getElementById('sugerencia');
    if (sugerenciaDiv) sugerenciaDiv.innerHTML = `Estás aquí cerca en Riosucio 📍`;

    if (!userMarker) {
        // Icono puntito azul como Google Maps
        const blueIcon = L.divIcon({
            className: 'user-location-icon',
            html: `<div style="background:#0d6efd;width:16px;height:16px;border-radius:50%;border:3px solid white;box-shadow:0 0 8px rgba(13,110,253,0.8)"></div>`,
            iconSize: [16, 16],
            iconAnchor: [8, 8]
        });
        userMarker = L.marker(userLatLng, { icon: blueIcon, zIndexOffset: 1000 }).addTo(map).bindPopup("¡Tú estás aquí mi vida! en Riosucio");
        userCircle = L.circle(userLatLng, { radius: accuracy, color: '#0d6efd', fillColor: '#0d6efd', fillOpacity: 0.15, weight: 1 }).addTo(map);
    } else {
        // SE MUEVE SI EL USUARIO SE MUEVE
        userMarker.setLatLng(userLatLng);
        userCircle.setLatLng(userLatLng);
        userCircle.setRadius(accuracy);
    }

    // Solo la primera vez centra el mapa en ti
    if (primeraVezUbicacion) {
        map.flyTo(userLatLng, 16, { duration: 1.5 });
        primeraVezUbicacion = false;
    }
}

function onErrorUbicacion(err) {
    const sugerenciaDiv = document.getElementById('sugerencia');
    console.log(err);
    if (sugerenciaDiv) {
        if (err.code === 1) {
            sugerenciaDiv.innerHTML = "Activa el permiso de ubicación para ver qué buses te sirven cerca";
        } else {
            sugerenciaDiv.innerHTML = "No te pude encontrar verifica que tengas el GPS activo";
        }
    }
}

// =============================================
//  TRANSRIO EN VIVO - BUSES, TAXIS, MOTOTAXIS
//  Pegar al final del archivo, después de onErrorUbicacion
// =============================================

// 1. PARA TODOS LOS PASAJEROS: Ver los vehículos moviéndose
let vehiculosVivosMarkers = {};

async function verVehiculosEnVivo() {
    try {
        const res = await fetch('/api/vehiculos');
        if (!res.ok) return;
        const lista = await res.json();

        lista.forEach(v => {
            // Color igual que tus paradas
            let color = 'green';
            if (v.tipo === 'taxi') color = 'red';
            if (v.tipo === 'mototaxi') color = 'orange';
            if (v.tipo === 'jeep' || v.tipo === 'chiva') color = 'blue';

            let iconHtml = `<div style="background:${color};width:16px;height:16px;border-radius:50%;border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,0.6)"></div>`;

            if (vehiculosVivosMarkers[v.user_id]) {
                vehiculosVivosMarkers[v.user_id].setLatLng([v.lat, v.lng]);
            } else {
                let ico = L.divIcon({ className: 'vehiculo-vivo', html: iconHtml, iconSize: [20, 20], iconAnchor: [10, 10] });
                // usa tu variable 'map' que ya es global
                if (typeof map !== 'undefined') {
                    vehiculosVivosMarkers[v.user_id] = L.marker([v.lat, v.lng], { icon: ico }).addTo(map);
                    vehiculosVivosMarkers[v.user_id].bindPopup(`<b>${v.tipo.toUpperCase()}</b><br>Ruta: ${v.ruta ? v.ruta.nombre : 'Libre'}`);
                }
            }
        });
    } catch (e) { console.log('vehiculos:', e) }
}

// Inicia solo si el mapa existe
if (typeof map !== 'undefined') {
    verVehiculosEnVivo();
    setInterval(verVehiculosEnVivo, 5000);
}

// 2. SOLO PARA CONDUCTORES APROBADOS: Transmitir ubicación
let watchIdConductor = null;

function iniciarModoConductor() {
    // Esto solo lo llamas en la vista del conductor
    if (!navigator.geolocation) return;

    watchIdConductor = navigator.geolocation.watchPosition(
        async (pos) => {
            let lat = pos.coords.latitude;
            let lng = pos.coords.longitude;

            // Envía al servidor
            try {
                await fetch('/api/vehiculo-location', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ lat, lng, ruta_id: window.rutaActivaId || null })
                });
            } catch (e) {
                // Si da 403 es porque NO está aprobado por ti, y no aparecerá
                console.log('No autorizado para transmitir', e);
            }
        },
        (err) => console.log(err),
        { enableHighAccuracy: true, maximumAge: 0, timeout: 10000 }
    );
}

function detenerModoConductor() {
    if (watchIdConductor !== null) {
        navigator.geolocation.clearWatch(watchIdConductor);
        watchIdConductor = null;
    }
}





