@extends('layouts.app')
@section('content')
<div style="padding:80px 15px 20px 15px; max-width:700px; margin:auto;">
  <h2 style="color:#0D47A1;">⏰ Horarios</h2>

  <!-- PESTAÑAS -->
  <div style="display:flex; gap:8px; overflow-x:auto; padding:10px 0; margin-bottom:10px;">
    <button data-tipo="todos" class="btn-filtro-horario activo" onclick="filtrarHorarios('todos')">Todos</button>
    <button data-tipo="manana" class="btn-filtro-horario" onclick="filtrarHorarios('manana')">🌅 Mañana</button>
    <button data-tipo="mediodia" class="btn-filtro-horario" onclick="filtrarHorarios('mediodia')">☀️ Medio día</button>
    <button data-tipo="tarde" class="btn-filtro-horario" onclick="filtrarHorarios('tarde')">🌇 Tarde</button>
  </div>

  <style>
    .btn-filtro-horario{border:1.5px solid #0D47A1; background:white; color:#0D47A1; padding:6px 16px; border-radius:20px; font-weight:600; white-space:nowrap;}
    .btn-filtro-horario.activo{background:#0D47A1; color:white;}
  </style>

  <div style="background:white; border-radius:12px; overflow:hidden; box-shadow:2px 4px 8px rgba(0,0,0,.1);">
    @foreach($horarios as $h)
      <div class="horario-item" data-hora="{{ \Carbon\Carbon::parse($h->hora_salida)->format('g:i A') }}" style="padding:14px 16px; border-bottom:1px solid #eee; display:flex; justify-content:space-between; align-items:center; gap:15px;">
        <span style="line-height:1.4; color:#333;">
          {{ $h->ruta->nombre ?? 'Ruta' }} - {{ $h->parada->nombre ?? '' }}
        </span>
        <b style="white-space:nowrap; flex-shrink:0; background:#E3F2FD; color:#0D47A1; padding:5px 12px; border-radius:20px; font-size:14px;">
          {{ \Carbon\Carbon::parse($h->hora_salida)->format('g:i A') }}
        </b>
      </div>
    @endforeach
  </div>
  <br>
  <br>
  <div><a href="{{ url('/') }}" style="color:#0D47A1;">← Volver al Mapa</a></div>
</div>

<script>
function filtrarHorarios(filtro){
  document.querySelectorAll('.btn-filtro-horario').forEach(b=>b.classList.remove('activo'));
  document.querySelector(`[data-tipo="${filtro}"]`).classList.add('activo');

  document.querySelectorAll('.horario-item').forEach(item=>{
    let texto = item.dataset.hora.toLowerCase(); // ej: "7:00 am" "12:15 pm"
    let hora = parseInt(texto.split(':')[0]);
    let esPM = texto.includes('pm');

    let categoria = '';
    if (!esPM) {
      categoria = 'manana'; // Todo AM
    } else {
      if (hora == 12 || hora == 1) {
        categoria = 'mediodia'; // 12:00 a 1:59 PM
      } else {
        categoria = 'tarde'; // 2:00 PM en adelante
      }
    }

    if (filtro === 'todos' || categoria === filtro) {
      item.style.display = 'flex';
    } else {
      item.style.display = 'none';
    }
  });
}
</script>
@endsection
