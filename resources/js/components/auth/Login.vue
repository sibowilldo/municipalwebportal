<template>
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
            <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                <div class="m-stack m-stack--hor m-stack--desktop">
                    <div class="m-stack__item m-stack__item--fluid">
                        <div class="m-login__wrapper">

                            <div class="m-login__logo">
                                <a href="#">
                                    <img src="assets/img/ethekwini-logo.jpg" alt="eThekwini Municipality">
                                </a>
                            </div>

                            <div class="m-login__signin">
                                <div class="m-login__head">
                                    <h3 class="m-login__title">Sign In To Dashboard</h3>
                                </div>
                                <form class="m-login__form m-form" @submit.prevent="submit">
                                    <div class="form-group m-form__group">
                                        <input class="form-control m-input" type="text" placeholder="Email" v-model="loginForm.email" autocomplete="off">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" v-model="loginForm.password">
                                    </div>
                                    <div class="row m-login__form-sub">
                                        <div class="col m--align-left">
                                            <label class="m-checkbox m-checkbox--focus">
                                                <input type="checkbox" name="remember" v-model="loginForm.remember_me" false-value="false" true-value="true"> Remember me
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="m-login__form-action">
                                        <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air" type="submit">Sign In</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content m-grid-item--center" style="background-image: url('/assets/img/durban-beach.jpg')">
                <div class="m-grid__item">
                    <h3 class="m-login__welcome">eThekwini Municipality</h3>
                    <p class="m-login__msg">

                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data(){
            return {
                loginForm:{
                    email : "",
                    password : "",
                    remember_me: false
                }
            }
        },
        methods: {
            submit(e){
                if (this.loginForm.password.length > 0) {
                    this.loginForm.remember_me === "true" ? this.loginForm.remember_me = true : this.loginForm.remember_me = false;
                    axios.post('api/auth/login', this.loginForm).then(response =>  {
                        localStorage.setItem('auth_token',response.data.access_token);
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('auth_token');
                        if (localStorage.getItem('auth_token') != null){
                            this.$notify({
                                title: 'Success',
                                message: 'Signed in successfully.',
                                type: 'success'
                            })
                            this.$router.push({ path: '/dashboard'})
                        }
                    }).catch(error => {

                        this.$notify({
                            title: 'Error',
                            message: error.response.data.message,
                            type: 'error'
                        })
                    });
                }
            }
        }
    }
</script>

<style scoped>
    .m-page{
        height: 100vh;
    }
    .m-login__content:after{
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right:0;
        background:rgba(58, 59, 145, .8);
    }
    .m-login__content{
        position: relative;
    }
    .m-login__content > div{
        position: relative;
        z-index: 1;
    }
    .m-login__logo img{width: 50%}
</style>