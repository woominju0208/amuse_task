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
		path: '/boards/:id(\\d+)',
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

	// 없는 경로 출력x
	{
		path: '/:catchAll(.*)',
		name: 'NotFound',
		component: null,
	},
];

const router = createRouter({
	history: createWebHistory()
	,routes
});

router.beforeEach((to, from, next) => {
	if (to.name === 'NotFound') {
	  alert('존재하지 않는 페이지입니다.');
	  next('/');
	} else {
	  next();
	}
  });

export default router;