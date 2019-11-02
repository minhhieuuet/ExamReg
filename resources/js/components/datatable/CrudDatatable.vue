<template>
  <div>
    <div class="row">
      <div class="col-xl-3 mb-3 pr-0">
        <b-button variant="primary">Thêm mới</b-button>
        <b-button variant="secondary">Làm mới</b-button>
        <b-button variant="danger">Xóa</b-button>
      </div>
      <div class="col-xl-2 mb-3 pr-0">
        <b-form-select>
          <option :value="null">Please select an option</option>
          <option value="a">Option A</option>
          <option value="b" disabled>Option B (disabled)</option>
        </b-form-select>
      </div>
      <div class="col-xl-2 mb-3 pr-0">
        <b-form-select>
          <option :value="null">Please select an option</option>
          <option value="a">Option A</option>
          <option value="b" disabled>Option B (disabled)</option>
        </b-form-select>
      </div>
      <div class="col-xl-3 mb-3 pr-0">
        <b-form-input type="email" name="text"
                      placeholder="Tìm kiếm">
        </b-form-input>
      </div>
      <div class="col-xl-2 mb-3">
        <b-button variant="primary">Tìm kiếm </b-button>
      </div>
    </div>
    <div>
      <data-table :get-data="getData" >
        <th>Username</th>
        <th>Date registered</th>
        <th>Date registered</th>
        <th>Role</th>
        <th>Status</th>
        <template slot="body">

        </template>
      </data-table>
    </div>
  </div>
</template>

<script>
  import DataTable from "./DataTable";
  export default {
    components: { DataTable },
    methods: {
      getData() {
        return new Promise(resolve => {
          return resolve([]);
        })
      }
    }
  }
</script>

<style scoped>

</style>
