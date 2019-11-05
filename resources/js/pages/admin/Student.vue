<template>
  <div class="dash">
    <div class="md-layout md-gutter">
      <div class="md-layout-item">
        <md-button  class="md-raised md-primary" @click="createStudent">Thêm</md-button>
        <md-button  class="md-raised" @click="refresh">Làm mới</md-button>
        <md-button  class="md-raised md-accent" @click="removeManyStudent()">Xóa</md-button>
      </div>
      <div class="md-layout-item md-size-30">
        <md-field >
          <label>Tìm kiếm</label>
          <md-input type="text" name="text" v-model="searchInput" @keyup.enter="$refs.datatable.refresh()"></md-input>
          <md-icon>search</md-icon>
        </md-field>
      </div>
    </div>

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
    <v-dialog/>
    <StudentModal @refresh="refresh()"/>
  </div>
</template>

<script>

import rf from '../../requests/RequestFactory';
import StudentModal from '../../modals/Student';
export default {
  name: "Student",
  components: {
      StudentModal,
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

<style lang="css" scoped >

</style>
