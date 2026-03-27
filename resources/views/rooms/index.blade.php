@extends('layouts.app')
@section('title','Salas')

@push('css')
<link rel="stylesheet" href="{{ asset('css/views/resources.css') }}">
@endpush

@section('content')

<div class="page-header">
  <div><h2>Reservas de Salas</h2><p>Gestiona la disponibilidad de las salas de reuniones</p></div>
  <a href="{{ route('rooms.create') }}" class="btn btn-primary">+ Reservar sala</a>
</div>

{{-- Room status cards --}}
<div class="four-col" style="margin-bottom:20px">
  @foreach($rooms as $room)
  @php
    $todayRes = $todayRes->where('room', $room->name);
    $isOccupied = false;
    foreach($todayRes as $r) {
      $start = \Carbon\Carbon::parse($r->date->format('Y-m-d').' '.$r->hour);
      $end   = $start->copy()->addHours($r->duration);
      if(now()->between($start,$end) && $r->status==='confirmada') { $isOccupied=true; break; }
    }
  @endphp
  <div class="card card-sm resource-card">
    <div class="rc-icon" style="font-size:28px;margin-bottom:8px">🚪</div>
    <div class="rc-name" style="font-weight:700;font-size:14px;margin-bottom:3px">{{ $room->name }}</div>
    <div class="rc-meta" style="font-size:11px;color:var(--text2);margin-bottom:10px">Cap. {{ $room->capacity }} personas</div>
    <span class="tag {{ $isOccupied?'tag-red':'tag-green' }}">{{ $isOccupied?'🔴 Ocupada':'🟢 Libre ahora' }}</span>
  </div>
  @endforeach
</div>

<div class="two-col" style="margin-bottom:20px">
  {{-- My reservations --}}
  <div class="card">
    <div class="card-title">📋 Mis reservas</div>
    @if($myRes->isEmpty())
      <div class="empty"><p>No tienes reservas activas</p></div>
    @else
    @foreach($myRes->take(5) as $r)
    <div class="list-item">
      <div class="list-item-content">
        <div class="list-item-title">{{ $r->room }}</div>
        <div class="list-item-subtitle">{{ $r->date->format('d/m/Y') }} · {{ $r->hour }} ({{ $r->duration }}h)</div>
      </div>
      <div class="list-item-actions">
        @include('partials.status', ['status' => $r->status])
        <form action="{{ route('rooms.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Cancelar esta reserva?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger btn-icon-sm" title="Cancelar">🗑️</button>
        </form>
      </div>
    </div>
    @endforeach
    @endif
  </div>

  {{-- Quick info --}}
  <div class="card">
    <div class="card-title">ℹ️ Horarios disponibles</div>
    <div style="font-size:13.5px;color:var(--text2);line-height:1.9">
      <div>⏰ Disponible de <strong style="color:var(--text)">08:00 a 20:00</strong></div>
      <div>📅 Reservas desde hoy en adelante</div>
      <div>⚡ Confirmación por el administrador</div>
      <div style="margin-top:14px;padding:12px;background:var(--surface2);border-radius:9px;font-size:12.5px">
        💡 <strong style="color:var(--text)">Tip:</strong> Indica el motivo de la reunión para facilitar la aprobación.
      </div>
    </div>
  </div>
</div>

{{-- All reservations --}}
<h3 style="margin-bottom:16px;font-size:18px">📅 Todas las reservas</h3>
<div class="data-grid">
  @forelse($allRes as $r)
  <div class="data-card">
    <div class="data-card-header">
      <div class="data-card-title">🚪 {{ $r->room }}</div>
      @include('partials.status', ['status' => $r->status])
    </div>
    <div class="data-card-body">
      <div class="data-card-row"><span>👤 Empleado:</span> <strong>{{ $r->user->name }}</strong></div>
      <div class="data-card-row"><span>📅 Fecha:</span> <strong>{{ $r->date->format('d/m/Y') }}</strong></div>
      <div class="data-card-row"><span>⏰ Hora:</span> <strong>{{ $r->hour }} ({{ $r->duration }}h)</strong></div>
      <div class="data-card-row"><span>📝 Motivo:</span> <strong>{{ $r->reason }}</strong></div>
    </div>
    <div class="data-card-footer">
      @if(session('user_role')==='admin' && $r->status==='pendiente')
      <form action="{{ route('rooms.approve', $r->id) }}" method="POST"><button type="submit" class="btn btn-sm btn-success">✅ Aprobar</button>@csrf</form>
      @endif
      @if(session('user_role')==='admin' || $r->user_id===session('user_id'))
      <form action="{{ route('rooms.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Cancelar reserva?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger">🗑️ Cancelar</button></form>
      @endif
    </div>
  </div>
  @empty
  <div class="empty" style="grid-column:1/-1"><p>Sin reservas registradas</p></div>
  @endforelse
</div>

@endsection
