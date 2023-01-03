import Vue from 'vue';
import VueRouter from 'vue-router';

import Welcome from './pages/Welcome.vue';
import Calendar from './pages/Calendar.vue';


Vue.use(VueRouter);

const routes = [
    {
        path: '/calendar/welcome',
        name: 'welcome',
        component: Welcome
    },
    {
        path: '/calendar',
        component: Calendar
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;

// export default new VueRouter({
//     mode: 'history',
//     routes: [
//         {
//             path: '/calendar/welcome',
//             name: 'welcome',
//             component: Welcome
//         },
//         {
//             path: '/caledar/about',
//             name: 'calendar',
//             component: Calendar
//         }
//         ]
// })