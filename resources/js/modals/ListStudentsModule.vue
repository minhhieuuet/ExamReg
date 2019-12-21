<template>
  <modal name="list-students-module"
      height="auto"
      :scrollable="true"
      :click-to-close="true"
      @before-open="beforeOpen"
      @before-close="beforeClose"
      >

    <div class="content">
      <span class="md-title">{{title}}</span>
      <br>
      <md-button  @click="$refs.file1.click()" class="md-icon-button md-success" title="Thêm sinh viên từ excel">
        <md-icon>attach_file</md-icon>
      </md-button>
      <input type="file" style="display:none;" id="file" ref="file1" v-on:change="handleAddStudentFileUpload()">
      <md-button class="md-icon-button md-danger" title="Thêm sinh viên bị cấm thi từ excel">
        <md-icon>attach_file</md-icon>
      </md-button>
      <md-table class="session-table">
        <th>STT</th>
        <th>Mã sinh viên</th>
        <th>Họ và tên</th>
        <th>Trường</th>
        <th>Trạng thái</th>
        <th>Công cụ</th>

        <tr v-for="(student, index) in students">
          <td class="text-center">{{index+1}}</td>
          <td class="text-center">{{student.name}}</td>
          <td class="text-center">{{student.full_name}}</td>
          <td class="text-center">UET</td>
          <td class="text-center">
            <md-button class="md-just-icon md-simple md-success" title="Được thi" v-if="student.status" @click="toogleStudentModuleStatus(student.id)">
              <md-icon>check_circle</md-icon>
            </md-button>
            <md-button class="md-just-icon md-simple md-danger" title="Bị cấm thi" v-else @click="toogleStudentModuleStatus(student.id)">
              <md-icon>error</md-icon>
            </md-button>
          </td>
          <td class="text-center">
            <md-button class="md-just-icon md-simple md-danger" @click="removeOneStudentFromModule(student.id)">
              <md-icon>close</md-icon>
            </md-button>
          </td>
        </tr>
      </md-table>
    </div>
      <div class="md-right">
        <md-button class="md-raised md-info" @click="cancel">Đóng</md-button>
      </div>
      <v-dialog/>
  </modal>

</template>

<script>
  import rf from '../requests/RequestFactory';

  export default {
  data () {
    return {
      title: 'Student',
      editingId: '',
      moduleId: '',
      students: '',
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
      this.moduleId = event.params.moduleId;
      rf.getRequest('ModuleRequest').getAllStudentsInModule(this.moduleId).then(res => {
        this.students = res;
      });
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
    async handleAddStudentFileUpload(){
      this.file1 = this.$refs.file1.files[0];
      let formData = new FormData();
      formData.append('file', this.file1);
      formData.append('module_id', this.moduleId);
      rf.getRequest('ModuleRequest').importStudentExel(formData).then(res =>{
        console.log(res);
        this.file1s = '';
        this.$toasted.show('Nhập sinh viên thành công!', {
          theme: 'bubble',
          position: 'top-right',
          duration : 1500,
          type: 'success'
        });
        rf.getRequest('ModuleRequest').getAllStudentsInModule(this.moduleId).then(res => {
          this.students = res;
        });
        this.$emit('refresh');
      })
      .catch(err => {
        console.log(err);
        // this.$toasted.show('Đã xảy ra lỗi, vui lòng kiểm tra lại định dạng file', {
        //   theme: 'bubble',
        //   position: 'top-right',
        //   duration : 2500,
        //   type: 'danger'
        // });
      });
    },
    removeOneStudentFromModule (studentId) {
      this.$modal.show('dialog', {
        title: 'Cảnh báo!',
        text: 'Bạn có chắc chắn muốn xóa sinh viên này khỏi học phần ?',
        buttons: [
          {
            title: 'Bỏ qua',
            handler: () => {
              this.$modal.hide('dialog');
            }
          },
          {
            title: 'Xác nhận',
            default: true,
            handler: () => {

              return rf.getRequest('ModuleRequest').removeOneStudentFromModule(this.moduleId, studentId).then((res) => {
                this.$modal.hide('dialog');
                console.log(res);
                rf.getRequest('ModuleRequest').getAllStudentsInModule(this.moduleId).then(res => {
                  this.students = res;
                });
                this.$toasted.show('Xóa sinh viên thành công!', {
                  theme: 'bubble',
                  position: 'top-right',
                  duration : 1500,
                  type: 'success'
                });
              });
            }
          },
        ]
      });
    },
    toogleStudentModuleStatus (studentId) {
      rf.getRequest('ModuleRequest').toggleStudentModuleStatus(this.moduleId, studentId).then(res => {
        console.log(res);
        rf.getRequest('ModuleRequest').getAllStudentsInModule(this.moduleId).then(res => {
          this.students = res;
        });
      });
    },
    cancel() {
      this.$modal.hide('list-students-module');
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
.session-table {
  max-height: 371px;
  scroll-behavior: auto;
  overflow: auto;
  th {
    color: #4CAF50;
    padding: 5px;
    font-weight: normal;
    text-align: center;
    border-bottom: 1px solid #dfe2e5;
    font-size: 16px;
    line-height: 22px;
  }

  tr td {
    border-bottom: 1px solid #dfe2e5;
  }


}
.table-1 {
  height: 500px  !important;
}

.table-2 {
  margin-top: 22px;
}
</style>
