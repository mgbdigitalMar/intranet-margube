@extends('layouts.app')
@section('title','Dashboard')

@push('css')
<style>
/* ── TIMELINE ── */
.timeline{position:relative;padding-left:22px;}
.timeline::before{content:'';position:absolute;left:7px;top:0;bottom:0;width:2px;background:var(--border);}

.tl-item{position:relative;padding-bottom:18px;}
.tl-item::before{
  content:'';
  position:absolute;
  left:-18px;
  top:4px;
  width:10px;
  height:10px;
  border-radius:50%;
  background:var(--primary);
  border:2px solid var(--surface);
  transition:transform .2s;
}

.tl-item:hover::before{transform:scale(1.3);}
.tl-date{font-size:11px;color:var(--text3);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px;}
.tl-content{font-size:13.5px;font-weight:500;color:var(--text);}
.tl-sub{font-size:12px;color:var(--text2);}
</style>
@endpush

@section('content')

{{-- Alerts --}}
@if(count($alerts))
<div class="alerts">
  @foreach($alerts as $al)
  <div class="alert alert-{{ $al['type'] }}">
    <span class="al-icon">{{ $al['type']==='birthday'?'🎂':($al['type']==='event'?'📅':'🏖️') }}</span>
    <span>{!! $al['msg'] !!}</span>
    <button class="alert-close" onclick="this.parentElement.remove()">✕</button>
  </div>
  @endforeach
</div>
@endif

{{-- Stats --}}
<div class="stats-grid">
  <div class="stat-card blue">
    <div class="stat-icon">🚪</div>
    <div class="stat-val">{{ $stats['rooms'] }}</div>
    <div class="stat-label">Reservas de salas hoy</div>
  </div>
  <div class="stat-card amber">
    <div class="stat-icon">🚗</div>
    <div class="stat-val">{{ $stats['cars'] }}</div>
    <div class="stat-label">Vehículos reservados</div>
  </div>
  <div class="stat-card green">
    <div class="stat-icon">🛒</div>
    <div class="stat-val">{{ $stats['purchases'] }}</div>
    <div class="stat-label">Solicitudes pendientes</div>
  </div>
  <div class="stat-card purple">
    <div class="stat-icon">🏖️</div>
    <div class="stat-val">{{ $stats['absences'] }}</div>
    <div class="stat-label">Ausencias este mes</div>
  </div>
</div>

<div class="two-col" style="margin-bottom:18px">
  {{-- Upcoming events --}}
  <div class="card">
    <div class="card-title">📅 Próximos eventos</div>
    @if($upcomingEvents->isEmpty())
      <div class="empty"><div class="e-icon">📭</div><p>No hay eventos próximos</p></div>
    @else
    <div class="timeline">
      @foreach($upcomingEvents as $ev)
      <div class="tl-item">
        <div class="tl-date">{{ $ev->event_date->isoFormat('ddd D MMM · HH:mm') }}</div>
        <div class="tl-content">{{ $ev->title }}</div>
        <div class="tl-sub">🎉 Evento corporativo</div>
      </div>
      @endforeach
    </div>
    @endif
  </div>

  {{-- Birthdays --}}
  <div class="card">
    <div class="card-title">🎂 Próximos cumpleaños</div>
    @foreach($birthdays as $b)
    @php
      $u    = $b['user'];
      $days = $b['days'];
      $label = $days === 0 ? '🎉 ¡Hoy!' : ($days === 1 ? '🎂 Mañana' : "En {$days} días");
    @endphp
    <div style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid var(--border)">
      <div class="avatar">{{ $u->initials() }}</div>
      <div style="flex:1">
        <div style="font-weight:600;font-size:13.5px">{{ $u->name }}</div>
        <div style="font-size:12px;color:var(--text2)">{{ $u->department }}</div>
      </div>
      <span class="tag tag-amber">{{ $label }}</span>
    </div>
    @endforeach
    @if($birthdays->isEmpty())
      <div class="empty"><p>Sin cumpleaños próximos</p></div>
    @endif
  </div>
</div>

{{-- Recent absences --}}
<div class="card">
  <div class="card-title">🏖️ Ausencias recientes</div>
  @if($recentAbsences->isEmpty())
    <div class="empty"><p>Sin ausencias registradas</p></div>
  @else
  <div style="display:flex;flex-direction:column;gap:12px">
    @foreach($recentAbsences as $ab)
    <div style="background:var(--surface2);border-radius:10px;padding:14px;border:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap">
      <div>
        <div style="font-weight:700;font-size:14px;color:var(--text);margin-bottom:3px">{{ $ab->user->name }}</div>
        <div style="font-size:12.5px;color:var(--text2)">
          {{ $ab->type }} · {{ $ab->start_date->format('d/m/Y') }} @if($ab->start_date != $ab->end_date) → {{ $ab->end_date->format('d/m/Y') }} @endif
        </div>
      </div>
      @include('partials.status', ['status' => $ab->status])
    </div>
    @endforeach
  </div>
  @endif
</div>

@endsection
