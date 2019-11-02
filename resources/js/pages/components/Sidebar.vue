<template>
  <div>
    <md-toolbar class="md-transparent" md-elevation="0">
      Navigation
    </md-toolbar>

    <md-list>
      <md-list-item v-for="(item, index) in listMenu" :key="index" @click="redirect(item.link)">
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
      listMenu: [
        {
          text: 'Trang chủ',
          icon: 'dashboard',
          link: '/'
        },
        {
          text: 'Sinh viên',
          icon: 'school',
          link: '/student'
        },
        {
          text: 'Phòng máy',
          icon: 'computer',
          link: '/student'
        },
        {
          text: 'Học phần',
          icon: 'book',
          link: '/student'
        },
        {
          text: 'Kì thi',
          icon: 'school',
          link: '/student'
        },
        {
          text: 'Ca thi',
          icon: 'school',
          link: '/student'
        },
      ]
    }
  },
  methods: {
    redirect: function (link) {
      this.$router.push({ path: link });
    },
  }
}
</script>

<style lang="scss" scoped >
// Demo purposes only
.md-drawer {
 width: 230px;
 max-width: calc(100vw - 125px);
}
</style>
