@foreach($items as $item)

    <li class="m-menu__item {{ $item->active ? 'm-menu__item--active ' : '' }}" aria-haspopup="true">
        <a href="{!! $item->url() !!}" class="m-menu__link ">
            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                <span></span>
            </i>
            <span class="m-menu__link-text">{!! $item->title !!}</span>
        </a>
    </li>
@endforeach
