@if (count($breadcrumbs))
    @foreach ($breadcrumbs as $breadcrumb)
        @if($breadcrumb->url && !$loop->last)
            <span class="kt-subheader__breadcrumbs-separator"></span>
            <a href="{{ $breadcrumb->url }}" class="kt-subheader__breadcrumbs-link">
                {{ $breadcrumb->title }}</a>
        @else
            <span class="kt-subheader__breadcrumbs-separator"></span>
            <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{ $breadcrumb->title }}</span>
        @endif
    @endforeach
@endif
