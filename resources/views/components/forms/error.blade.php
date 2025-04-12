@props(['name', 'bag' => 'default'])

@error($name, $bag)
<span class="text-sm text-red-500">{{ $message }}</span>
@enderror
