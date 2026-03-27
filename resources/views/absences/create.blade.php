@extends('layouts.app')
@section('title','Notificar Ausencia')
@section('content')

<div class="page-header">
  <div><h2>Notificar ausencia</h2><p>Informa con antelación de tu próxima ausencia</p></div>
  <a href="{{ route('absences.index') }}" class="btn btn-ghost">← Volver</a>
</div>

<div class="card" style="max-width:600px">
  <form action="{{ route('absences.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label>Tipo de ausencia *</label>
      <select name="type" class="form-control" required>
        @foreach($types as $type)
          <option value="{{ $type }}" {{ old('type')===$type?'selected':'' }}>{{ $type }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Fecha de inicio *</label>
        <input type="date" name="start_date" class="form-control"
          value="{{ old('start_date', now()->format('Y-m-d')) }}" required>
        @error('start_date')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Fecha de fin *</label>
        <input type="date" name="end_date" class="form-control"
          value="{{ old('end_date', now()->format('Y-m-d')) }}" required>
        @error('end_date')<div class="form-error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-group">
      <label>Motivo / observaciones <span style="color:var(--text3)">opcional</span></label>
      <textarea name="reason" class="form-control" rows="3"
        placeholder="Añade cualquier detalle relevante para el administrador...">{{ old('reason') }}</textarea>
    </div>

    <div style="background:var(--primary-dim);border:1px solid rgba(79,121,247,.2);border-radius:9px;
      padding:12px 14px;margin-bottom:16px;font-size:13px;color:var(--primary-light)">
      💡 La ausencia quedará <strong>Pendiente</strong> hasta ser aprobada por el administrador.
      Tus compañeros recibirán una alerta el día anterior.
    </div>

    <div style="display:flex;gap:10px">
      <button type="submit" class="btn btn-primary">Enviar notificación</button>
      <a href="{{ route('absences.index') }}" class="btn btn-ghost">Cancelar</a>
    </div>
  </form>
</div>
@endsection
