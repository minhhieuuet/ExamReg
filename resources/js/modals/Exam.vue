<template>
  <modal name="exam"
      height="auto"
      :scrollable="true"
      :click-to-close="true"
      @before-open="beforeOpen"
      @before-close="beforeClose"
      >

        <div class="content">
          <div slot="top-right">
            <md-button class="top-right md-icon-button md-accent" @click="$modal.hide('exam')">
              <md-icon>close</md-icon>
            </md-button>
          </div>
          <span class="md-title">Sửa kỳ thi</span>

          <md-field>
            <label>Tên</label>
            <md-input type="text"
                      v-model="exam.name"
                      md-counter="30">
            </md-input>
          </md-field>


            <md-datepicker v-model="exam.register_started_at">
              <label>Bắt đầu</label>
            </md-datepicker>

          <md-field>
            <md-datepicker v-model="exam.register_finished_at">
              <label>Kết thúc</label>
            </md-datepicker>
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
import moment from 'moment';
export default {
  data () {
    return {
      title: 'Exam',
      editingId: '',
      exam: {
        name: '',
        register_started_at: '',
        register_finished_at: ''
      }
    }
  },
  watch: {
    register_started_at (newVal) {
      this.register_started_at = moment(newVal).format('x');
    }
  },
  methods: {
    beforeOpen (event) {
      this.title = event.params.title;
      if(event.params.examId) {
        this.editingId = event.params.examId;
        rf.getRequest('ExamRequest').show(this.editingId).then((exam)=>{
          this.exam.name = exam.name;
          // console.log(moment(exam.register_started_at))
          this.exam.register_started_at = moment(exam.register_started_at).format('YYYY-MM-DD');
          this.exam.register_finished_at = moment(exam.register_finished_at).format('YYYY-MM-DD');
        });
      }
    },
    beforeClose() {
      this.editingId = '';
      this.exam = {
        name: '',
        register_started_at: '',
        register_finished_at: ''
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
              this.updateOneExam();
            } else {
              this.createOneExam();
            }
        });
      },
    updateOneExam() {
      let params = this.exam;
      params = {};
      params.name = this.exam.name;
      params.register_started_at = moment(this.exam.register_started_at, 'YYYY-MM-DD').format('x');
      params.register_finished_at = moment(this.exam.register_finished_at, 'YYYY-MM-DD').format('x');
      rf.getRequest('ExamRequest').update(this.editingId, params).then((res)=> {
        this.$modal.hide('exam');
        this.$emit('refresh');
      });
      this.$toasted.show('Cập nhật kỳ thi thành công!', {
        theme: 'bubble',
        position: 'top-right',
        duration : 1500,
        type: 'success'
      });
    },
    createOneExam() {
          let params = this.exam;
          params.register_started_at = moment(this.exam.register_started_at, 'YYYY-MM-DD').format('x');
          params.register_finished_at = moment(this.exam.register_finished_at, 'YYYY-MM-DD').format('x');
          rf.getRequest('ExamRequest').store(params).then((res)=>{
            this.$modal.hide('exam');
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
      this.$modal.hide('exam');
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
