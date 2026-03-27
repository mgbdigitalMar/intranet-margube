@extends('layouts.app')
@section('title','Editar publicación')
@section('content')

<div class="page-header">
  <div>
    <h2>Editar publicación</h2>
    <p>Modifica el contenido de esta publicación</p>
  </div>
  <a href="{{ route('news.index') }}" class="btn btn-ghost">← Volver</a>
</div>

<div class="card" style="max-width:680px">
  <form action="{{ route('news.update', $item->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="form-group">
      <label>Tipo</label>
      <select name="type" class="form-control">
        <option value="noticia" {{ $item->type==='noticia'?'selected':'' }}>📰 Noticia</option>
        <option value="evento"  {{ $item->type==='evento'?'selected':'' }}>🎉 Evento</option>
      </select>
    </div>

    <div class="form-group">
      <label>Título *</label>
      <input type="text" name="title" class="form-control" value="{{ old('title',$item->title) }}" required>
      @error('title')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label>Contenido *</label>
      <textarea name="body" class="form-control" rows="5">{{ old('body',$item->body) }}</textarea>
      @error('body')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group" id="event-date-group">
      <label>Fecha y hora del evento</label>
      <input type="datetime-local" name="event_date" class="form-control"
        value="{{ old('event_date', $item->event_date?->format('Y-m-d\TH:i')) }}">
    </div>

    <div style="display:flex;gap:10px;margin-top:6px">
      <button type="submit" class="btn btn-primary">Guardar cambios</button>
      <a href="{{ route('news.index') }}" class="btn btn-ghost">Cancelar</a>
    </div>
  </form>
</div>

<script>
const typeSelect = document.querySelector('select[name=type]');
const evGroup    = document.getElementById('event-date-group');
function toggleDate() {
  evGroup.style.display = typeSelect.value === 'evento' ? 'block' : 'none';
}
typeSelect.addEventListener('change', toggleDate);
toggleDate();
</script>
@endsection
