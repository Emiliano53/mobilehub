@if (isset($breadcrumbs) && is_array($breadcrumbs))
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $label => $url)
                @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{ $url }}">{{ $label }}</a></li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif