@extends('layouts.app')
@section('title','Solicitudes de Compra')

@push('css')
<link rel="stylesheet" href="{{ asset('css/views/purchases.css') }}">
@endpush

@section('content')

<div class="page-header">
  <div><h2>Solicitudes de Compra</h2><p>Solicita equipamiento para tu puesto de trabajo</p></div>
  <a href="{{ route('purchases.create') }}" class="btn btn-primary">+ Nueva solicitud</a>
</div>

{{-- Catalog quick buttons --}}
<div class="card" style="margin-bottom:20px">
  <div class="card-title">🛒 Catálogo rápido</div>
  <div class="quick-catalog">
    @foreach([['💻','Portátil'],['🖥️','Monitor'],['⌨️','Teclado'],['🖱️','Ratón'],['🖨️','Impresora'],['📱','Móvil'],['🎧','Auriculares'],['💺','Silla ergo.']] as [$icon,$name])
    <a href="{{ route('purchases.create') }}?item={{ urlencode("$icon $name") }}"
       class="quick-catalog-item">
       <div class="qc-icon">{{ $icon }}</div>
       <div class="qc-name">{{ $name }}</div>
    </a>
    @endforeach
  </div>
</div>

{{-- My requests table --}}
<h3 style="margin-bottom:16px;font-size:18px">📋 {{ session('user_role')==='admin'?'Todas las solicitudes':'Mis solicitudes' }}</h3>
<div class="data-grid">
  @forelse($items as $req)
  <div class="data-card">
    <div class="data-card-header">
      <div class="data-card-title">{{ $req->item }} <span style="color:var(--text2);font-weight:600">(x{{ $req->quantity }})</span></div>
      @include('partials.status', ['status'=>$req->status])
    </div>
    <div class="data-card-body">
      @if(session('user_role')==='admin')
      <div class="data-card-row"><span>👤 Solicitante:</span> <strong>{{ $req->user->name }}</strong></div>
      @endif
      <div class="data-card-row"><span>📅 Fecha:</span> <strong>{{ $req->created_at->format('d/m/Y') }}</strong></div>
      <div class="data-card-row"><span>💰 Precio est.:</span> <strong>{{ $req->estimated_price ? '€'.number_format($req->estimated_price,2) : '—' }}</strong></div>
      <div style="background:var(--surface2);padding:10px;border-radius:8px;margin-top:4px">
        <div style="font-size:12px;color:var(--text3);margin-bottom:4px;font-weight:600;text-transform:uppercase">Justificación</div>
        {{ $req->reason }}
      </div>
      @if($req->admin_notes)
      <div style="background:var(--amber-dim);border:1px solid rgba(247,168,79,.2);padding:10px;border-radius:8px;color:var(--amber);margin-top:4px">
        <div style="font-size:12px;margin-bottom:4px;font-weight:600;text-transform:uppercase">Notas del Admin</div>
        {{ $req->admin_notes }}
      </div>
      @endif
    </div>
    @if($req->status==='pendiente')
    <div class="data-card-footer">
      @if(session('user_role')==='admin')
        <form action="{{ route('purchases.approve', $req->id) }}" method="POST"><button type="submit" class="btn btn-sm btn-success">✅ Aprobar</button>@csrf</form>
        <form action="{{ route('purchases.reject', $req->id) }}" method="POST"><button type="submit" class="btn btn-sm btn-danger">❌ Rechazar</button>@csrf</form>
      @elseif($req->user_id===session('user_id'))
        <form action="{{ route('purchases.destroy', $req->id) }}" method="POST" onsubmit="return confirm('¿Eliminar solicitud?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger">🗑️ Cancelar</button></form>
      @endif
    </div>
    @endif
  </div>
@empty
  <div class="empty" style="grid-column:1/-1"><p>Sin solicitudes de compra</p></div>
  @endforelse

<div style="margin-top:20px;display:flex;justify-content:center">
  {{ $items->links() }}
</div>
</div>
@endsection
