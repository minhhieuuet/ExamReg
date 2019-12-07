<template>
  <modal name="module"
      height="auto"
      :scrollable="true"
      :click-to-close="true"
      @before-open="beforeOpen"
      @before-close="beforeClose"
      >

        <div class="content">
          <div slot="top-right">
            <md-button class="top-right md-icon-button md-accent" @click="$modal.hide('module')">
              <md-icon>close</md-icon>
            </md-button>
          </div>
          <span class="md-title">Tạo học phần</span>

          <md-field>
            <label>Tên học phần</label>
            <md-input type="text"
                      v-model="module.name"
                      md-counter="30">
            </md-input>
          </md-field>

          <md-field>
            <label>Mã học phần</label>
            <md-input type="text"
                      v-model="module.code"
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
      title: 'Module',
      editingId: '',
      module: {
        name: '',
        code: ''
      }
    }
  },
  methods: {
    beforeOpen (event) {
      this.title = event.params.title;
      if(event.params.moduleId) {
        this.editingId = event.params.moduleId;
        rf.getRequest('ModuleRequest').show(this.editingId).then((module)=>{
          this.module = module;
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
              this.updateOneModule();
            } else {
              this.createOneModule();
            }
        });
      },
    updateOneModule() {
      let params = this.module;
      params = {};
      params.name = this.module.name;
      params.code = this.module.code;
      rf.getRequest('ModuleRequest').update(this.editingId, params).then((res)=> {
        this.$modal.hide('module');
        this.$emit('refresh');
      });
      this.$toasted.show('Cập nhật trường thành công!', {
        theme: 'bubble',
        position: 'top-right',
        duration : 1500,
        type: 'success'
      });
    },
    createOneModule() {
          rf.getRequest('ModuleRequest').store(this.module).then((res)=>{
            this.$modal.hide('module');
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
      this.$modal.hide('module');
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
