<template>
    <li class="m-nav__item m-topbar__user-profile m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click" aria-expanded="true">
        <a href="#" class="m-nav__link m-dropdown__toggle">
            <span class="m-topbar__userpic">
                <span class="m-nav__link-icon"><span class="m-nav__link-icon-wrapper"><i class="flaticon-avatar"></i></span></span>
            </span>
            <span class="m-nav__link-icon m-topbar__usericon  m--hide">
                <span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>
            </span>
            <span class="m-topbar__username m--hide">Nick</span>
        </a>
        <div class="m-dropdown__wrapper" style="z-index: 101;">
            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 6px;"></span>
            <div class="m-dropdown__inner">
                <div class="m-dropdown__header m--align-center">
                    <div class="m-card-user m-card-user--skin-light">
                        <div class="m-card-user__pic">
                            <span class="m-nav__link-icon"><span class="m-nav__link-icon-wrapper"><i class="flaticon-avatar"></i></span></span>
                        </div>
                        <div class="m-card-user__details">
                            <span class="m-card-user__name m--font-weight-500">{{this.user.firstname}} {{this.user.lastname}}</span>
                            <a href="" class="m-card-user__email m--font-weight-300 m-link">{{ this.user.email }}</a>
                        </div>
                    </div>
                </div>
                <div class="m-dropdown__body">
                    <div class="m-dropdown__content">
                        <ul class="m-nav m-nav--skin-light">
                            <li class="m-nav__section m--hide">
                                <span class="m-nav__section-text">Section</span>
                            </li>
                            <li class="m-nav__item">
                                <a href="profile.html" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-profile-1"></i>
                                    <span class="m-nav__link-title">
																				<span class="m-nav__link-wrap">
																					<span class="m-nav__link-text">My Profile</span>
																					<span class="m-nav__link-badge"><span class="m-badge m-badge--success">2</span></span>
																				</span>
																			</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="profile.html" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-share"></i>
                                    <span class="m-nav__link-text">Activity</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="profile.html" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                                    <span class="m-nav__link-text">Messages</span>
                                </a>
                            </li>
                            <li class="m-nav__separator m-nav__separator--fit">
                            </li>
                            <li class="m-nav__item">
                                <a href="profile.html" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-info"></i>
                                    <span class="m-nav__link-text">FAQ</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="profile.html" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                    <span class="m-nav__link-text">Support</span>
                                </a>
                            </li>
                            <li class="m-nav__separator m-nav__separator--fit">
                            </li>
                            <li class="m-nav__item">
                                <a href="#" @click.prevent="logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    import helper from '../../../services/helper'

    export default {
        name: "user-profile",
        data() {
            return{
                user: {
                    firstname:'',
                    lastname: '',
                    email:'',
                    contactnumber:'',
                    roles:[]
                }
            }

        },
        created(){
            axios.get('api/auth/user').then(response => response.data).then(
                response => {
                    this.user.firstname = response.data.firstname,
                    this.user.lastname = response.data.lastname,
                    this.user.email = response.data.email,
                    this.user.contactnumber = response.data.contactnumber,
                    this.user.roles = response.data.roles
                }
            )
        },
        methods:{
            logout(){
                helper.logout().then(()=>{
                    this.$router.replace('/login')
                })
            },
            getAuthUserFullName(){
                return this.$store.getters.getAuthUserFullName;
            },
            getAuthUser(name){
                return this.$store.getters.getAuthUser(name);
            }
        }
    }
</script>

<style scoped>

</style>