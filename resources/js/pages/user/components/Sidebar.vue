<template>
  <div>
    <md-toolbar class="md-transparent" md-elevation="0">
      Navigation
    </md-toolbar>

    <md-list>
      <md-list-item v-for="(item, index) in listMenu" :key="index" :class="{'active': activeTab == item.link}" @click="redirect(item.link)">
        <md-icon>{{item.icon}}</md-icon>
        <span class="md-list-item-text">{{item.text}}</span>
      </md-list-item>
    </md-list>
  </div>
</template>

<script>
export default {
  name: "Sidebar",
  data () {
    return {
      activeTab: '/',
      listMenu: [
        {
          text: 'Trang chủ',
          icon: 'dashboard',
          link: '/admin'
        },
        {
          text: 'Sinh viên',
          icon: 'school',
          link: '/admin/student'
        },
        {
          text: 'Phòng máy',
          icon: 'computer',
          link: '/admin/computer'
        },
        {
          text: 'Học phần',
          icon: 'book',
          link: '/admin/module'
        },
        {
          text: 'Kì thi',
          icon: 'school',
          link: '/admin/exam'
        },
        {
          text: 'Ca thi',
          icon: 'school',
          link: '/admin/exam-session'
        },
      ]
    }
  },
  methods: {
    redirect: function (link) {
      this.$router.push({ path: link });
    },
  },
  watch: {
    '$route' (to, from) {
      this.activeTab = this.$router.currentRoute.path;
    }
  },
  mounted: function () {
    this.activeTab = this.$router.currentRoute.path;
  }
}
</script>

<style lang="scss" scoped >
// Demo purposes only
.active {
  background-color: #ccdae6;
}
.md-drawer {
 width: 230px;
 max-width: calc(100vw - 125px);
}
</style>
