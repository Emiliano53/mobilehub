@if (isset($breadcrumbs) && is_array($breadcrumbs))
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $label => $url)
                @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ is_array($label) ? 'Página actual' : $label }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ is_array($url) ? '#' : $url }}">
                            {{ is_array($label) ? 'Inicio' : $label }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif