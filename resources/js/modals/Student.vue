<template>
  <modal name="student"
      height="auto"
      :scrollable="true"
      :click-to-close="true"
      @before-open="beforeOpen"
      @before-close="beforeClose"
      >

        <div class="content">
          <div slot="top-right">
            <md-button class="top-right md-icon-button md-accent" @click="$modal.hide('student')">
              <md-icon>close</md-icon>
            </md-button>
          </div>
          <span class="md-title">{{title}}</span>

          <md-field>
            <label>Họ và tên</label>
            <md-input type="text"
                      :name="`${_uid}_name`"
                      data-vv-validate-on="none"
                      data-vv-as="name"
                      v-validate="'required|max:30'"
                      data-vv-scope="general"
                      v-model="student.full_name"
                      :class="errors.has(`general.${_uid}_name`) ? 'is-invalid' : ''"
                      md-counter="30">
            </md-input>
            <div v-if="errors.has(`general.${_uid}_name`)">
              <md-icon class="md-accent">warning</md-icon>
              {{errors.first(`general.${_uid}_name`)}}
            </div>
          </md-field>

          <md-field>
            <label>Tài khoản</label>
            <md-input type="text"
                      :name="`${_uid}_username`"
                      data-vv-validate-on="none"
                      data-vv-as="username"
                      v-validate="'required|min:6|max:30'"
                      data-vv-scope="general"
                      v-model="student.name"
                      :class="errors.has(`general.${_uid}_username`) ? 'is-invalid' : ''"
                      md-counter="30">
           </md-input>
           <div v-if="errors.has(`general.${_uid}_username`)">
             <md-icon class="md-accent">warning</md-icon>
             {{errors.first(`general.${_uid}_username`)}}
           </div>
          </md-field>

          <md-field>
            <label>Email</label>
            <md-input  type="text"
                      :name="`${_uid}_email`"
                      data-vv-validate-on="none"
                      data-vv-as="email"
                      v-validate="'required|email'"
                      data-vv-scope="general"
                      v-model="student.email"
                      :class="errors.has(`general.${_uid}_email`) ? 'is-invalid' : ''">
            </md-input>
            <div v-if="errors.has(`general.${_uid}_email`)">
              <md-icon class="md-accent">warning</md-icon>
              {{errors.first(`general.${_uid}_email`)}}
            </div>
          </md-field>

          <md-checkbox v-if="editingId" v-model="isEditPassword">Edit Password</md-checkbox>
          <div style="red-outline">
            <md-field>
              <label>Mật khẩu</label>
              <md-input type="password"
                        :name="`${_uid}_password`"
                        data-vv-validate-on="none"
                        data-vv-as="password"
                        ref="password"
                        v-validate="'required|min:6|max:30'"
                        data-vv-scope="general"
                        v-model="student.password"
                        :disabled="!!editingId && !isEditPassword"
                        :class="errors.has(`general.${_uid}_password`) ? 'is-invalid' : ''">
             </md-input>
             <div v-if="errors.has(`general.${_uid}_password`)">
               <md-icon class="md-accent">warning</md-icon>
               {{errors.first(`general.${_uid}_password`)}}
             </div>
            </md-field>

            <md-field :md-toggle-password="false">
              <label>Nhập lại mật khẩu</label>
              <md-input type="password"
                        :name="`${_uid}_repassword`"
                        data-vv-validate-on="none"
                        data-vv-as="retype password"
                        v-validate="'required|confirmed:password'"
                        data-vv-scope="general"
                        v-model="student.retype_password"
                        :disabled="!!editingId && !isEditPassword"
                        :class="errors.has(`general.${_uid}_password`) ? 'is-invalid' : ''">
              </md-input>
              <div v-if="errors.has(`general.${_uid}_repassword`)">
                <md-icon class="md-accent">warning</md-icon>
                {{errors.first(`general.${_uid}_repassword`)}}
              </div>
            </md-field>
          </div>
      </div>

      <div class="md-right">
        <md-button class="md-raised md-primary" @click="submit">Gửi</md-button>
        <md-button class="md-raised md-accent" @click="cancel">Bỏ qua</md-button>
      </div>
  </modal>
</template>

<script>
import rf from '../requests/RequestFactory';
export default {
  data () {
    return {
      title: 'Student',
      editingId: '',
      isEditPassword: false,
      student: {
        full_name: '',
        name: '',
        email: '',
      }
    }
  },
  methods: {
    beforeOpen (event) {
      this.title = event.params.title;
      if(event.params.studentId) {
        this.editingId = event.params.studentId;
        rf.getRequest('StudentRequest').show(this.editingId).then((student)=>{
          this.student = student;
        });
      }
    },
    beforeClose() {
      this.editingId = '';
      this.isEditPassword = false,
      this.student = {
        name: '',
        full_name: '',
        email: '',
      };
    },
    async submit() {
        Promise.all([
          this.$validator.validateAll('general'),
        ]).then(() => {
            if (this.errors.any()) {
              return;
            }
            if(this.editingId) {
              this.updateOneStudent();
            } else {
              this.createOneStudent();
            }
        });
      },
    updateOneStudent() {
      let params = this.student;
      if(!this.isEditPassword) {
        params = {};
        params.name = this.student.name;
        params.full_name = this.student.full_name;
        params.email = this.student.email;
      }
      rf.getRequest('StudentRequest').update(this.editingId, params).then((res)=> {
        this.$modal.hide('student');
        this.$emit('refresh');
      });
      this.$toasted.show('Cập nhật sinh viên thành công!', {
        theme: 'bubble',
        position: 'top-right',
        duration : 1500,
        type: 'success'
      });
    },
    createOneStudent() {
          rf.getRequest('StudentRequest').store(this.student).then((res)=>{
            this.$modal.hide('student');
            this.$emit('refresh');
          }).catch((err) => {
            // this.$toasted.show('Đã có lỗi xảy ra, vui lòng kiểm tra lại!', {
            //   theme: 'bubble',
            //   position: 'top-right',
            //   duration : 1500,
            //   type: 'danger'
            // });
          });
    },
    cancel() {
      this.$modal.hide('student');
    }
  }
}
</script>

<style lang="scss" scoped >
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
