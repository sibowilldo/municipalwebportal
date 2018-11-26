import VueRouter from 'vue-router'
import helper from './services/helper'

import Master from './components/layouts/master'
import Guest from './components/layouts/guest'
import Errors from './components/layouts/errors'

import Dashboard from './components/Dashboard'
import Login from './components/auth/Login'
import Email from './components/auth/passwords/Email'
import Reset from './components/auth/passwords/Reset'
import PageNotFound from './components/errors/page-not-found'

let routes = [
    {
        path: '/',
        component: Master,
        meta: { requiresAuth: true },
        children: [
            {
                path: '/',
                component: Dashboard
            },
            {
                path: '/dashboard',
                name: 'dashboard',
                component: Dashboard
            },

        ]
    },
    {
        path: '/',
        component: Guest,
        meta: { requiresGuest: true },
        children: [
            {
                path: '/',
                component: Login
            },
            {
                path: '/login',
                name: 'login',
                component: Login
            },
            {
                path: '/password/email',
                name: 'email',
                component: Email
            },
            {
                path: '/password/reset',
                name: 'reset',
                component: Reset
            },
        ]
    },
    {
        path: '*',
        component : Errors,
        children: [
            {
                path: '*',
                component: PageNotFound
            }
        ]
    }
];

const router = new VueRouter({
    linkActiveClass: 'active',
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {

    if (to.matched.some(m => m.meta.requiresAuth)){
        return helper.check().then(response => {
            if(!response){
                return next({ path : '/login'})
            }else{

            }

            return next()
        })
    }

    if (to.matched.some(m => m.meta.requiresGuest)){
        return helper.check().then(response => {
            if(response){
                return next({ path : '/dashboard'})
            }

            return next()
        })
    }

    return next()
});

export default router;
