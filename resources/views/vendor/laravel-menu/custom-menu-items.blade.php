@foreach($items as $item)
        @if($item->hasChildren())
        <li class="m-menu__item  m-menu__item--submenu  {{ $item->active ? 'm-menu__item--open m-menu__item--expanded ' : '' }}" aria-haspopup="true" m-menu-submenu-toggle="hover">
            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon {{ $item->icon }}"></i>

                <span class="m-menu__link-text">{!! $item->title !!}</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    @include('vendor.laravel-menu.custom-menu-item-children', ['items' => $item->children()])
                </ul>
            </div>

        </li>
        @else
        <li class="m-menu__item  {{ $item->active ? 'm-menu__item--active ' : '' }}" aria-haspopup="true">
            <a href="{!! $item->url() !!}" class="m-menu__link ">
                <i class="m-menu__link-icon {{ $item->icon }}"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{!! $item->title !!}</span>
                    </span>
                </span>
            </a>
        </li>
        @endif
@endforeach