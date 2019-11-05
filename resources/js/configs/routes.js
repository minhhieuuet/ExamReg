import LoginPage from '../pages/LoginPage.vue';

import BasePage from '../pages/admin/BasePage.vue';
import Dashboard from '../pages/admin/Dashboard.vue';
import StudentPage from '../pages/admin/Student.vue';

import BaseUserPage from '../pages/user/BaseUserPage.vue';
import UserDashboard from '../pages/user/Dashboard.vue';

import NotFound from '../pages/errors/404.vue';

export default {
  mode: 'history',
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: LoginPage,
    },
    {
      path: '/',
      component: BaseUserPage,
      meta: {
        requiresAuth: true
      },
      children: [
        {
          path: '/',
          name: 'UserDashboard',
          component: UserDashboard,
        }
      ]
    },
    {
      path: '/admin',
      component: BasePage,
      meta: {
        requiresAdmin: true,
      },
      children: [
        {
          path: '/',
          name: 'Dashboard',
          component: Dashboard,
        },
        {
          path: 'student',
          name: 'Student',
          component: StudentPage,
        },
        { path: '*', name: '404', component: NotFound }
      ],
    },
  ],
};
