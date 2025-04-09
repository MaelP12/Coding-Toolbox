@props(['name'])

@error($name)
    <span class="text-sm">{{$message}}</span>
@enderror
