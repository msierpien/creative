@props([
  'type' => null,
  'message' => null,
])

@php($class = match ($type) {
  'success' => 'text-green-50 bg-green',
  'caution' => 'text-yellow-50 bg-yellow',
  'warning' => 'text-red-50 bg-red',
  default => 'text-indigo-50 bg-g',
})

<div {{ $attributes->merge(['class' => "px-2 py-1 {$class}"]) }}>
  {!! $message ?? $slot !!}
</div>
