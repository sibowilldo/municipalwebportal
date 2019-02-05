<template>
    <div>
        <div class="m-header__bottom">
            <div class="m-container m-container--fluid m-container--full-height m-page__container">
                <div class="m-stack m-stack--ver m-stack--desktop">

                    <!-- begin::Horizontal Menu -->
                    <div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
                        <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                        <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                            <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                <router-link :to="{ path: '/dashboard'}" tag="li" replace active-class="m-menu__item--hover" class="m-menu__item  m-menu__item--submenu m-menu__item--tabs">
                                    <a href="" class="m-menu__link m-menu__toggle">
                                        <span class="m-menu__link-text">Dashboard</span><i
                                            class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            <!--<li class="m-menu__item " aria-haspopup="true"><a href="javascript:;" class="m-menu__link "><i class="m-menu__link-icon flaticon-support"></i><span class="m-menu__link-text">Dashboard</span></a></li>-->
                                            <!--<li class="m-menu__item  m-menu__item&#45;&#45;active " aria-haspopup="true"><a href="index.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-file"></i><span class="m-menu__link-text">Reports</span></a></li>-->
                                            <li class="m-menu__item  m-menu__item--actions" aria-haspopup="true">
                                                <div class="m-menu__link m-menu__link--toggle-skip">
                                                    <el-button type="primary" icon="la la-plus" round @click="showIncidentForm = true">
                                                        Log Incident
                                                    </el-button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </router-link>
                                <router-link :to="{ path: '/users'}" tag="li" replace active-class="m-menu__item--hover" class="m-menu__item  m-menu__item--submenu m-menu__item--tabs">
                                    <a href="" class="m-menu__link m-menu__toggle">
                                        <span class="m-menu__link-text">Users</span><i
                                            class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-settings-1"></i><span class="m-menu__link-text">Build Tools</span></a></li>
                                            <li class="m-menu__item " aria-haspopup="true"><a href="builder.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-imac"></i><span class="m-menu__link-text">Layout Builder</span></a></li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-paper-plane"></i><span class="m-menu__link-text">Documentatiion</span></a></li>
                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner2.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-multimedia"></i><span class="m-menu__link-text">Reviews</span></a></li>
                                        </ul>
                                    </div>
                                </router-link>
                                <router-link :to="{ path: '/system'}" tag="li" replace active-class="m-menu__item--hover" class="m-menu__item  m-menu__item--submenu m-menu__item--tabs">
                                    <a href="" class="m-menu__link m-menu__toggle">
                                        <span class="m-menu__link-text">System</span><i
                                            class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            <li class="m-menu__item "><a href="#" class="m-menu__link "><i class="m-menu__link-icon flaticon-settings-1"></i><span class="m-menu__link-text">Incident Categories</span></a></li>
                                            <li class="m-menu__item "><a href="#" class="m-menu__link "><i class="m-menu__link-icon flaticon-imac"></i><span class="m-menu__link-text">Incident Types</span></a></li>
                                        </ul>
                                    </div>
                                </router-link>
                            </ul>
                        </div>
                    </div>

                    <!-- end::Horizontal Menu -->
                </div>
            </div>
        </div>

        <el-dialog title="Report New Incident" :visible.sync="showIncidentForm">
            <add-incident-form :dialog-state="showIncidentForm" @close="closeDialog"></add-incident-form>

            <span slot="form_actions">
            </span>
        </el-dialog>
    </div>
</template>

<script>
    import AddIncidentForm from '../forms/_add-incident-form'

    export default {
        components:{AddIncidentForm},
        name: "navbarbottom",
        data() {
            return {
                showIncidentForm: false
            }
        },
        methods:{
            closeDialog(){
                this.showIncidentForm = false
            }
        }
    }
</script>

<style scoped>

</style>