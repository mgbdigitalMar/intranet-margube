@extends('layouts.app')
@section('title','Reservar Vehículo')
@section('content')

<div class="page-header">
  <div><h2>Reservar vehículo</h2><p>Solicita un vehículo de empresa para tu desplazamiento</p></div>
  <a href="{{ route('cars.index') }}" class="btn btn-ghost">← Volver</a>
</div>

<div class="card" style="max-width:600px">
  <form action="{{ route('cars.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label>Vehículo *</label>
      <select name="car" class="form-control" required>
        <option value="">-- Selecciona un vehículo --</option>
        @foreach($cars as $car)
          <option value="{{ $car->fullName() }}" {{ old('car')===$car->fullName()?'selected':'' }}>
            {{ $car->name }} · {{ $car->plate }} ({{ $car->model }})
          </option>
        @endforeach
      </select>
      @error('car')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Fecha de salida *</label>
        <input type="date" name="date" class="form-control" value="{{ old('date', now()->format('Y-m-d')) }}"
          min="{{ now()->format('Y-m-d') }}" required>
        @error('date')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Hora de salida *</label>
        <select name="hour" class="form-control" required>
          @foreach(['07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00'] as $h)
            <option value="{{ $h }}" {{ old('hour')===$h?'selected':'' }}>{{ $h }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group">
      <label>Destino *</label>
      <input type="text" name="destination" class="form-control" value="{{ old('destination') }}"
        placeholder="Ciudad o dirección de destino" required>
      @error('destination')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label>Motivo del desplazamiento</label>
      <input type="text" name="reason" class="form-control" value="{{ old('reason') }}"
        placeholder="Ej: Visita a cliente, Reunión comercial...">
    </div>

    <div style="display:flex;gap:10px;margin-top:6px">
      <button type="submit" class="btn btn-primary">Solicitar vehículo</button>
      <a href="{{ route('cars.index') }}" class="btn btn-ghost">Cancelar</a>
    </div>
  </form>
</div>
@endsection
