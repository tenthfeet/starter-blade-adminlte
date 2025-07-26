@props(['links' => []])

<ol class="breadcrumb float-sm-end">
    <li class="breadcrumb-item">
        @if (empty($links))
            Home
        @else
            <a href="{{ url('/') }}">Home</a>
        @endif
    </li>
    @foreach ($links as $link)
        <li class="breadcrumb-item {{ !$loop->last ? '' : 'active' }}" {{ $loop->last ? 'aria-current=page' : '' }}>
            @if (!empty($link['url']) && !$loop->last)
                <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
            @else
                {{ $link['label'] }}
            @endif
        </li>
    @endforeach
</ol>
