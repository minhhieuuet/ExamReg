<template>
  <modal name="university"
      height="auto"
      :scrollable="true"
      :click-to-close="true"
      @before-open="beforeOpen"
      @before-close="beforeClose"
      >

        <div class="content">
          <div slot="top-right">
            <md-button class="top-right md-icon-button md-accent" @click="$modal.hide('university')">
              <md-icon>close</md-icon>
            </md-button>
          </div>
          <span class="md-title">Tạo trường</span>

          <md-field>
            <label>Tên</label>
            <md-input type="text"
                      v-model="university.name"
                      md-counter="30">
            </md-input>
          </md-field>

          <md-field>
            <label>Tên viết tắt</label>
            <md-input type="text"
                      v-model="university.short_name"
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
      title: 'University',
      editingId: '',
      university: {
        name: '',
        short_name: ''
      }
    }
  },
  methods: {
    beforeOpen (event) {
      this.title = event.params.title;
      if(event.params.universityId) {
        this.editingId = event.params.universityId;
        rf.getRequest('UniversityRequest').show(this.editingId).then((university)=>{
          this.university = university;
        });
      }
    },
    beforeClose() {
      this.editingId = '';
      this.university = {
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
              this.updateOneUniversity();
            } else {
              this.createOneUniversity();
            }
        });
      },
    updateOneUniversity() {
      let params = this.university;
      params = {};
      params.name = this.university.name;
      params.short_name = this.university.short_name;
      rf.getRequest('UniversityRequest').update(this.editingId, params).then((res)=> {
        this.$modal.hide('university');
        this.$emit('refresh');
      });
      this.$toasted.show('Cập nhật trường thành công!', {
        theme: 'bubble',
        position: 'top-right',
        duration : 1500,
        type: 'success'
      });
    },
    createOneUniversity() {
          rf.getRequest('UniversityRequest').store(this.university).then((res)=>{
            this.$modal.hide('university');
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
      this.$modal.hide('university');
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
