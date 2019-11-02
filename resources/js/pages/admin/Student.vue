<template>
  <div class="dash">
    <div class="md-layout md-gutter">
      <div class="md-layout-item">
        <md-button  class="md-raised md-primary">Add</md-button>
        <md-button  class="md-raised" @click="refresh">Refresh</md-button>
        <md-button  class="md-raised md-accent" @click="removeManyStudent()">Delete</md-button>
      </div>
      <div class="md-layout-item md-size-30">
        <md-field >
          <label>Search</label>
          <md-input type="text" name="text" v-model="searchInput" @keyup.enter="$refs.datatable.refresh()"></md-input>
          <md-icon>search</md-icon>
        </md-field>
      </div>
    </div>

    <data-table :get-data="getData" ref="datatable">
        <th class="col_checkbox">
          <md-checkbox :plain="true" v-model="selectedAll"></md-checkbox>
        </th>
        <th class="col_title_en">Username</th>
        <th class="col_title_jp">Email</th>
        <th class="col_summary_en">Name</th>
        <th class="col_created_at">Created at</th>
        <th class="col_tools">Tool</th>
        <template slot="body" slot-scope="{ item, index }">
          <tr>
            <td class="text-center">
              <md-checkbox v-model="item.selected" @input="listenSelectRow"></md-checkbox>
            </td>
            <td class="text-center" v-html="item.username"></td>
            <td class="text-center" v-html="item.email"></td>
            <td class="text-center" v-html="item.name"></td>
            <td class="text-center" v-html="item.created_at"></td>
            <td class="text-center">
              <md-button class="md-raised md-primary">Edit</md-button>
              <md-button class="md-raised md-accent" @click="removeOneStudent(item.id)">Delete</md-button>
            </td>
          </tr>
        </template>
    </data-table>
    <v-dialog/>
  </div>
</template>

<script>

import rf from '../../requests/RequestFactory';
export default {
  name: "Student",
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
    listenSelectRow() {
      if (!this.$refs.datatable) {
        return true;
      }

      this.selectedAll = this.$refs.datatable.rows.filter(row => row.selected === true).length === this.$refs.datatable.rows.length;
    },
    getData (params) {
      const meta = Object.assign({}, params, {
        search: this.searchInput,
        category: 'ai'
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
