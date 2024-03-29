<template ref="dashboard">
  <div class="content">
    <loading :active.sync="isLoading" :can-cancel="false"></loading>
    <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100 table-1">
      <md-card>
        <md-card-header data-background-color="green">
          <h4 class="title">Đăng ký ca thi</h4>
        </md-card-header>
        <md-card-content class="md-table-1">
          <multiselect width="20px" v-model="selectedModule"
            :options="modules"
            :allow-empty="false"
            deselectLabel=""
            selectLabel="Nhấn enter để chọn"
            selectedLabel="Đã chọn"
            :maxHeight="300"
            :custom-label="nameWithCode"
            :searchable="true"
            label="name"
            placeholder="Chọn môn học">
          </multiselect>
          <h2 v-if="selectedModule.isRegisted">Môn thi đã được đăng ký</h2>
          <md-table class="session-table" v-else>
              <th>STT</th>
              <th>Mã học phần</th>
              <th class="col_title_en">Môn thi</th>
              <th>Ngày thi</th>
              <th>Thời gian bắt đầu</th>
              <th>Thời gian kết thúc</th>
              <th class="col_title_en">Điểm thi</th>
              <th>Trạng thái</th>
              <th class="col_tools">Đăng ký</th>

                <tr v-for="(item, index) in examSessions" :title="selectedModule.status ? '':'Bạn không được phép đăng ký môn học này'" :class="{disabled: !selectedModule.status}">
                  <td>{{index+1}}</td>
                  <td>{{item.module_code}}</td>
                  <td class="text-center" v-html="item.module_name"></td>
                  <td class="text-center">{{item.started_at | toDateFormat}}</td>
                  <td class="text-center">{{item.started_at | toTimeFormat}}</td>
                  <td class="text-center">{{item.finished_at | toTimeFormat}}</td>
                  <td class="text-center" v-html="item.test_site_name"></td>
                  <td class="text-center">{{item.registed_computers}}/{{item.total_computers}}</td>
                  <td class="text-center">
                    <md-checkbox v-if="!selectedModule.status" disabled></md-checkbox>
                    <md-checkbox title="Đăng ký" v-else v-model="item.selected" @change="registerSession(item)"></md-checkbox>
                  </td>
                </tr>

          </md-table>
        </md-card-content>
      </md-card>
    </div>

    <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100 table-2">
      <md-card>
        <md-card-header data-background-color="green">
          <h4 class="title">Ca thi đã đăng ký</h4>
        </md-card-header>
        <md-card-content>
          <data-table :get-data="getAllRegistedSessions" ref="datatable">
              <th>STT</th>
              <th>Mã học phần</th>
              <th class="col_title_en">Môn thi</th>
              <th>Ngày thi</th>
              <th>Thời gian bắt đầu</th>
              <th>Thời gian kết thúc</th>
              <th>Phòng thi</th>
              <th class="col_title_en">Điểm thi</th>
              <th class="col_tools">Công cụ</th>
              <template slot="body" slot-scope="{ item, index }">
                <tr>
                  <td>{{index+1}}</td>
                  <td>{{item.module_code}}</td>
                  <td class="text-center" v-html="item.module_name"></td>
                  <td class="text-center"> {{item.started_at | toDateFormat}}</td>
                  <td class="text-center">{{item.started_at | toTimeFormat}}</td>
                  <td class="text-center">{{item.started_at | toTimeFormat}}</td>
                  <td class="text-center">{{item.test_room_name}} - {{item.room_name}}</td>
                  <td class="text-center" v-html="item.test_site_name"></td>
                  <td class="text-center">
                    <md-button class="md-just-icon md-simple md-danger" @click="unRegisterASession(item)">
                      <md-icon>close</md-icon>
                      <md-tooltip md-direction="top">Hủy</md-tooltip>
                    </md-button>
                  </td>
                </tr>
              </template>
          </data-table>
        </md-card-content>
        <v-dialog/>
      </md-card>
    </div>
  </div>
</template>

<script>
import rf from '../../requests/RequestFactory';
export default{
  data () {
    return {
      isLoading: false,
      value: '',
      selectedModule: {
        isRegisted: false
      },
      modules: [],
      examSessions: [],
      reRender: true
    }
  },
  watch: {
    selectedModule: function () {
      this.getData();
      this.updateModuleStatus();
      this.updateSessionStatus();
    }
  },
  methods: {
    updateSessionStatus() {
      this.examSessions.forEach(item =>{
        rf.getRequest('UserRequest').getTotalExamSessionComputers(item.id).then(data =>{
          item.registed_computers = data.registed_computers;
          item.total_computers = data.total_computers;
          this.$forceUpdate();
        })
      })
    },
    getData (params) {
      rf.getRequest('UserRequest').getAllAvaiableExamSessions(this.selectedModule.module_id).then(res=>{
        this.examSessions = res;
      })
    },
    getAllRegistedSessions () {
      return rf.getRequest('UserRequest').getAllRegistedSessions();
    },
    nameWithCode ({ name, module_code }) {
      if(!name || !module_code) {
        return 'Chọn môn học';
      }
      return `${module_code} — [${name}]`;
    },
    registerSession(session) {
      this.updateSessionStatus();
      session.selected = true;
      this.isLoading = true;
      rf.getRequest('UserRequest').registerSession(session.id).then(data => {
        this.isLoading = false;
        this.refresh();
        this.updateModuleStatus();
        session.selected = false;
        this.$toasted.show('Đăng ký ca thi thành công', {
          theme: 'bubble',
          position: 'top-right',
          duration : 1500,
          type: 'success'
        });
      })
      .catch(err =>{
        this.isLoading = false;
        this.refresh();
        this.updateModuleStatus();
        session.selected = false;
      });
    },
    updateModuleStatus() {
      rf.getRequest('UserRequest').isRegistedModule(this.selectedModule.module_id).then(res =>{
        this.selectedModule.isRegisted = res;
        this.$forceUpdate();
      })
    },
    unRegisterASession(item) {
      this.updateSessionStatus();
      this.$modal.show('dialog', {
        title: 'Cảnh báo!',
        text: 'Bạn có chắc chắn muốn xóa ?',
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
              return rf.getRequest('UserRequest').unRegisterASession(item.test_room_id).then((res) => {
                this.$modal.hide('dialog');
                this.$refs.datatable.refresh();

                //Enable register form when unregisted
                this.$data.modules.forEach(module => {
                  if(module.module_id == item.module_id) {
                    module.isRegisted = false;
                  }
                })
                this.$toasted.show('Hủy ca thi thành công!', {
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
    refresh() {
      this.$refs.datatable.refresh();
    },
  },
  created: function () {
    this.getData();
    this.updateSessionStatus();
    setInterval(()=>{
      this.updateSessionStatus();
    }, 1000);
    rf.getRequest('UserRequest').getAllModules().then((res) => {
      this.modules = res;
    });
  }
}
</script>
<style lang="scss" scoped>
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
  .disabled {
    cursor: not-allowed;
    background-color: #dddddd;
    opacity: 0.7;
  }
</style>
