<ul>
    @foreach ($children as $child)
        <li>
            {{ $child->position_name }}
            @if (count($child->children))
                @include('livewire.children', ['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
