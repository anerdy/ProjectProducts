import Main from './components/Main.vue';
import Add from './components/Add.vue';
import Edit from './components/Edit.vue';

export const routes = [
    {
        path:'/',
        component:Main
    },
    {
        path:'/add',
        component:Add
    },
    {
        path:'/edit/:product_id',
        component:Edit
    }

];