import Vue from 'vue';
import VueRouter from 'vue-router';

import Calendar from './pages/Calendar.vue';
import Memo from './pages/Memo.vue';
import Task from './pages/Task.vue';


Vue.use(VueRouter);

const routes = [
    {
        path: '/calendar',
        name: 'calendar',
        component: Calendar
    },
    {
        path: '/calendar/memo',
        name: 'memo',
        component: Memo
    },
    {
        path: '/calendar/task',
        name: 'task',
        component: Task

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