<template>
  <div id="main-content">
    <h1>BasePage</h1>
    <Sidebar/>
    <router-view></router-view>
  </div>
</template>

<script>
import Sidebar from './components/Sidebar.vue';
export default {
  components: {
      Sidebar
  },
  name: "BasePage"
}
</script>

<style lang="css" scoped >
  #main-content {
    border: 2px solid red;
    height: 600px;
  }
</style>
