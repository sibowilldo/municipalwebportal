@foreach($items as $item)
    <li class="m-menu__item m-menu__item--submenu m-menu__item--tabs {{ $item->active ? 'm-menu__item--active-tab ' : '' }}" m-menu-submenu-toggle="tab" aria-haspopup="true">
        <a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__link-text">{!! $item->title !!}</span>
            @if($item->hasChildren())
                <i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i>
            @endif
        </a>
        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
        @if($item->hasChildren())
            <ul class="m-menu__subnav">
                @include('vendor.laravel-menu.custom-menu-item-children', ['items' => $item->children()])
            </ul>
        @endif
        </div>
    </li>
@endforeach