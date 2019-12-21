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
          <md-button  class="md-success" @click="createExam">Thêm</md-button>
          <md-button  class="md-info" @click="refresh">Làm mới</md-button>
          <md-button  class="md-danger" @click="removeManyExam()">Xóa</md-button>
        </div>
      </div>
      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
        <md-card>
          <md-card-header data-background-color="green">
            <h4 class="title">Quản lý kỳ thi</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
          </md-card-header>
          <md-card-content>
            <data-table :get-data="getData" ref="datatable">
                <th class="col_checkbox">
                  <md-checkbox :plain="true" v-model="selectedAll" class="cb-success"></md-checkbox>
                </th>
                <th class="col_title_en">Tên</th>
                <th class="col_title_en">Thời điểm bắt đầu</th>
                <th class="col_title_en">Thời điểm kết thúc</th>
                <th class="col_created_at">Ngày tạo</th>
                <th class="col_tools">Công cụ</th>
                <template slot="body" slot-scope="{ item, index }">
                  <tr>
                    <td class="text-center">
                      <md-checkbox v-model="item.selected" @input="listenSelectRow" class="cb-success"></md-checkbox>
                    </td>
                    <td class="text-center" v-html="item.name"></td>
                    <td class="text-center"> {{item.register_started_at | toDateFormat}}</td>
                    <td class="text-center">{{item.register_finished_at | toDateFormat}}</td>
                    <td class="text-center" v-html="item.created_at"></td>
                    <td class="text-center">
                      <md-button class="md-just-icon md-simple md-primary" @click="editExam(item.id)">
                        <md-icon>edit</md-icon>
                        <md-tooltip md-direction="top">Sửa</md-tooltip>
                      </md-button>
                      <md-button class="md-just-icon md-simple md-danger" @click="removeOneExam(item.id)">
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
      <ExamModal @refresh="refresh()"/>
    </div>
  </div>
</template>

<script>
import {
  SimpleTable,
  OrderedTable
} from '@/components'

import rf from '../../requests/RequestFactory';
import ExamModal from '../../modals/Exam'

export default{
  components: {
    OrderedTable,
    SimpleTable,
    ExamModal
  },
  data () {
    return {
      searchInput: '',
      selectedAll: false
    }
  },
  methods: {
    removeOneExam(examId) {
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
              return rf.getRequest('ExamRequest').removeOneExam(examId).then(() => {
                this.$modal.hide('dialog');
                this.$refs.datatable.refresh();
                this.$toasted.show('Xóa kỳ thi thành công!', {
                  theme: 'bubble',
                  position: 'top-right',
                  duration : 1500,
                  type: 'success'
                });
              });
            }
          }
        ]
      });
    },
    removeManyExam() {
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
                const examIds = this.$refs.datatable.rows.filter((row) => {
                  return row.selected === true;
                }).map(record => record.id);

                return rf.getRequest('ExamRequest').removeManyExams(examIds).then(() => {
                  this.$modal.hide('dialog');
                  this.$refs.datatable.refresh();
                  this.$toasted.show('Xóa các kỳ thi thành công!', {
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
      createExam() {
        this.$modal.show('exam', {title: 'Thêm kỳ thi'});
      },
      editExam(examId) {
        this.$modal.show('exam', {title: 'Sửa thông tin kỳ thi', examId: examId});
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
        return rf.getRequest('ExamRequest').getExams(meta);
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
  }
}
</script>
<style lang="scss">
.md-datepicker-dialog {
  z-index: 10000 !important;
}
</style>
