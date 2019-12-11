<template>
  <div class="content">
    <div class="md-layout">
      <div class="md-layout md-gutter">
        <div class="md-layout-item md-size-5">
        </div>
        <div class="md-layout-item md-size-30">
          <md-field >
            <label>Tìm kiếm</label>
            <md-input type="text" name="text" v-model="searchInput" @keyup.enter="$refs.datatable.refresh()"></md-input>
            <md-icon>search</md-icon>
          </md-field>
        </div>
        <div class="md-layout-item md-size-35">
        </div>
        <div class="md-layout-item">
          <md-button  class="md-success" @click="isShowSessionForm = !isShowSessionForm">Thêm</md-button>
          <md-button  class="md-info" @click="refresh">Làm mới</md-button>
          <md-button  class="md-danger" @click="removeManyExamSession()">Xóa</md-button>
        </div>
      </div>

      <md-card style="padding: 20px;" v-show="isShowSessionForm" md-with-hover >
          <div class="md-title">Thêm ca thi</div>
          <md-card-content>
            <md-datepicker v-model="selectedDate">
              <label>Ngày thi</label>
            </md-datepicker>
          </md-card-content>
          <md-card-content>
              <label>Điểm thi</label>
              <multiselect v-model="selectedTestSite" label="name" :options="testSites"></multiselect>
          </md-card-content>

          <md-card-content>
              <label>Học phần</label>
              <multiselect v-model="selectedModule" :custom-label="nameWithCode" :searchable="true" :options="modules"></multiselect>
          </md-card-content>

          <md-card-content>
              <label>Thời điểm bắt đầu</label>
              <timeselector v-model="startTime" :interval="{h:1, m:1}"></timeselector>
          </md-card-content>

          <md-card-content>
              <label>Thời điểm kết thúc</label>
              <timeselector v-model="finishTime" :interval="{h:1, m:1}"></timeselector>
          </md-card-content>

          <md-card-actions style="padding-bottom: 20px;">
            <md-button class="md-success" @click="createExamSession">Xác nhận</md-button>
            <md-button class="md-danger">Bỏ qua</md-button>
          </md-card-actions>

      </md-card>

      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
        <md-card>
          <md-card-header data-background-color="green">
            <h4 class="title">Quản lí ca thi</h4>
          </md-card-header>
          <md-card-content>
            <data-table :get-data="getData" ref="datatable">
                <th class="col_checkbox">
                  <md-checkbox :plain="true" v-model="selectedAll"></md-checkbox>
                </th>
                <th>STT</th>
                <th class="col_title_en">Mã học phần</th>
                <th>Tên học phần</th>
                <th class="col_title_jp">Địa điểm thi</th>
                <th>Ngày thi</th>
                <th class="col_summary_en">Bắt đầu</th>
                <th class="col_created_at">Kết thúc</th>
                <th class="col_tools">Công cụ</th>
                <template slot="body" slot-scope="{ item, index }">
                  <tr>
                    <td class="text-center">
                      <md-checkbox v-model="item.selected" @input="listenSelectRow"></md-checkbox>
                    </td>
                    <td class="text-center" v-html="index+1"></td>
                    <td class="text-center">{{item.module_code}}</td>
                    <td class="text-center">{{item.module_name}}</td>
                    <td class="text-center" v-html="item.test_site_name"></td>
                    <td class="text-center">{{item.started_at | toDateFormat}}</td>
                    <td class="text-center">{{item.started_at | toTimeFormat}}</td>
                    <td class="text-center">{{item.finished_at | toTimeFormat}}</td>
                    <td class="text-center">
                        <md-button class="md-just-icon md-simple md-primary" @click="editExamSession(item.id)">
                          <md-icon>edit</md-icon>
                          <md-tooltip md-direction="top">Sửa</md-tooltip>
                        </md-button>
                        <md-button class="md-just-icon md-simple md-danger" @click="removeOneExamSession(item.id)">
                          <md-icon>close</md-icon>
                          <md-tooltip md-direction="top">Xóa</md-tooltip>
                        </md-button>
                    </td>
                  </tr>
                </template>
            </data-table>
          </md-card-content>
        </md-card>
      </div>
      <v-dialog/>
    </div>
  </div>
</template>

<script>
import {
  SimpleTable,
  OrderedTable
} from '@/components'

import rf from '../../requests/RequestFactory';
import Timeselector from 'vue-timeselector';
import moment from 'moment';
export default{
  components: {
    OrderedTable,
    SimpleTable,
    Timeselector
  },
  data () {
    return {
      searchInput: '',
      selectedAll: false,
      startTime: moment().toDate(),
      finishTime: moment().add(1, 'hours').toDate(),
      selectedDate: moment().toDate(),
      modules: [],
      testSites: [],
      selectedModule: {},
      selectedTestSite: {},
      isShowSessionForm: false
    }
  },
  methods: {
    nameWithCode ({ name, code }) {
      return `${code} — [${name}]`;
    },
    removeOneExamSession(examSessionId) {
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
              return rf.getRequest('ExamSessionRequest').removeOneExamSession(examSessionId).then(() => {
                this.$modal.hide('dialog');
                this.$refs.datatable.refresh();
                this.$toasted.show('Xóa ca thi thành công!', {
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
    removeManyExamSession() {
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
                const examSessionIds = this.$refs.datatable.rows.filter((row) => {
                  return row.selected === true;
                }).map(record => record.id);

                return rf.getRequest('ExamSessionRequest').removeManyExamSessions(examSessionIds).then(() => {
                  this.$modal.hide('dialog');
                  this.$refs.datatable.refresh();
                  this.$toasted.show('Xóa ca thi thành công!', {
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
      createExamSession() {
        var date = moment(this.selectedDate).format('DD/MM/YYYY');
        var startTime = moment(this.startTime).format('HH:mm');
        var finishTime = moment(this.finishTime).format('HH:mm');
        startTime = moment(date + ' ' + startTime, 'DD/MM/YYYY HH:mm').format('x');
        finishTime = moment(date + ' ' + finishTime, 'DD/MM/YYYY HH:mm').format('x');
        let params = {
          module_id: this.selectedModule.id,
          test_site_id: this.selectedTestSite.id,
          started_at: startTime,
          finished_at: finishTime
        };

        rf.getRequest('ExamSessionRequest').store(params).then((res)=>{
          this.$refs.datatable.refresh();
          this.isShowSessionForm = false;
          this.$toasted.show('Thêm ca thi thành công', {
            theme: 'bubble',
            position: 'top-right',
            duration : 1500,
            type: 'success'
          });
        }).catch((err) => {
          // this.$toasted.show('Đã có lỗi xảy ra, vui lòng kiểm tra lại!', {
          //   theme: 'bubble',
          //   position: 'top-right',
          //   duration : 1500,
          //   type: 'danger'
          // });
        });
      },
      editExamSession(examSessionId) {
        this.isShowSessionForm = true;
        rf.getRequest('ExamSessionRequest').show(examSessionId).then(res => {
          rf.getRequest('ModuleRequest').show(res.module_id).then(module => {
            this.selectedModule = module;
          });

        });
      },
      listenSelectRow() {
        if (!this.$refs.datatable) {
          return true;
        }

        this.selectedAll = this.$refs.datatable.rows.filter(row => row.selected === true).length === this.$refs.datatable.rows.length;
      },
      getData (params) {
        const meta = Object.assign({}, params, {
          search: this.searchInput,
        });
        return rf.getRequest('ExamSessionRequest').getExamSessions(meta);
      },
      refresh() {
        this.isLoading = true;
        this.$refs.datatable.refresh();
        this.$refs.datatable.$on('DataTable:finish', () => {
          this.isLoading = false;
        });
      },
  },
  watch: {
    searchInput() {
      this.$refs.datatable.refresh();
    },
    selectedAll() {
      if (!this.$refs.datatable) {
        return true;
      }
      this.$refs.datatable.rows.forEach((row) => {
        this.$set(row, 'selected', this.selectedAll);
      });
    },
  },
  mounted () {
    rf.getRequest('ExamSessionRequest').getAllModules().then((modules)=>{
      this.modules = modules;
    });

    rf.getRequest('ExamSessionRequest').getAllTestSites().then((testSites)=>{
      this.testSites = testSites;
    });
  }
}
</script>
<style lang="scss">
.vtimeselector {
    display: inline-block;
    position: relative;
    font-size: 1em;
    width: 10em;
    font-family: sans-serif;
    vertical-align: middle;
}
.vtimeselector__input {
  border: 1px solid #d2d2d2 !important;
  width: 10em;
  height: 2.2em;
  padding: .3em .5em;
  font-size: 1em;
}
</style>
