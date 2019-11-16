<template>
  <div :style="{width: widthTable}">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-sm dataTable no-footer dtr-inline">
        <thead>
        <tr @click="onSort">
          <slot/>
        </tr>
        </thead>
        <tbody>
        <slot name="first_row"/>
        <slot name="body" v-for="(row, index) in rows" :item="row" :index="index"/>
        <template v-if="emptyData">
          <tr v-for="erow in emptyRow" :key="erow">
            <td v-for="ecol in column" :key="ecol">{{ msgEmptyData || '' }}</td>
          </tr>
        </template>
        <slot name="end_row"/>
        </tbody>
      </table>

      <template v-if="lastPage > 1">
        <pagination ref="pagination"
                    class="text-center"
                    :per-page="perPage"
                    :records="totalRecord"
                    :chunk="chunk"
                    @Pagination:page="onPageChange" :pageParent="page">
        </pagination>
      </template>
    </div>
  </div>
</template>

<script>
  import Pagination from './Pagination';

  export default {
    components: {
      Pagination
    },
    props: {
      getData: {
        type: Function,
      },
      limit: {
        type: Number,
        default: 10
      },
      chunk: {
        type: Number,
        default: 6
      },
      widthTable: {
        type: String,
        default: '100%'
      },
      msgEmptyData: {
        type: String
      }
    },
    data() {
      return {
        maxPageWidth: 10,
        totalRecord: 0,
        lastPage: 0,
        page: 1,
        perPage: 10,
        column: 0,
        fetching: false,
        rows: [],
        params: {},

        orderBy: null,
        sortedBy: null,

        emptyData: false,
      };
    },
    computed: {
      emptyRow() {
        let emptyRowCount = Math.max(this.limit - _.size(this.rows), 0);
        return Math.min(emptyRowCount, this.limit);
      }
    },
    methods: {
      onPageChange(page) {
        this.page = page;
        this.fetch();
      },

      getTarget(target) {
        let node = target;
        while (node.parentNode.nodeName !== 'TR') {
          node = node.parentNode;
        }
        return node;
      },

      getSortOrder(target) {
        let sortOrder = target.dataset.sortOrder;
        switch (sortOrder) {
          case 'asc':
            sortOrder = '';
            break;
          case 'desc':
            sortOrder = 'asc';
            break;
          default:
            sortOrder = 'desc';
        }
        return sortOrder;
      },

      setSortOrders(target, sortOrder) {
        let iterator = target.parentNode.firstChild;
        while (iterator) {
          iterator.dataset.sortOrder = '';
          iterator = iterator.nextElementSibling;
        }
        target.dataset.sortOrder = sortOrder;
      },

      onSort(event) {
        const target = this.getTarget(event.target);
        const orderBy = target.dataset.sortField;
        if (!orderBy) {
          return
        }
        this.sortedBy = this.getSortOrder(target);
        this.orderBy = this.sortedBy ? orderBy : '';
        Object.assign(this.params, {sort: this.orderBy, sort_type: this.sortedBy});
        this.setSortOrders(target, this.sortedBy);
        this.fetch();
      },

      fetch() {
        const meta = {
          page: this.page,
          limit: this.limit
        };

        this.fetching = true;
        this.getData(Object.assign(meta, this.params)).then((res) => {
          const data = res.data;
          if (!data) {
            this.emptyData = window._.isEmpty(this.rows) < this.perPage;
            return;
          }
          this.column = _.chain(this.$slots.default).filter((el) => {return el.tag === 'th'}).value().length;

          if (!data.data) {
            this.rows = data;
            this.emptyData = window._.isEmpty(this.rows) < this.perPage;
            this.page = parseInt(res.current_page);
            this.totalRecord = parseInt(res.total);
            this.lastPage = parseInt(res.last_page);
            this.perPage = parseInt(res.per_page);
            this.$emit('DataTable:finish');
            return;
          }
          this.page = parseInt(data.current_page);
          this.totalRecord = parseInt(data.total);
          this.lastPage = parseInt(data.last_page);
          this.perPage = parseInt(data.per_page);
          this.rows = data.data;

          this.emptyData = window._.isEmpty(this.rows);
          this.$emit('DataTable:finish');
        }).then((res) => {
          this.fetching = false;
        });
      },
      refresh() {
        this.page = 1;
        this.params = {};
        this.fetch();
      },

      filter(params) {
        this.page = 1;
        this.params = params;
        this.fetch();
      }
    },
    created() {
      this.fetch();
      this.$on('DataTable:filter', (params) => {
        this.filter(params);
      });
    },
    mounted() {
      this.column = _.chain(this.$slots.default).filter((el) => {return el.tag === 'th'}).value().length;
    }
  };
</script>

<style lang="scss" scoped>
  table {
    width: 100%;
  }
  table thead th {
    padding: 12px !important;
  }

  table tbody td {
    padding: 0px 12px !important;
    vertical-align: middle;
  }

  th {
    text-align: center;
    font-size: 17px;
  }
  ul {
  width: 100%;
}

td, th {
  border-top: 1px solid #dfe2e5;
  padding: 8px;
}


th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  color: #4CAF50;
  font-weight: normal;
  text-align: center;
  border-bottom: 1px solid #dfe2e5;
}
</style>
