@props(['trigger'])
{{--    auth jan-Pieter
        standaard dropdown component
--}}
<div x-data="{show: false}" @click.away="show = false" class=" relative">
    {{-- trigger --}}
    <div @click="show = ! show">

    {{$trigger}}

    </div>

    {{-- links --}}
    <div x-show="show" class="py-2 z-50 absolute bg-gray-100 w-full mt-2 rounded-xl overflow-auto max-h-52" style="display: none">
        {{$slot}}
    </div>
</div>
