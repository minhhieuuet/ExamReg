<template>
  <modal name="add-student"
      height="auto"
      :scrollable="true"
      :click-to-close="true"
      @before-open="beforeOpen"
      @before-close="beforeClose"
      >

    <div class="content">
      <div slot="top-right">
        <md-button class="top-right md-icon-button md-accent" @click="$modal.hide('add-student')">
          <md-icon>close</md-icon>
        </md-button>
      </div>
      <span class="md-title">{{title}}</span>

      <md-card style="padding: 20px;" v-show="isShowSessionForm" md-with-hover >
        <md-card-content>
          <label>Sinh viên</label>
          <multiselect v-model="selectedTestSite" label="name" :options="testSites"></multiselect>
        </md-card-content>
      </md-card>
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
