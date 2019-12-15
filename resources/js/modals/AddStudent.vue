<template>
  <modal name="add-student"
      height="600px"
      :scrollable="true"
      :click-to-close="true"
      @before-open="beforeOpen"
      @before-close="beforeClose"
      >

    <div class="content" style="height:500px">
      <div slot="top-right">
        <md-button class="top-right md-icon-button md-accent" @click="$modal.hide('add-student')">
          <md-icon>close</md-icon>
        </md-button>
      </div>
      <span class="md-title">{{title}}</span>

      <div style="padding:20px;">
        <label>Sinh viên</label>
        <multiselect
         :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Vui lòng chọn" :custom-label="codeWithName" label="name" track-by="name" :preselect-first="true"
         v-model="selectedStudents" :options="students">
         <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} sinh viên đã được chọn</span></template>
       </multiselect>

        <md-table class="student-table">
          <thead>
            <th>STT</th>
            <th>Mã sinh viên</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th></th>
          </thead>
          <tbody>
            <tr v-for="(student, index) in selectedStudents">
              <td>{{index + 1}}</td>
              <td>{{student.name}}</td>
              <td>{{student.full_name}}</td>
              <td>{{student.email}}</td>
              <td>
                <md-button class="md-just-icon md-simple md-danger" @click="removeOneStudentFromSelectedStudents(student)">
                  <md-icon>close</md-icon>
                  <md-tooltip md-direction="top">Xóa</md-tooltip>
                </md-button>
              </td>
            </tr>
          </tbody>
        </md-table>
      </div>
    </div>

      <div class="md-right">
        <md-button class="md-raised md-primary" @click="submit">Thêm</md-button>
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
      moduleId: '',
      isEditPassword: false,
      students: [],
      selectedStudents: []
    }
  },
  methods: {
    beforeOpen (event) {
      this.title = event.params.title;
      this.moduleId = event.params.moduleId;
      rf.getRequest('ModuleRequest').getAllStudentsToAdd(this.moduleId).then(res => {
        this.students = res;
      });
      this.selectedStudents = [];
    },
    beforeClose() {
      location.reload();
    },
    submit() {
      let ids = this.selectedStudents.map(student => student.id);
      rf.getRequest('ModuleRequest').addStudentsToModule(ids, this.moduleId).then(res => {
        this.$toasted.show('Thêm '+this.selectedStudents.length+' sinh viên thành công!', {
          theme: 'bubble',
          position: 'top-right',
          duration : 1500,
          type: 'success'
        });
        this.$modal.hide('add-student');
        this.selectedStudents = [];
      })
    },
    removeOneStudentFromSelectedStudents(removeStudent) {
      this.selectedStudents.splice(this.selectedStudents.indexOf(removeStudent), 1);
    },
    codeWithName({ name, full_name }) {
      return `${name} — ${full_name}`;
    },
    cancel() {
      this.$modal.hide('add-student');
    }
  },
  beforeCreate () {
    this.selectedStudents = [];
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

.student-table {
  max-height: 342px;
  width: 100%;
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
    text-align: center;
  }


}
</style>
