<template>
    <!-- begin::Header -->
    <header id="m_header" class="m-grid__item m-header" m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="10" m-minimize-mobile-offset="10">
        <div class="m-header__top">
            <div class="m-container m-container--fluid m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">

                    <!-- begin::Brand -->
                    <div class="m-stack__item m-brand m-stack__item--left">
                        <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="index.html" class="m-brand__logo-wrapper">
                                    <img alt="" src="assets/demo/media/img/logo/logo.png" class="m-brand__logo-default" />
                                    <img alt="" src="assets/demo/media/img/logo/logo_inverse.png" class="m-brand__logo-inverse" />
                                </a>
                            </div>
                            <div class="m-stack__item m-stack__item--middle m-brand__tools">

                                <!-- begin::Responsive Header Menu Toggler-->
                                <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                    <span></span>
                                </a>

                                <!-- end::Responsive Header Menu Toggler-->

                                <!-- begin::Topbar Toggler-->
                                <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                    <i class="flaticon-more"></i>
                                </a>

                                <!--end::Topbar Toggler-->
                            </div>
                        </div>
                    </div>

                    <!-- end::Brand -->

                    <!--begin::Search-->
                    <div class="m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable- m-header-search--skin-"
                         id="m_quicksearch" m-quicksearch-mode="default">

                        <!--begin::Search Form -->
                        <form class="m-header-search__form">
                            <div class="m-header-search__wrapper">
										<span class="m-header-search__icon-search" id="m_quicksearch_search">
											<i class="la la-search"></i>
										</span>
                                <span class="m-header-search__input-wrapper">
											<input autocomplete="off" type="text" name="q" class="m-header-search__input" value="" placeholder="Search..." id="m_quicksearch_input">
										</span>
                                <span class="m-header-search__icon-close" id="m_quicksearch_close">
											<i class="la la-remove"></i>
										</span>
                                <span class="m-header-search__icon-cancel" id="m_quicksearch_cancel">
											<i class="la la-remove"></i>
										</span>
                            </div>
                        </form>

                        <!--end::Search Form -->

                        <!--begin::Search Results -->
                        <div class="m-dropdown__wrapper">
                            <div class="m-dropdown__arrow m-dropdown__arrow--center"></div>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__body">
                                    <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">
                                        <div class="m-dropdown__content m-list-search m-list-search--skin-light">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end::Search Results -->
                    </div>

                    <!--end::Search-->

                    <!-- begin::Topbar -->

                    <top-bar></top-bar>

                    <!-- end::Topbar -->
                </div>
            </div>
        </div>

        <navbar-bottom></navbar-bottom>
    </header>
    <!-- end::Header -->
</template>

<script>
    import TopBar from '../../components/layouts/_topbar'
    import NavbarBottom from '../../components/layouts/_navbarbottom'
    export default {
        components : {
            TopBar, NavbarBottom
        },
        name: "navbar"
    }
</script>

<style scoped>

</style>