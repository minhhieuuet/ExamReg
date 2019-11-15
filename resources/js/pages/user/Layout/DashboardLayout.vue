<template>
  <div class="wrapper">
    <notifications></notifications>

    <side-bar>
      <mobile-menu slot="content"></mobile-menu>

      <sidebar-link to="/dashboard">
        <md-icon>dashboard</md-icon>
        <p>Trang chủ</p>
      </sidebar-link>

      <sidebar-link to="/user">
        <md-icon>account_circle</md-icon>
        <p>Thông tin sinh viên</p>
      </sidebar-link>

    </side-bar>


    <div class="main-panel">
      <top-navbar></top-navbar>

      <dashboard-content>

      </dashboard-content>

      <content-footer v-if="!$route.meta.hideFooter"></content-footer>
    </div>
  </div>
</template>
<style lang="scss">

</style>
<script>
import TopNavbar from './TopNavbar.vue'
import ContentFooter from './ContentFooter.vue'
import DashboardContent from './Content.vue'
import MobileMenu from '@/pages/admin/Layout/MobileMenu.vue'

export default {
  components: {
    TopNavbar,
    DashboardContent,
    ContentFooter,
    MobileMenu
  }
}
</script>
