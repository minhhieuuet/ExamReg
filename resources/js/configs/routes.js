import Login from '@/pages/LoginPage.vue';

import AdminDashboardLayout from '@/pages/admin/Layout/DashboardLayout.vue'
import AdminDashboard from '@/pages/admin/Dashboard.vue';
import AdminStudent from '@/pages/admin/Student.vue';

import UserDashboardLayout from '@/pages/user/Layout/DashboardLayout.vue'
import UserDashboard from '@/pages/user/Dashboard.vue';
import UserProfile from '@/pages/user/UserProfile.vue';
import UserTableList from '@/pages/user/TableList.vue';

export default {
  mode: 'history',
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path : '/',
      component: UserDashboardLayout,
      redirect: '/dashboard',
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: UserDashboard,
          meta: {
            requiresAuth: true
          }
        },
        {
          path: 'user',
          name: 'User Profile',
          component: UserProfile,
          meta: {
            requiresAuth: true
          }
        },
        {
          path: 'table',
          name: 'Table List',
          component: UserTableList,
          meta: {
            requiresAuth: true
          }
        },
      ]
    },
    {
      path: '/admin',
      component: AdminDashboardLayout,
      redirect: '/admin/dashboard',
      children: [
        {
          path: 'dashboard',
          name: 'Trang chủ',
          component: AdminDashboard,
          meta: {
            requiresAdmin: true
          }
        },
        {
          path: 'student',
          name: 'Sinh viên',
          component: AdminStudent,
          meta: {
            requiresAdmin: true
          }
        },
      ]
    }
  ]
}
