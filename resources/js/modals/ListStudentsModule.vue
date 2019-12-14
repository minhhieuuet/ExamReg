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

      <md-table class="session-table">
        <th>Mã sinh viên</th>
        <th>Họ và tên</th>
        <th>Trường</th>
        <th>Trạng thái</th>
        <th>Công cụ</th>

        <tr v-for="student in students">
          <td class="text-center">{{student.name}}</td>
          <td class="text-center">{{student.full_name}}</td>
          <td class="text-center">UET</td>
          <td class="text-center">{{student.status}}</td>
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
