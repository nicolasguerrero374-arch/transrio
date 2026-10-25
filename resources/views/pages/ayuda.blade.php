@extends('layouts.app')
@section('content')
<div style="margin-top:80px;padding:20px">
<h2>¿Cómo usar TransRio?</h2>

<div style="background:#E3F2FD;padding:15px;border-radius:10px;margin-top:15px">
<h2 style="color:#0D47A1;">❓ Ayuda</h2>
<p>💡 <b>Tip 1:</b> Los pines verdes son buses, rojos mototaxis, amarillos taxis. Dale clic para ver foto e info.</p>
<p>💡 <b>Tip 2:</b> Usa el buscador "¿A dónde vas?" para saber de qué parada sale tu bus.</p>
<p>💡 <b>Tip 3:</b> Usa "¿Qué transporte?" para filtrar solo taxis o solo mototaxis.</p>
<p>💡 <b>Tip 4:</b> En menú > Rutas puedes ver el recorrido azul de cada bus en el mapa.</p>

<div style="background:white; padding:20px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
<p>Bienvenido a <b>TransRio</b> 🚌</p>
<p>Usa el menú para ver el mapa, las paradas, rutas, horarios, tarifas y números por si tienes alguna emergencia.</p>
<p style="margin-top:20px; color:#666; font-size:13px;">Versión 1.0 - Hecho con ❤️ por Frank Nicolas Guerrero y Luisa</p>
</div>
<p style="margin-top:20px">Soporte: <a href="mailto:admini@transrio.com">admini@transrio.com</a></p>
</div>
<br><a href="{{ url('/') }}" style="color:#0D47A1;">← Volver al Mapa</a>
</div>
@endsection
