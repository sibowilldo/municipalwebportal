@if (count($breadcrumbs))
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !$loop->last)
            <li class="m-nav__separator">-</li>
            <li class="m-nav__item">
                <a href="{{ $breadcrumb->url }}" class="m-nav__link">
                    <span class="m-nav__link-text">{{ $breadcrumb->title }}</span>
                </a>
            </li>
        @else
            <li class="m-nav__separator">-</li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                    <span class="m-nav__link-text">{{ $breadcrumb->title }}</span>
                </a>
            </li>
        @endif
    @endforeach
@endif