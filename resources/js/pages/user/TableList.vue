<template>
  <div class="content">
    <div class="md-layout">
      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
        <md-card>
          <md-card-header data-background-color="green">
            <h4 class="title">Simple Table</h4>
            <p class="category">Here is a subtitle for this table</p>
          </md-card-header>
          <md-card-content>
            <data-table :get-data="getData" ref="datatable">
                <th class="col_checkbox">
                  <md-checkbox :plain="true" v-model="selectedAll"></md-checkbox>
                </th>
                <th class="col_title_en">Tên đăng nhập</th>
                <th class="col_title_jp">Email</th>
                <th class="col_summary_en">Tên</th>
                <th class="col_created_at">Ngày tạo</th>
                <th class="col_tools">Công cụ</th>
                <template slot="body" slot-scope="{ item, index }">
                  <tr>
                    <td class="text-center">
                      <md-checkbox v-model="item.selected" @input="listenSelectRow"></md-checkbox>
                    </td>
                    <td class="text-center" v-html="item.name"></td>
                    <td class="text-center" v-html="item.email"></td>
                    <td class="text-center" v-html="item.full_name"></td>
                    <td class="text-center" v-html="item.created_at"></td>
                    <td class="text-center">
                      <md-button class="md-raised md-primary" @click="editStudent(item.id)">Sửa</md-button>
                      <md-button class="md-raised md-accent" @click="removeOneStudent(item.id)">Xóa</md-button>
                    </td>
                  </tr>
                </template>
            </data-table>
          </md-card-content>
        </md-card>
      </div>
    </div>
  </div>
</template>

<script>
import {
  SimpleTable,
  OrderedTable
} from '@/components'

import rf from '../../requests/RequestFactory';
export default{
  components: {
    OrderedTable,
    SimpleTable
  },
  data () {
    return {
      searchInput: '',
      selectedAll: false
    }
  },
  methods: {
    removeOneStudent(studentId) {
      this.$modal.show('dialog', {
        title: 'Alert!',
        text: 'Are you sure delete ?',
        buttons: [
          {
            title: 'Cancel',
            handler: () => {
              this.$modal.hide('dialog');
            }
          },
          {
            title: 'Confirm',
            default: true,
            handler: () => {
              return rf.getRequest('StudentRequest').removeOneStudent(studentId).then(() => {
                this.$modal.hide('dialog');
                this.$refs.datatable.refresh();
                this.$toasted.show('Student removed successfully!', {
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
    removeManyStudent() {
        this.$modal.show('dialog', {
          title: 'Alert!',
          text: 'Are you sure delete ?',
          buttons: [
            {
              title: 'Cancel',
              handler: () => {
                this.$modal.hide('dialog');
              }
            },
            {
              title: 'Confirm',
              default: true,
              handler: () => {
                const studentIds = this.$refs.datatable.rows.filter((row) => {
                  return row.selected === true;
                }).map(record => record.id);

                return rf.getRequest('StudentRequest').removeManyStudents(studentIds).then(() => {
                  this.$modal.hide('dialog');
                  this.$refs.datatable.refresh();
                  this.$toasted.show('Student removed successfully!', {
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
      createStudent() {
        this.$modal.show('student', {title: 'Add Student'});
      },
      editStudent(studentId) {
        this.$modal.show('student', {title: 'Edit Student', studentId: studentId});
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
        return rf.getRequest('StudentRequest').getStudents(meta);
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
