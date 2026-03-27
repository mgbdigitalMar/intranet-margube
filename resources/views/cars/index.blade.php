@extends('layouts.app')
@section('title','Vehículos')

@push('css')
<link rel="stylesheet" href="{{ asset('css/views/resources.css') }}">
@endpush

@section('content')

<div class="page-header">
  <div><h2>Vehículos de Empresa</h2><p>Reserva un vehículo para desplazamientos corporativos</p></div>
  <a href="{{ route('cars.create') }}" class="btn btn-primary">+ Reservar vehículo</a>
</div>

{{-- Fleet status --}}
<div class="three-col" style="margin-bottom:20px">
  @foreach($cars as $car)
  @php
    $todayReserved = $allRes->where('car', $car->fullName())->where('date', now()->toDateString())->where('status','confirmada')->first();
  @endphp
  <div class="card resource-card">
    <div class="rc-icon" style="font-size:36px;margin-bottom:8px">🚗</div>
    <div class="rc-name" style="font-weight:700;font-size:15px;margin-bottom:2px">{{ $car->name }}</div>
    <div class="rc-meta" style="font-size:12px;color:var(--text2);margin-bottom:10px">{{ $car->plate }} · {{ $car->model }}</div>
    <span class="tag {{ $todayReserved?'tag-red':'tag-green' }}">{{ $todayReserved?'🔴 Reservado hoy':'🟢 Disponible' }}</span>
    @if($todayReserved)
      <div class="rc-meta" style="font-size:11px;color:var(--text2);margin-top:6px">Destino: {{ $todayReserved->destination }}</div>
    @endif
  </div>
  @endforeach
</div>

{{-- Reservations table --}}
<h3 style="margin-bottom:16px;font-size:18px">📋 Reservas de vehículos</h3>
<div class="data-grid">
  @forelse($allRes as $r)
  <div class="data-card">
    <div class="data-card-header">
      <div class="data-card-title">🚗 {{ $r->car }}</div>
      @include('partials.status', ['status'=>$r->status])
    </div>
    <div class="data-card-body">
      <div class="data-card-row"><span>👤 Empleado:</span> <strong>{{ $r->user->name }}</strong></div>
      <div class="data-card-row"><span>📅 Fecha:</span> <strong>{{ $r->date->format('d/m/Y') }} · {{ $r->hour }}</strong></div>
      <div class="data-card-row"><span>📍 Destino:</span> <strong>{{ $r->destination }}</strong></div>
      <div class="data-card-row"><span>📝 Motivo:</span> <strong>{{ $r->reason ?: '—' }}</strong></div>
    </div>
    <div class="data-card-footer">
      @if(session('user_role')==='admin' && $r->status==='pendiente')
      <form action="{{ route('cars.approve', $r->id) }}" method="POST"><button type="submit" class="btn btn-sm btn-success">✅ Aprobar</button>@csrf</form>
      @endif
      @if(session('user_role')==='admin' || $r->user_id===session('user_id'))
      <form action="{{ route('cars.destroy', $r->id) }}" method="POST" onsubmit="return confirm('¿Cancelar reserva?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger">🗑️ Cancelar</button></form>
      @endif
    </div>
  </div>
  @empty
  <div class="empty" style="grid-column:1/-1"><p>Sin reservas de vehículos</p></div>
  @endforelse
</div>
@endsection
