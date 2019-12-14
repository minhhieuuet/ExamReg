<template>
  <div class="content">
    <div class="md-layout">
      <div class="md-layout-item md-medium-size-100 md-size-100 md-card">
        <h2 style="text-align: center">Thông tin sinh viên</h2>
        <ul>
          <li>Mã số sinh viên: {{user.name}}</li>
          <li>Email: {{user.email}}</li>
          <li>Tên: {{user.full_name}}</li>
        </ul>
        <md-button style="width: 100%;" @click="changePass">Đổi mật khẩu</md-button>


        <modal name="change-pass"
              height="auto"
              :scrollable="true"
              :click-to-close="true">
          <div class="content">
            <div slot="top-right">
              <md-button class="top-right md-icon-button md-accent" @click="$modal.hide('room')">
                <md-icon>close</md-icon>
              </md-button>
            </div>
            <span class="md-title">Đổi mật khẩu</span>

            <md-field>
              <label>Nhập mật khẩu cũ</label>
              <md-input type="password" v-model="oldPassword">
              </md-input>
            </md-field>
            <md-field>
              <label>Nhập mật khẩu mới</label>
              <md-input type="password" v-model="newPassword">
              </md-input>
            </md-field>
            <md-field>
              <label>Nhập lại mật khẩu mới</label>
              <md-input type="password" v-model="confirmPassword">
              </md-input>
            </md-field>

            </div>
          <div class="md-right">
            <md-button class="md-raised md-primary" @click="submit">Gửi</md-button>
            <md-button class="md-raised md-accent" @click="cancel">Bỏ qua</md-button>
          </div>
        </modal>
      </div>
    </div>
  </div>
</template>

<script>

import rf from '../../requests/RequestFactory';

export default{
  data () {
    return {
      tab: 1,
      oldPassword: '',
      newPassword: '',
      confirmPassword: '',
      user: {}
    }
  },
  methods: {
    changePass () {
      this.$modal.show('change-pass');
    },
    submit() {
      let params = {
        old_pass: this.oldPassword,
        new_pass: this.newPassword,
        confirm_pass: this.confirmPassword
      };
      rf.getRequest('UserRequest').changePassword(params).then(res => {
        if(res == 'ok') {
          this.cancel();
          this.$toasted.show('Đổi mật khẩu thành công!', {
            theme: 'bubble',
            position: 'top-right',
            duration : 2500,
            type: 'success'
          });
        }
      })
    },
    cancel () {
      this.$modal.hide('change-pass');
    }
  },
  created () {
    rf.getRequest('UserRequest').getCurrentUser().then(res => {
      this.user = res;
    });
  }
}
</script>
<style lang="scss" scoped>
.content {
  padding: 30px 30px 10px 30px;
}
.md-right {
  float: right;
  padding: 0px 10px 20px;
}
.top-right {
  float: right;
}
.red-outline {
  border: 1px solid red;
}
</style>
