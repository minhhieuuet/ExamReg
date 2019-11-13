import DashboardLayout from '@/pages/Layout/DashboardLayout.vue'
import Login from '@/pages/LoginPage.vue';
import Dashboard from '@/pages/Dashboard.vue'
import UserProfile from '@/pages/UserProfile.vue'
import TableList from '@/pages/TableList.vue'
import Typography from '@/pages/Typography.vue'
import Icons from '@/pages/Icons.vue'
import Notifications from '@/pages/Notifications.vue'

export default {
  mode: 'history',
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/admin',
      component: DashboardLayout,
      redirect: '/admin/dashboard',
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
        {
          path: 'user',
          name: 'User Profile',
          component: UserProfile
        },
        {
          path: 'table',
          name: 'Table List',
          component: TableList
        },
        {
          path: 'typography',
          name: 'Typography',
          component: Typography
        },
        {
          path: 'icons',
          name: 'Icons',
          component: Icons
        },
        {
          path: 'notifications',
          name: 'Notifications',
          component: Notifications
        }
      ]
    }
  ]
}
