@extends('layouts.app')
@section('title','Nueva Solicitud')
@section('content')

<div class="page-header">
  <div><h2>Nueva solicitud de compra</h2><p>Rellena el formulario para solicitar material o equipamiento</p></div>
  <a href="{{ route('purchases.index') }}" class="btn btn-ghost">← Volver</a>
</div>

<div class="card" style="max-width:620px">
  <form action="{{ route('purchases.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label>Artículo *</label>
      <select name="item" id="item-select" class="form-control" required>
        <option value="">-- Selecciona un artículo --</option>
        @foreach($catalog as $cat)
          <option value="{{ $cat }}" {{ (old('item', request('item'))===$cat)?'selected':'' }}>{{ $cat }}</option>
        @endforeach
      </select>
      @error('item')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group" id="custom-item-group" style="display:none">
      <label>Especifica el artículo *</label>
      <input type="text" name="custom_item" class="form-control" value="{{ old('custom_item') }}"
        placeholder="Describe el artículo que necesitas">
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Cantidad *</label>
        <input type="number" name="quantity" class="form-control" value="{{ old('quantity',1) }}"
          min="1" max="100" required>
        @error('quantity')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Precio estimado (€) <span style="color:var(--text3)">opcional</span></label>
        <input type="number" name="estimated_price" class="form-control" value="{{ old('estimated_price') }}"
          step="0.01" min="0" placeholder="0.00">
      </div>
    </div>

    <div class="form-group">
      <label>Justificación / Motivo *</label>
      <textarea name="reason" class="form-control" rows="4"
        placeholder="¿Por qué necesitas este artículo? ¿Cómo lo vas a utilizar?">{{ old('reason') }}</textarea>
      @error('reason')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    <div style="display:flex;gap:10px;margin-top:6px">
      <button type="submit" class="btn btn-primary">Enviar solicitud</button>
      <a href="{{ route('purchases.index') }}" class="btn btn-ghost">Cancelar</a>
    </div>
  </form>
</div>

<script>
const sel   = document.getElementById('item-select');
const grp   = document.getElementById('custom-item-group');
sel.addEventListener('change', () => {
  grp.style.display = sel.value === 'Otro' ? 'block' : 'none';
});
if (sel.value === 'Otro') grp.style.display = 'block';
</script>
@endsection
