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
      children: [
        {
          path: '/',
          name: 'UserDashboard',
          component: UserDashboard,
          requiresAuth: true
        }
      ]
    },
    {
      path: '/admin',
      component: BasePage,
      children: [
        {
          path: '/',
          name: 'Dashboard',
          component: Dashboard,
          meta: {
            requiresAdmin: true
          },
        },
        {
          path: 'student',
          name: 'Student',
          component: StudentPage,
          meta: {
            requiresAdmin: true,
          },
        },
        { path: '*', name: '404', component: NotFound }
      ],
    },
  ],
};
