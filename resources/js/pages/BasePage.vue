<template>
  <div class="page-container">
    <md-app style="min-height: 100vh;" md-waterfall md-mode="overlap">
      <md-app-toolbar class="md-primary md-large">
        <div v-if="$isAuthenticated" class="md-toolbar-row">
          <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
            <md-icon>menu</md-icon>
          </md-button>

          <span class="md-title">Exam Reg</span>
        </div>
      </md-app-toolbar>

      <md-app-drawer v-if="$isAuthenticated" :md-active.sync="menuVisible">
        <md-toolbar class="md-transparent" md-elevation="0">
          Navigation
        </md-toolbar>

        <md-list>
          <md-list-item>
            <md-icon>move_to_inbox</md-icon>
            <span class="md-list-item-text">Inbox</span>
          </md-list-item>

          <md-list-item>
            <md-icon>send</md-icon>
            <span class="md-list-item-text">Sent Mail</span>
          </md-list-item>

          <md-list-item>
            <md-icon>delete</md-icon>
            <span class="md-list-item-text">Trash</span>
          </md-list-item>

          <md-list-item>
            <md-icon>error</md-icon>
            <span class="md-list-item-text">Spam</span>
          </md-list-item>

          <md-list-item @click="logout">
            <md-icon>logout</md-icon>
            <span class="md-list-item-text" >Logout</span>
          </md-list-item>
        </md-list>
      </md-app-drawer>

      <md-app-content>
        <router-view></router-view>
      </md-app-content>
    </md-app>
  </div>
</template>

<script>
import AuthenticationUtils from '../common/AuthenticationUtils';

export default {
    name: 'Overlap',
    data: () => ({
      menuVisible: false
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
  .md-drawer {
    width: 230px;
    max-width: calc(100vw - 125px);
  }
</style>
