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

<!--      <data-table ref="datatable">-->
<!--        <th class="col_title_en">Mã sinh viên</th>-->
<!--        <th class="col_title_jp">Họ và tên</th>-->
<!--        <th class="col_summary_en">Trường</th>-->
<!--        <th class="col_created_at">Trạng thái</th>-->
<!--        <th class="col_created_at">Công cụ</th>-->

<!--        <template slot="body" slot-scope="{ item, index }">-->
<!--          <tr>-->
<!--            <td class="text-center" v-html="item.account"></td>-->
<!--            <td class="text-center" v-html="item.full_name"></td>-->
<!--            <td class="text-center" v-html="item.university_id"></td>-->
<!--            <td class="text-center" v-html="item.status"></td>-->
<!--            <td class="text-center">-->
<!--              <md-button class="md-just-icon md-simple md-danger" @click="removeOneStudent(item.id)">-->
<!--                <md-icon>close</md-icon>-->
<!--                <md-tooltip md-direction="top">Xóa</md-tooltip>-->
<!--              </md-button>-->
<!--            </td>-->
<!--          </tr>-->
<!--        </template>-->
<!--      </data-table>-->

      <md-table class="session-table">
        <th>Mã sinh viên</th>
        <th>Họ và tên</th>
        <th>Trường</th>
        <th>Trạng thái</th>
        <th>Công cụ</th>

        <tr>
          <td class="text-center">16021614</td>
          <td class="text-center">Bui Phuong Nam</td>
          <td class="text-center">UET</td>
          <td class="text-center">Được thi</td>
          <td class="text-center">
            <md-button class="md-just-icon md-simple md-danger" @click="removeOneStudent(item.id)">
              <md-icon>close</md-icon>
              <md-tooltip md-direction="top">Xóa</md-tooltip>
            </md-button>
          </td>
        </tr>

<!--        <tr v-for="(item, index) in examSessions">-->
<!--          <td class="text-center" v-html="item.account"></td>-->
<!--          <td class="text-center" v-html="item.full_name"></td>-->
<!--          <td class="text-center" v-html="item.university_id"></td>-->
<!--          <td class="text-center" v-html="item.status"></td>-->
<!--          <td class="text-center">-->
<!--            <md-button class="md-just-icon md-simple md-danger" @click="removeOneStudent(item.id)">-->
<!--              <md-icon>close</md-icon>-->
<!--              <md-tooltip md-direction="top">Xóa</md-tooltip>-->
<!--            </md-button>-->
<!--          </td>-->
<!--        </tr>-->
      </md-table>
    </div>
      <div class="md-right">
        <md-button class="md-raised md-info" @click="cancel">Đóng</md-button>
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
    getData(params){

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
