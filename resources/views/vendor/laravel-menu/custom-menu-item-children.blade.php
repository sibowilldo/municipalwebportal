@foreach($items as $item)
<li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
    <a href="{!! $item->url() !!}" class="m-menu__link "><i class="m-menu__link-icon "></i><span class="m-menu__link-text">{!! $item->title !!}</span></a>
</li>
@endforeach
