<template>
  <modal name="room"
      height="auto"
      :scrollable="true"
      :click-to-close="true"
      @before-open="beforeOpen"
      @before-close="beforeClose"
      >

        <div class="content">
          <div slot="top-right">
            <md-button class="top-right md-icon-button md-accent" @click="$modal.hide('room')">
              <md-icon>close</md-icon>
            </md-button>
          </div>
          <span class="md-title">Tạo phòng máy</span>

          <md-field>
            <label>Tên</label>
            <md-input type="text"
                      v-model="room.name"
                      md-counter="30">
            </md-input>
          </md-field>

          <md-field>
            <label>Số máy</label>
            <md-input type="text"
                      v-model="room.capacity"
                      md-counter="30">
           </md-input>
          </md-field>
          </div>
      </div>

      <div class="md-right">
        <md-button class="md-raised md-primary" @click="submit">Gửi</md-button>
        <md-button class="md-raised md-accent" @click="cancel">Bỏ qua</md-button>
      </div>
  </modal>
</template>

<script>
import rf from '../requests/RequestFactory';
export default {
  data () {
    return {
      title: 'Room',
      editingId: '',
      room: {
        name: '',
        capacity: ''
      }
    }
  },
  methods: {
    beforeOpen (event) {
      this.title = event.params.title;
      if(event.params.roomId) {
        this.editingId = event.params.roomId;
        rf.getRequest('RoomRequest').show(this.editingId).then((room)=>{
          this.room = room;
        });
      }
    },
    beforeClose() {
      this.editingId = '';
      this.room = {
        name: '',
        full_name: '',
        email: '',
      };
    },
    async submit() {
        Promise.all([
          this.$validator.validateAll('general'),
        ]).then(() => {
            if (this.errors.any()) {
              return;
            }
            if(this.editingId) {
              this.updateOneRoom();
            } else {
              this.createOneRoom();
            }
        });
      },
    updateOneRoom() {
      let params = this.room;
      params = {};
      params.name = this.room.name;
      params.capacity = this.room.capacity;
      rf.getRequest('RoomRequest').update(this.editingId, params).then((res)=> {
        this.$modal.hide('room');
        this.$emit('refresh');
      });
      this.$toasted.show('Cập nhật trường thành công!', {
        theme: 'bubble',
        position: 'top-right',
        duration : 1500,
        type: 'success'
      });
    },
    createOneRoom() {
          rf.getRequest('RoomRequest').store(this.room).then((res)=>{
            this.$modal.hide('room');
            this.$emit('refresh');
          }).catch((err) => {
            // this.$toasted.show('Đã có lỗi xảy ra, vui lòng kiểm tra lại!', {
            //   theme: 'bubble',
            //   position: 'top-right',
            //   duration : 1500,
            //   type: 'danger'
            // });
          });
    },
    cancel() {
      this.$modal.hide('room');
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
</style>
