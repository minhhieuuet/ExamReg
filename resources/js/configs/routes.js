import BasePage from '../pages/BasePage.vue';
import LoginPage from '../pages/LoginPage.vue';
import Dashboard from '../pages/Dashboard.vue';

import NotFound from '../pages/errors/404.vue';

export default {
  mode: 'history',
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: LoginPage,
      meta: {
        requiresGuest: true,
      },
    },
    {
      path: '/',
      component: BasePage,
      children: [
        {
          path: '/',
          name: 'Dashboard',
          component: Dashboard,
        },
        { path: '*', name: '404', component: NotFound }
      ],
    },
  ],
};
