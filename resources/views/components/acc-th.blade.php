@props(['orderby', 'order', 'field'])

<th x-data
    @if(!str_contains($field, '.'))
        x-on:click="$wire.changeOrder('{{$field}}')"
    @endif
    style="cursor: pointer">
    @if($orderby == $field)
        @if($order == 'asc')
            <i class="fa fa-sort-amount-down"></i>
        @else
            <i class="fa fa-sort-amount-up"></i>
        @endif
    @endif
    {{ $slot->isEmpty() ? 'th' : $slot }}
</th>

