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
          <md-button  class="md-success" @click="createTestSite">Thêm</md-button>
          <md-button  class="md-info" @click="refresh">Làm mới</md-button>
          <md-button  class="md-danger" @click="removeManyTestSite()">Xóa</md-button>
        </div>
      </div>
      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
        <md-card>
          <md-card-header data-background-color="green">
            <h4 class="title">Quản lý điểm thi</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
          </md-card-header>
          <md-card-content>
            <data-table :get-data="getData" ref="datatable">
                <th class="col_checkbox">
                  <md-checkbox :plain="true" v-model="selectedAll"></md-checkbox>
                </th>
                <th class="col_title_en">Tên</th>
                <th class="col_title_en">Kì thi</th>
                <th class="col_tools">Công cụ</th>
                <template slot="body" slot-scope="{ item, index }">
                  <tr>
                    <td class="text-center">
                      <md-checkbox v-model="item.selected" @input="listenSelectRow"></md-checkbox>
                    </td>
                    <td class="text-center" v-html="item.name"></td>
                    <td class="text-center" v-html="item.exam_name"></td>
                    <td class="text-center">
                      <md-button class="md-just-icon md-simple md-primary" @click="editTestSite(item.id)">
                        <md-icon>edit</md-icon>
                        <md-tooltip md-direction="top">Sửa</md-tooltip>
                      </md-button>
                      <md-button class="md-just-icon md-simple md-danger" @click="removeOneTestSite(item.id)">
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
      <TestSiteModal @refresh="refresh()"/>
    </div>
  </div>
</template>

<script>
import {
  SimpleTable,
  OrderedTable
} from '@/components'

import rf from '../../requests/RequestFactory';
import TestSiteModal from '../../modals/TestSite';

export default{
  components: {
    OrderedTable,
    SimpleTable,
    TestSiteModal
  },
  data () {
    return {
      searchInput: '',
      selectedAll: false
    }
  },
  methods: {
    removeOneTestSite(testSiteId) {
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
              return rf.getRequest('TestSiteRequest').removeOneTestSite(testSiteId).then(() => {
                this.$modal.hide('dialog');
                this.$refs.datatable.refresh();
                this.$toasted.show('Xóa điểm thi thành công!', {
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
    removeManyTestSite() {
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
                const testSiteIds = this.$refs.datatable.rows.filter((row) => {
                  return row.selected === true;
                }).map(record => record.id);

                return rf.getRequest('TestSiteRequest').removeManyTestSites(testSiteIds).then(() => {
                  this.$modal.hide('dialog');
                  this.$refs.datatable.refresh();
                  this.$toasted.show('Xóa điểm thi thành công!', {
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
      createTestSite() {
        this.$modal.show('test-site', {title: 'Thêm điểm thi'});
      },
      editTestSite(testSiteId) {
        this.$modal.show('test-site', {title: 'Sửa thông tin điểm thi', testSiteId: testSiteId});
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
        return rf.getRequest('TestSiteRequest').getTestSites(meta);
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
