@extends('layouts.app')
@section('content')
<div style="margin-top:80px;padding:20px;background:white;">
<h2>¿Cómo usar TransRio?</h2>

 <!-- Pestaña 1 -->
<div style="margin:15px 0;display:flex;gap:10px;background:white;">
  <button onclick="showTab('rapida')" id="btn-rapida" style="background:#2563eb;color:white;padding:10px 15px;border-radius:10px;border:none;">Ayuda Rápida</button>
  <button onclick="showTab('manual')" id="btn-manual" style="background:#e5e7eb;padding:10px 15px;border-radius:10px;border:none;">Manual Completo</button>
</div>

<div id="tab-rapida" style="background:#DBEAFE;padding:15px;border-radius:16px;margin-top:15px;">
  <h2 style="color:#4047A2;">❓ Ayuda</h2>
  <p>💡<b>Tip 1:</b> Los pines verdes son buses, rojos mototaxis, amarillos taxis. Dale clic para ver foto e info.</p>
  <p>💡<b>Tip 2:</b> Usa el buscador "¿A dónde vas?" para saber de qué parada sale tu bus.</p>
  <p>💡<b>Tip 3:</b> Usa "¿Qué transporte?" para filtrar solo taxis o solo mototaxis.</p>
  <p>💡<b>Tip 4:</b> En menú > Rutas puedes ver el recorrido azul de cada bus en el mapa.</p>

  <div style="background:white; padding:20px; border-radius:12px; box-shadow:2px 3px rgba(0,0,0,0.1);margin-top:15px;">
    <p>Bienvenido a <b>TransRio</b> 🚐</p>
    <p>Usa el menú para ver el mapa, las paradas, rutas, horarios, tarifas y números por si tienes alguna emergencia.</p>
    <p style="margin-top:20px;color:#666; font-size:13px;">Versión 1.0 - Hecho con ❤️ por Frank Nicolas Guerrero y Luisa</p>
  </div>
  <p style="margin-top:20px;">Soporte: <a href="mailto:admini@transrio.com">admini@transrio.com</a></p>
</div>

<!-- Manual de usuarios -->
<div id="tab-manual" style="display:none;background:white;padding:15px;border-radius:16px;margin-top:15px;border:1px solid #ddd;">
  <h2 style="color:#4047A2;">📘 Manual de Usuario TransRio</h2>
  <p style="font-size:13px;color:#555;">Sistema de información y consulta del transporte público de Riosucio, Caldas - Guía para pasajeros</p>

  <div style="margin:15px 0;display:flex;gap:10px;flex-wrap:wrap;">
    <a href="/manuals/Manual_Usuario_TransRio.pdf" target="_blank" style="background:#2563eb;color:white;padding:10px 15px;border-radius:8px;text-decoration:none;">📄 Ver PDF</a>
    <a href="/manuals/Manual_Usuario_TransRio.pdf" download style="background:#16a34a;color:white;padding:10px 15px;border-radius:8px;text-decoration:none;">⬇️ Descargar</a>
  </div>

  <iframe src="/manuals/Manual_Usuario_TransRio.pdf" style="width:100%;height:600px;border-radius:12px;border:1px solid #ccc;" title="Manual TransRio"></iframe>

  <p style="font-size:12px;color:#888;margin-top:10px;">Si no se ve el PDF en tu celular, usa el botón "Ver PDF".</p>
</div>

<br><a href="{{ url('/') }}" style="color:#4047A1;">← Volver al Mapa</a>
</div>

<script>
function showTab(tab){
  document.getElementById('tab-rapida').style.display = 'none';
  document.getElementById('tab-manual').style.display = 'none';
  document.getElementById('btn-rapida').style.background = '#e5e7eb';
  document.getElementById('btn-rapida').style.color = 'black';
  document.getElementById('btn-manual').style.background = '#e5e7eb';
  document.getElementById('btn-manual').style.color = 'black';

  document.getElementById('tab-'+tab).style.display = 'block';
  document.getElementById('btn-'+tab).style.background = '#2563eb';
  document.getElementById('btn-'+tab).style.color = 'white';
}
</script>
@endsection
