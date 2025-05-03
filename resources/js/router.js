import {createWebHistory, createRouter } from 'vue-router';
import UserRegistrationComponent from '../views/components/UserRegistrationComponent.vue';
import LoginComponent from '../views/components/LoginComponent.vue';
import BoardListComponent from '../views/components/BoardListComponent.vue';


const routes=[
	// path : '경로이름'
	// ,component : '컴포넌트이름'
	{
		path: '/',
		redirect: '/login',
	},
	{
		path: '/login',
		component: LoginComponent,
	},
	{
		path: '/registration',
		component: UserRegistrationComponent,
	},
	{
		path: '/boards',
		component: BoardListComponent,
	},
];

const router = createRouter({
	history: createWebHistory()
	,routes
});

export default router;