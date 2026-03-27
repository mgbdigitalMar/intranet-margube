@extends('layouts.app')
@section('title','Configurar Salas')
@section('content')

<div class="page-header">
  <div><h2>🚪 Gestionar Salas</h2><p>Añade, edita o elimina las salas disponibles para reservar</p></div>
  <a href="{{ route('admin.index') }}" class="btn btn-ghost">← Panel Admin</a>
</div>

<div class="two-col">
  {{-- Add room form --}}
  <div class="card">
    <div class="card-title">➕ Añadir nueva sala</div>
    <form action="{{ route('admin.rooms-config.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label>Nombre de la sala *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
          placeholder="Ej: Sala Reuniones C" required>
        @error('name')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Capacidad (personas) *</label>
        <input type="number" name="capacity" class="form-control" value="{{ old('capacity', 10) }}"
          min="1" max="200" required>
      </div>
      <div class="form-group">
        <label>Descripción <span style="color:var(--text3)">opcional</span></label>
        <input type="text" name="description" class="form-control" value="{{ old('description') }}"
          placeholder="Ej: Sala con proyector y videoconferencia">
      </div>
      <button type="submit" class="btn btn-primary">Añadir sala</button>
    </form>
  </div>

  {{-- Existing rooms --}}
  <div class="card">
    <div class="card-title">📋 Salas actuales ({{ $rooms->count() }})</div>
    @if($rooms->isEmpty())
      <div class="empty"><p>No hay salas configuradas todavía.</p></div>
    @else
@foreach($rooms as $room)
    <div class="admin-list-item">
      <div>
        <div style="font-weight:600;font-size:14px">{{ $room->name }}</div>
        <div style="font-size:12px;color:var(--text2)">
          👥 {{ $room->capacity }} personas
          @if($room->description) · {{ $room->description }}@endif
        </div>
      </div>
      <form action="{{ route('admin.rooms-config.destroy', $room->id) }}" method="POST"
        onsubmit="return confirm('¿Eliminar la sala {{ $room->name }}?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
      </form>
    </div>
    @endforeach
    @endif
  </div>
</div>
@endsection
