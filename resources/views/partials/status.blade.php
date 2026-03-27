@php
$map = [
  'pendiente'  => ['tag-amber','⏳ Pendiente'],
  'confirmada' => ['tag-green','✅ Confirmada'],
  'aprobada'   => ['tag-green','✅ Aprobada'],
  'rechazada'  => ['tag-red','❌ Rechazada'],
  'cancelada'  => ['tag-red','🚫 Cancelada'],
];
$cls   = $map[$status][0] ?? 'tag-grey';
$label = $map[$status][1] ?? ucfirst($status);
@endphp
<span class="tag {{ $cls }}">{{ $label }}</span>
