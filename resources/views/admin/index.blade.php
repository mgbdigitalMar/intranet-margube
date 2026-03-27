@extends('layouts.app')
@section('title','Panel de Administración')

@push('css')
<style>
  .admin-banner {
    background: var(--surface);
    border: 1px solid var(--border);
    padding: 12px 16px;
    border-radius: var(--radius);
    font-weight: 600;
    margin-bottom: 20px;
    color: var(--text);
  }
  .page-header-actions {
    flex-wrap: wrap;
    gap: 12px
  }
</style>
@endpush

@section('content')

<div class="admin-banner">
  ⭐ Panel de administración — Tienes acceso completo a toda la gestión del portal.
</div>

<div class="page-header">
  <div><h2>⚙️ Panel de Administración</h2><p>Gestión completa del portal corporativo</p></div>
  <div class="page-header-actions" style="flex-wrap: wrap; gap: 12px;">
    <a href="{{ route('admin.rooms-config') }}" class="btn btn-ghost">🚪 Gestionar Salas</a>
    <a href="{{ route('admin.cars-config') }}" class="btn btn-ghost">🚗 Gestionar Vehículos</a>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">+ Añadir empleado</a>
  </div>
</div>

{{-- Pending purchases + pending absences --}}
<div class="two-col" style="margin-bottom:20px; align-items: flex-start;">

  {{-- Pending purchases --}}
  <div class="card">
    <div class="card-title">🛒 Solicitudes de compra pendientes
      @if($pendingPurchases->count())
        <span class="tag tag-amber">{{ $pendingPurchases->count() }}</span>
      @endif
    </div>
    @if($pendingPurchases->isEmpty())
      <div class="empty"><p>Sin solicitudes pendientes ✅</p></div>
    @else
    <div class="data-grid stagger">
      @foreach($pendingPurchases as $p)
      <div class="data-card">
        <div class="data-card-header">
          <div class="data-card-title" title="{{ $p->reason }}">{{ $p->item }} <span style="color:var(--text2);font-weight:600">(x{{ $p->quantity }})</span></div>
        </div>
        <div class="data-card-body">
          <div class="data-card-row"><span>👤 Empleado:</span> <strong>{{ $p->user->name }}</strong></div>
        </div>
        <div class="data-card-footer">
          <form action="{{ route('purchases.approve', $p->id) }}" method="POST">@csrf <button type="submit" class="btn btn-sm btn-success">✅ Aprobar</button></form>
          <form action="{{ route('purchases.reject', $p->id) }}" method="POST">@csrf <button type="submit" class="btn btn-sm btn-danger">❌ Rechazar</button></form>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>

  {{-- Pending absences --}}
  <div class="card">
    <div class="card-title">🏖️ Ausencias pendientes
      @if($pendingAbsences->count())
        <span class="tag tag-amber">{{ $pendingAbsences->count() }}</span>
      @endif
    </div>
    @if($pendingAbsences->isEmpty())
      <div class="empty"><p>Sin ausencias pendientes ✅</p></div>
    @else
    <div class="data-grid stagger">
      @foreach($pendingAbsences as $ab)
      <div class="data-card">
        <div class="data-card-header">
          <div class="data-card-title">{{ $ab->user->name }}</div>
        </div>
        <div class="data-card-body">
          <div class="data-card-row"><span>📝 Tipo:</span> <strong>{{ $ab->type }}</strong></div>
          <div class="data-card-row"><span>📅 Fechas:</span> <strong>{{ $ab->start_date->format('d/m') }} – {{ $ab->end_date->format('d/m/Y') }}</strong></div>
        </div>
        <div class="data-card-footer">
          <form action="{{ route('absences.approve', $ab->id) }}" method="POST">@csrf <button type="submit" class="btn btn-sm btn-success">✅ Aprobar</button></form>
          <form action="{{ route('absences.reject', $ab->id) }}" method="POST">@csrf <button type="submit" class="btn btn-sm btn-danger">❌ Rechazar</button></form>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>

</div>

{{-- Pending rooms + pending cars --}}
<div class="two-col" style="margin-bottom:20px; align-items: flex-start;">

  <div class="card">
    <div class="card-title">🚪 Salas pendientes
      @if($pendingRooms->count()) <span class="tag tag-amber">{{ $pendingRooms->count() }}</span> @endif
    </div>
    @if($pendingRooms->isEmpty())
      <div class="empty"><p>Sin reservas pendientes ✅</p></div>
    @else
    <div class="data-grid stagger">
      @foreach($pendingRooms as $r)
      <div class="data-card">
        <div class="data-card-header">
          <div class="data-card-title">🚪 {{ $r->room }}</div>
        </div>
        <div class="data-card-body">
          <div class="data-card-row"><span>👤 Empleado:</span> <strong>{{ $r->user->name }}</strong></div>
          <div class="data-card-row"><span>📅 Fecha:</span> <strong>{{ $r->date->format('d/m') }} {{ $r->hour }}</strong></div>
        </div>
        <div class="data-card-footer">
          <form action="{{ route('rooms.approve', $r->id) }}" method="POST">@csrf <button type="submit" class="btn btn-sm btn-success">✅</button></form>
          <form action="{{ route('rooms.destroy', $r->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger">❌</button></form>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>

  <div class="card">
    <div class="card-title">🚗 Vehículos pendientes
      @if($pendingCars->count()) <span class="tag tag-amber">{{ $pendingCars->count() }}</span> @endif
    </div>
    @if($pendingCars->isEmpty())
      <div class="empty"><p>Sin reservas pendientes ✅</p></div>
    @else
    <div class="data-grid">
      @foreach($pendingCars as $c)
      <div class="data-card">
        <div class="data-card-header">
          <div class="data-card-title">🚗 {{ Str::before($c->car,' (') }}</div>
        </div>
        <div class="data-card-body">
          <div class="data-card-row"><span>👤 Empleado:</span> <strong>{{ $c->user->name }}</strong></div>
          <div class="data-card-row"><span>📅 Fecha:</span> <strong>{{ $c->date->format('d/m') }} {{ $c->hour }}</strong></div>
        </div>
        <div class="data-card-footer">
          <form action="{{ route('cars.approve', $c->id) }}" method="POST">@csrf <button type="submit" class="btn btn-sm btn-success">✅</button></form>
          <form action="{{ route('cars.destroy', $c->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger">❌</button></form>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>

</div>

{{-- Employees table --}}
<div class="card">
  <div class="card-title">👥 Gestión de empleados</div>
  <div class="data-grid stagger">
    @foreach($employees as $emp)
    <div class="data-card">
      <div class="data-card-header" style="align-items:center">
        <div style="display:flex;align-items:center;gap:10px">
          <div class="avatar" style="width:36px;height:36px;font-size:12px;flex-shrink:0">{{ $emp->initials() }}</div>
          <div>
            <div class="data-card-title" style="margin-bottom:0">{{ $emp->name }}</div>
            @if($emp->isAdmin()) <span class="badge-admin" style="margin-top:4px;display:inline-block">⭐ Admin</span> @else <span style="color:var(--text2);font-size:11px;font-weight:600">👤 Empleado</span> @endif
          </div>
        </div>
      </div>
      <div class="data-card-body">
        <div class="data-card-row"><span>Email:</span> <strong>{{ $emp->email }}</strong></div>
        <div class="data-card-row"><span>Dpto:</span> <strong>{{ $emp->department }}</strong></div>
        <div class="data-card-row"><span>Cargo:</span> <strong>{{ $emp->position }}</strong></div>
      </div>
      <div class="data-card-footer">
        <a href="{{ route('employees.edit', $emp->id) }}" class="btn btn-sm btn-ghost">✏️ Editar</a>
        @if($emp->id !== session('user_id'))
        <form action="{{ route('employees.toggleRole', $emp->id) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-sm btn-amber" title="Cambiar rol">
            {{ $emp->isAdmin() ? '⬇️ Quitar admin' : '⬆️ Hacer admin' }}
          </button>
        </form>
        <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" onsubmit="return confirm('¿Eliminar a {{ $emp->name }}?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
        </form>
        @endif
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection
