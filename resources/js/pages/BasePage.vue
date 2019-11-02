<template>
  <div class="page-container">
    <md-app md-waterfall md-mode="fixed" style="min-height: 100vh;">
      <md-app-toolbar class="md-primary md-size-70 md-medium">
        <div class="md-layout-item">
          <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
            <md-icon class="md-large">menu</md-icon>
          </md-button>
        </div>
        <div class="md-layout-item md-size-70"></div>
        <div class="md-layout-item">
          <md-menu  md-align-trigger>

            <md-button class="md-fab" md-icon-button md-menu-trigger>
              <md-icon >notification_important</md-icon>
            </md-button>

              <md-menu-content>
                <md-menu-item>My Item 1</md-menu-item>
                <md-menu-item>My Item 2</md-menu-item>
                <md-menu-item>My Item 3</md-menu-item>
              </md-menu-content>
          </md-menu>

          <md-menu  md-align-trigger>
            <md-button class="md-fab md-primary" md-icon-button md-menu-trigger>
              <md-icon>person</md-icon>
            </md-button>

              <md-menu-content>
                <md-menu-item>Profile</md-menu-item>
                <md-menu-item>Change Password</md-menu-item>
                <md-menu-item @click="logout">
                  <div class="">
                    <md-icon>logout</md-icon>
                    Logout
                  </div>
                </md-menu-item>
              </md-menu-content>
          </md-menu>
        </div>
      </md-app-toolbar>

      <md-app-drawer md-permanent="full" v-show="menuVisible">
        <Sidebar/>
      </md-app-drawer>

      <md-app-content>
        <router-view></router-view>
      </md-app-content>
    </md-app>
  </div>
</template>

<script>
import AuthenticationUtils from '../common/AuthenticationUtils';
import Sidebar from './components/Sidebar.vue';
export default {
    name: 'Overlap',
    components: {
      Sidebar
    },
    data: () => ({
      menuVisible: true
    }),
    methods: {
      logout () {
        AuthenticationUtils.logout();
        this.$router.push({ path: '/login' });
      },
    }
};
</script>

<style lang="scss" scoped>
  .md-app {
    max-height: 400px;
    border: 1px solid rgba(#000, .12);
  }

   // Demo purposes only
   .md-app {
     max-height: 400px;
     border: 1px solid rgba(#000, .12);
   }

    // Demo purposes only
   .md-drawer {
     width: 230px;
     max-width: calc(100vw - 125px);
   }

</style>
