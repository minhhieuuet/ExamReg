<template>
  <modal name="test-site"
      height="auto"
      :scrollable="true"
      :click-to-close="true"
      @before-open="beforeOpen"
      @before-close="beforeClose"
      >

        <div class="content">
          <div slot="top-right">
            <md-button class="top-right md-icon-button md-accent" @click="$modal.hide('test-site')">
              <md-icon>close</md-icon>
            </md-button>
          </div>
          <span class="md-title">{{title}}</span>

          <md-field>
            <label>Tên điểm thi</label>
            <md-input type="text"
                      v-model="testSite.name"
                      md-counter="30">
            </md-input>
          </md-field>

          <md-card-content>
              <label>Kỳ thi</label>
              <multiselect v-model="selectedExam"
              track-by = "id"
              openDirection = "top"
              label="name" :options="exams" :searchable="false" :close-on-select="false" :show-labels="false" placeholder="Vui lòng chọn"></multiselect>
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
      title: 'Test Site',
      exams: [],
      editingId: '',
      selectedExam: '',
      testSite: {
        name: '',
        exam_id: ''
      }
    }
  },
  methods: {
    beforeOpen (event) {
      this.title = event.params.title;
      if(event.params.testSiteId) {
        this.editingId = event.params.testSiteId;
        rf.getRequest('TestSiteRequest').show(this.editingId).then((testSite)=>{
          this.testSite = testSite;
          this.selectedExam = this.exams.find(exam => exam.id == testSite.exam_id);
        });
      }
    },
    beforeClose() {
      this.editingId = '';
      this.testSite = {
        name: '',
        exam_id: ''
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
              this.updateOneTestSite();
            } else {
              this.createOneTestSite();
            }
        });
      },
    updateOneTestSite() {
      let params = this.testSite;
      params.exam_id = this.selectedExam.id;
      rf.getRequest('TestSiteRequest').update(this.editingId, params).then((res)=> {
        this.$modal.hide('test-site');
        this.$emit('refresh');
      });
      this.$toasted.show('Cập nhật điểm thi thành công!', {
        theme: 'bubble',
        position: 'top-right',
        duration : 1500,
        type: 'success'
      });
    },
    createOneTestSite() {
          let params = this.testSite;
          params.exam_id = this.selectedExam.id;
          rf.getRequest('TestSiteRequest').store(params).then((res)=>{
            this.$modal.hide('test-site');
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
      this.$modal.hide('test-site');
    }
  },
  created () {
    rf.getRequest('TestSiteRequest').getAllExams().then(res => {
      this.exams = res;
    });
  }
}
</script>

<style lang="scss" scoped >
.multiselect {
  z-index: 1000 !important;
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
