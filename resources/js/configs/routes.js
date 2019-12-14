import Login from '@/pages/LoginPage.vue';

import AdminDashboardLayout from '@/pages/admin/Layout/DashboardLayout.vue'
import AdminDashboard from '@/pages/admin/Dashboard.vue';
import AdminStudent from '@/pages/admin/Student.vue';
import AdminExamSession from '@/pages/admin/ExamSession.vue';
import AdminUniversity from '@/pages/admin/University.vue';
import AdminRoom from '@/pages/admin/Room.vue';
import AdminModule from '@/pages/admin/Module.vue';
import AdminTestRoom from '@/pages/admin/TestRoom.vue';
import AdminExam from '@/pages/admin/Exam.vue';

import UserDashboardLayout from '@/pages/user/Layout/DashboardLayout.vue'
import UserDashboard from '@/pages/user/Dashboard.vue';
import UserProfile from '@/pages/user/UserProfile.vue';
import UserViewRegisted from '@/pages/user/ViewRegisted.vue';
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
          path: '/registed-sessions',
          name: 'Xem và in',
          component: UserViewRegisted,
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
        {
          path: 'exam-session',
          name: 'Ca thi',
          component: AdminExamSession,
          meta: {
            requiresAdmin: true
          }
        },
        {
          path: 'university',
          name: 'Trường',
          component: AdminUniversity,
          meta: {
            requiresAdmin: true
          }
        },
        {
          path: 'room',
          name: 'Phòng máy',
          component: AdminRoom,
          meta: {
            requiresAdmin: true
          }
        },
        {
          path: 'module',
          name: 'Học phần',
          component: AdminModule,
          meta: {
            requiresAdmin: true
          }
        },
        {
          path: 'test-room',
          name: 'Phòng thi',
          component: AdminTestRoom,
          meta: {
            requiresAdmin: true
          }
        },
        {
          path: 'exam',
          name: 'Kỳ thi',
          component: AdminExam,
          meta: {
            requiresAdmin: true
          }
        }
      ]
    }
  ]
}
