@extends('layouts.app')
@section('title','Nueva publicación')
@section('content')

<div class="page-header">
  <div>
    <h2>Nueva publicación</h2>
    <p>Crea una noticia o un evento para toda la empresa</p>
  </div>
  <a href="{{ route('news.index') }}" class="btn btn-ghost">← Volver</a>
</div>

<div class="card" style="max-width:680px">
  <form action="{{ route('news.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label>Tipo de publicación</label>
      <select name="type" class="form-control">
        <option value="noticia" {{ old('type')==='noticia'?'selected':'' }}>📰 Noticia</option>
        <option value="evento"  {{ old('type')==='evento'?'selected':'' }}>🎉 Evento</option>
      </select>
    </div>

    <div class="form-group">
      <label>Título *</label>
      <input type="text" name="title" class="form-control" value="{{ old('title') }}"
        placeholder="Título de la publicación" required>
      @error('title')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label>Contenido *</label>
      <textarea name="body" class="form-control" rows="5"
        placeholder="Describe el contenido con detalle...">{{ old('body') }}</textarea>
      @error('body')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group" id="event-date-group">
      <label>Fecha y hora del evento <span style="color:var(--text3)">(solo para eventos)</span></label>
      <input type="datetime-local" name="event_date" class="form-control" value="{{ old('event_date') }}">
    </div>

    <div style="display:flex;gap:10px;margin-top:6px">
      <button type="submit" class="btn btn-primary">Publicar</button>
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
