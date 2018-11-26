<template>
    <div>
        <nav-bar></nav-bar>
        <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

                <!-- BEGIN: Subheader -->
                <div class="m-subheader ">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="m-subheader__title ">Dashboard</h3>
                        </div>
                        <div>
                            <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                                <span class="m-subheader__daterange-label">
                                    <span class="m-subheader__daterange-title"></span>
                                    <span class="m-subheader__daterange-date m--font-brand"></span>
                                </span>
                                <a href="#" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                    <i class="la la-angle-down"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- END: Subheader -->
                <div class="m-content">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import NavBar from '../../components/layouts/_navbar'

    export default {
        components: {
            NavBar
        },
        methods:{},
        mounted(){
            console.log('mounted')
        }
    }
</script>

<style>
    body{
        background: url('/assets/img/durban-beach.jpg');
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        z-index: -3;
    }
    body:after{
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right:0;
        background:rgba(58, 59, 145, .8);
        z-index: -1;
    }

</style>