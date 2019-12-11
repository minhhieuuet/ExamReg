<template>
  <modal name="test-room"
      height="auto"
      width="800px"
      :scrollable="true"
      :click-to-close="true"
      @before-open="beforeOpen"
      @before-close="beforeClose"
      >

        <div class="content">
          <div slot="top-right">
            <md-button class="top-right md-icon-button md-accent" @click="$modal.hide('test-room')">
              <md-icon>close</md-icon>
            </md-button>
          </div>
          <span class="md-title">{{title}}</span>

          <md-field>
            <label>Tên phòng thi</label>
            <md-input type="text"
                      v-model="testRoom.name"
                      md-counter="30">
            </md-input>
          </md-field>

          <md-card-content>
              <label>Phòng máy</label>
              <select class="select-css" v-model="selectedRoomId">
                <option v-for="room in rooms" :value="room.id">{{room.name}}</option>
              </select>
          </md-card-content>
          <md-card-content>
              <label>Ca thi</label>
              <select class="select-css" v-model="selectedExamSessionId">
                <option v-for="examSession in examSessions" :value="examSession.id">
                  {{examSession.module_code}} [{{examSession.module_name}}]
                  |
                   {{examSession.started_at | toTimeFormat}} - {{examSession.finished_at | toTimeFormat}}
                   {{examSession.started_at | toDateFormat}}
                   |
                   {{examSession.test_site_name}}
                </option>
              </select>
          </md-card-content>
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
      title: 'Test Room',
      rooms:[],
      examSessions:[],
      editingId: '',
      selectedExamSessionId: '',
      selectedRoomId: '',
      testRoom: {
        name: '',
        room_id: '',
        exam_session_id: ''
      }
    }
  },
  methods: {
    beforeOpen (event) {
      this.title = event.params.title;
      if(event.params.testRoomId) {
        this.editingId = event.params.testRoomId;
        rf.getRequest('TestRoomRequest').show(this.editingId).then((testRoom)=>{
          this.testRoom = testRoom;
          this.selectedRoomId = testRoom.room_id;
          this.selectedExamSessionId = testRoom.exam_session_id;
        });
      }
    },
    beforeClose() {
      this.editingId = '';
      this.module = {
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
              this.updateOneTestRoom();
            } else {
              this.createOneTestRoom();
            }
        });
      },
    updateOneTestRoom() {
      let params = this.testRoom;
      params.room_id = this.selectedRoomId;
      params.exam_session_id = this.selectedExamSessionId;
      rf.getRequest('TestRoomRequest').update(this.editingId, params).then((res)=> {
        this.$modal.hide('test-room');
        this.$emit('refresh');
      });
      this.$toasted.show('Cập nhật phòng thi thành công!', {
        theme: 'bubble',
        position: 'top-right',
        duration : 1500,
        type: 'success'
      });
    },
    createOneTestRoom() {
          let params = this.testRoom;
          params.room_id = this.selectedRoomId;
          params.exam_session_id = this.selectedExamSessionId;
          rf.getRequest('TestRoomRequest').store(params).then((res)=>{
            this.$modal.hide('test-room');
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
      this.$modal.hide('test-room');
    }
  },
  created () {
    rf.getRequest('TestRoomRequest').getAllExamSessions().then((examSessions)=>{
      this.examSessions = examSessions;
    });

    rf.getRequest('TestRoomRequest').getAllRooms().then((rooms)=>{
      this.rooms = rooms;
    });
  }
}
</script>

<style lang="scss" scoped >
.select-css {
    display: block;
    font-size: 16px;
    font-family: sans-serif;
    font-weight: 700;
    color: #444;
    line-height: 1.3;
    padding: .6em 1.4em .5em .8em;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    margin: 0;
    border: 1px solid #aaa;
    box-shadow: 0 1px 0 1px rgba(0,0,0,.04);
    border-radius: .5em;
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    background-color: #fff;
    background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
      linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
    background-repeat: no-repeat, repeat;
    background-position: right .7em top 50%, 0 0;
    background-size: .65em auto, 100%;
}
.select-css::-ms-expand {
    display: none;
}
.select-css:hover {
    border-color: #888;
}
.select-css:focus {
    border-color: #aaa;
    box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
    box-shadow: 0 0 0 3px -moz-mac-focusring;
    color: #222;
    outline: none;
}
.select-css option {
    font-weight:normal;
}
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
