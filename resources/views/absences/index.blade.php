@extends('layouts.app')
@section('title','Ausencias')
@section('content')

<div class="page-header">
  <div><h2>Ausencias</h2><p>Notifica tus ausencias con antelación</p></div>
  <a href="{{ route('absences.create') }}" class="btn btn-primary">+ Notificar ausencia</a>
</div>

{{-- My absences --}}
<h3 style="margin-bottom:16px;font-size:18px">🏖️ Mis ausencias</h3>
<div class="data-grid" style="margin-bottom:30px">
  @forelse($mine as $ab)
  <div class="data-card">
    <div class="data-card-header">
      <div class="data-card-title">{{ $ab->type }}</div>
      @include('partials.status', ['status'=>$ab->status])
    </div>
    <div class="data-card-body">
      <div class="data-card-row"><span>📅 Inicio:</span> <strong>{{ $ab->start_date->format('d/m/Y') }}</strong></div>
      <div class="data-card-row"><span>📅 Fin:</span> <strong>{{ $ab->end_date->format('d/m/Y') }} ({{ $ab->start_date->diffInDays($ab->end_date) + 1 }}d)</strong></div>
      <div class="data-card-row"><span>📝 Motivo:</span> <strong>{{ $ab->reason ?: '—' }}</strong></div>
    </div>
    @if($ab->status==='pendiente')
    <div class="data-card-footer">
      <form action="{{ route('absences.destroy', $ab->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta notificación?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger">🗑️ Eliminar</button></form>
    </div>
    @endif
  </div>
@empty
  <div class="empty" style="grid-column:1/-1"><p>No has notificado ninguna ausencia todavía</p></div>
  @endforelse

@if(isset($mine) && $mine instanceof \Illuminate\Pagination\LengthAwarePaginator)
<div style="margin-top:20px;display:flex;justify-content:center">
  {{ $mine->links() }}
</div>
@endif
</div>

{{-- Admin: all absences --}}
@if(session('user_role')==='admin')
<h3 style="margin-bottom:16px;font-size:18px;margin-top:20px">📋 Todas las ausencias (Admin)</h3>
<div class="data-grid">
  @forelse($all as $ab)
  <div class="data-card">
    <div class="data-card-header">
      <div class="data-card-title">{{ $ab->user->name }}</div>
      @include('partials.status', ['status'=>$ab->status])
    </div>
    <div class="data-card-body">
      <div class="data-card-row"><span>📝 Tipo:</span> <strong>{{ $ab->type }}</strong></div>
      <div class="data-card-row"><span>📅 Fechas:</span> <strong>{{ $ab->start_date->format('d/m/Y') }} → {{ $ab->end_date->format('d/m/Y') }}</strong></div>
      <div class="data-card-row"><span>⏳ Duración:</span> <strong>{{ $ab->start_date->diffInDays($ab->end_date) + 1 }} día(s)</strong></div>
      <div class="data-card-row"><span>📄 Motivo:</span> <strong>{{ $ab->reason ?: '—' }}</strong></div>
    </div>
    <div class="data-card-footer">
      @if($ab->status==='pendiente')
      <form action="{{ route('absences.approve', $ab->id) }}" method="POST"><button type="submit" class="btn btn-sm btn-success">✅ Aprobar</button>@csrf</form>
      <form action="{{ route('absences.reject', $ab->id) }}" method="POST"><button type="submit" class="btn btn-sm btn-danger">❌ Rechazar</button>@csrf</form>
      @endif
      <form action="{{ route('absences.destroy', $ab->id) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-ghost btn-icon">🗑️</button></form>
    </div>
  </div>
@empty
  <div class="empty" style="grid-column:1/-1"><p>Sin ausencias registradas</p></div>
  @endforelse

@if(isset($all) && $all instanceof \Illuminate\Pagination\LengthAwarePaginator)
<div style="margin-top:20px;display:flex;justify-content:center">
  {{ $all->links() }}
</div>
@endif
</div>
@endif

@endsection
