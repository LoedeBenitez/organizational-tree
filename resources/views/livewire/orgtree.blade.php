<ul>
    @foreach ($positions as $position)
        @if (!$position->parent)
            <li>
                {{ $position->position_name }}
                @if (count($position->children))
                    @include('livewire.children', ['children' => $position->children])
                @endif
            </li>
        @endif
    @endforeach
</ul>
