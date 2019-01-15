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
                                <a href="/" class="m-brand__logo-wrapper">
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

                    <!-- begin::Topbar -->

                    <top-bar></top-bar>

                    <!-- end::Topbar -->
                </div>
            </div>
        </div>

        <tab-nav></tab-nav>
    </header>
    <!-- end::Header -->
</template>

<script>
    import TopBar from '../../components/layouts/_topbar'
    import TabNav from '../../components/layouts/_tabnav'
    export default {
        components : {
            TopBar, TabNav
        },
        name: "navbar"
    }
</script>

<style scoped>

</style>