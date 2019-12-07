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
          <md-button  class="md-success" @click="createRoom">Thêm</md-button>
          <md-button  class="md-info" @click="refresh">Làm mới</md-button>
          <md-button  class="md-danger" @click="removeManyRoom()">Xóa</md-button>
        </div>
      </div>
      <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
        <md-card>
          <md-card-header data-background-color="green">
            <h4 class="title">Quản lí phòng máy</h4>
<!--            <p class="category">Here is a subtitle for this table</p>-->
          </md-card-header>
          <md-card-content>
            <data-table :get-data="getData" ref="datatable">
                <th class="col_checkbox">
                  <md-checkbox :plain="true" v-model="selectedAll"></md-checkbox>
                </th>
                <th class="col_title_en">Tên</th>
                <th class="col_title_en">Số máy</th>
                <th class="col_created_at">Ngày tạo</th>
                <th class="col_tools">Công cụ</th>
                <template slot="body" slot-scope="{ item, index }">
                  <tr>
                    <td class="text-center">
                      <md-checkbox v-model="item.selected" @input="listenSelectRow"></md-checkbox>
                    </td>
                    <td class="text-center" v-html="item.name"></td>
                    <td class="text-center" v-html="item.capacity"></td>
                    <td class="text-center" v-html="item.created_at"></td>
                    <td class="text-center">
                      <md-button class="md-just-icon md-simple md-primary" @click="editRoom(item.id)">
                        <md-icon>edit</md-icon>
                        <md-tooltip md-direction="top">Sửa</md-tooltip>
                      </md-button>
                      <md-button class="md-just-icon md-simple md-danger" @click="removeOneRoom(item.id)">
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
      <RoomModal @refresh="refresh()"/>
    </div>
  </div>
</template>

<script>
import {
  SimpleTable,
  OrderedTable
} from '@/components'

import rf from '../../requests/RequestFactory';
import RoomModal from '../../modals/Room'

export default{
  components: {
    OrderedTable,
    SimpleTable,
    RoomModal
  },
  data () {
    return {
      searchInput: '',
      selectedAll: false
    }
  },
  methods: {
    removeOneRoom(roomId) {
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
              return rf.getRequest('RoomRequest').removeOneRoom(roomId).then(() => {
                this.$modal.hide('dialog');
                this.$refs.datatable.refresh();
                this.$toasted.show('Xóa phòng máy thành công!', {
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
    removeManyRoom() {
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
                const roomIds = this.$refs.datatable.rows.filter((row) => {
                  return row.selected === true;
                }).map(record => record.id);

                return rf.getRequest('RoomRequest').removeManyRooms(roomIds).then(() => {
                  this.$modal.hide('dialog');
                  this.$refs.datatable.refresh();
                  this.$toasted.show('Room removed successfully!', {
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
      createRoom() {
        this.$modal.show('room', {title: 'Thêm phòng máy'});
      },
      editRoom(roomId) {
        this.$modal.show('room', {title: 'Sửa thông tin phòng máy', roomId: roomId});
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
        return rf.getRequest('RoomRequest').getRooms(meta);
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
