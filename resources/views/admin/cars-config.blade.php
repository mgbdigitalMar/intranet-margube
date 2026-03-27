@extends('layouts.app')
@section('title','Configurar Vehículos')
@section('content')

<div class="page-header">
  <div><h2>🚗 Gestionar Vehículos</h2><p>Añade o elimina vehículos de la flota corporativa</p></div>
  <a href="{{ route('admin.index') }}" class="btn btn-ghost">← Panel Admin</a>
</div>

<div class="two-col">
  {{-- Add car form --}}
  <div class="card">
    <div class="card-title">➕ Añadir nuevo vehículo</div>
    <form action="{{ route('admin.cars-config.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label>Nombre del vehículo *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
          placeholder="Ej: Seat Ibiza" required>
        @error('name')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Matrícula *</label>
        <input type="text" name="plate" class="form-control" value="{{ old('plate') }}"
          placeholder="Ej: 1234-XYZ" required>
        @error('plate')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Año/Modelo <span style="color:var(--text3)">opcional</span></label>
        <input type="text" name="model" class="form-control" value="{{ old('model') }}"
          placeholder="Ej: 2023">
      </div>
      <button type="submit" class="btn btn-primary">Añadir vehículo</button>
    </form>
  </div>

  {{-- Existing cars --}}
  <div class="card">
    <div class="card-title">📋 Flota actual ({{ $cars->count() }} vehículos)</div>
    @if($cars->isEmpty())
      <div class="empty"><p>No hay vehículos configurados todavía.</p></div>
    @else
@foreach($cars as $car)
    <div class="admin-list-item">
      <div style="display:flex;align-items:center;gap:12px">
        <div style="font-size:26px">🚗</div>
        <div>
          <div style="font-weight:600;font-size:14px">{{ $car->name }}</div>
          <div style="font-size:12px;color:var(--text2)">
            🔖 {{ $car->plate }}
            @if($car->model) · {{ $car->model }}@endif
          </div>
        </div>
      </div>
      <form action="{{ route('admin.cars-config.destroy', $car->id) }}" method="POST"
        onsubmit="return confirm('¿Eliminar el vehículo {{ $car->name }}?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
      </form>
    </div>
    @endforeach
    @endif
  </div>
</div>
@endsection
