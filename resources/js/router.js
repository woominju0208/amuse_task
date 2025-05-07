import {createWebHistory, createRouter } from 'vue-router';
import UserRegistrationComponent from '../views/components/UserRegistrationComponent.vue';
import LoginComponent from '../views/components/LoginComponent.vue';
import BoardListComponent from '../views/components/BoardListComponent.vue';
import UsersComponent from '../views/components/UsersComponent.vue';
import BoardCreateComponent from '../views/components/BoardCreateComponent.vue';
import BoardDetailComponent from '../views/components/BoardDetailComponent.vue';
import TaskCreateComponent from '../views/components/TaskCreateComponent .vue';
import BoardModifyComponent from '../views/components/BoardModifyComponent.vue';


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
		path: '/register',
		component: UserRegistrationComponent,
	},
	{
		path: '/boards',
		component: BoardListComponent,
	},

	{
		path: '/boards/:id',
		component: BoardDetailComponent,
	},
	{
		path: '/boards/store',
		component: BoardCreateComponent,
	},
	{
		path: '/users',
		component: UsersComponent,
	},
	{
		path: '/boards/:id/task',
		component: TaskCreateComponent,
	},
	// 프로젝트 수정
	{
		path: '/boards/:id/modify',
		component: BoardModifyComponent,
	},
];

const router = createRouter({
	history: createWebHistory()
	,routes
});

export default router;