<div class="m-container m-container--fluid m-container--full-height m-page__container">
    <div class="m-stack m-stack--ver m-stack--desktop">

        <!-- begin::Horizontal Menu -->
        <div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
            <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
            <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                    @include('vendor.laravel-menu.custom-menu-items', ['items' => $MHeaderBottom->roots()])
                </ul>
            </div>
        </div>
        <!-- end::Horizontal Menu -->
    </div>
</div>