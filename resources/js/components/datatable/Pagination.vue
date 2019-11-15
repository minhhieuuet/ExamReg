<template>
  <div>
    <div class="VuePagination">
      <ul v-show="totalPages > 1"
          class="pagination VuePagination__pagination">

        <!--<li class="VuePagination__pagination-item page-item VuePagination__pagination-item-prev-chunk "-->
            <!--:class="{disabled : !allowedChunk(-1)}">-->
          <!--<a class="page-link" href="javascript:void(0);"-->
             <!--@click="setChunk(-1)">&lt;&lt;</a>-->
        <!--</li>-->


        <li class="VuePagination__pagination-item page-item VuePagination__pagination-item-prev-page page-prev"
            :class="{disabled : !allowedPage(page - 1)}">
          <a class="page-link " href="javascript:void(0);"
             @click="prev()">Trang trước</a>
        </li>

        <template v-for="item in pages">
          <li class="VuePagination__pagination-item page-item "
              :class="{active: parseInt(page) === parseInt(item)}">
            <a class="page-link" role="button"
               @click="setPage(item)">{{item}}</a>
          </li>
        </template>

        <li class="VuePagination__pagination-item page-item VuePagination__pagination-item-next-page page-next"
            :class="{disabled : !allowedPage(page + 1)}">
          <a class="page-link" href="javascript:void(0);"
             @click="next()">Trang kế</a>
        </li>

        <!--<li class="VuePagination__pagination-item page-item VuePagination__pagination-item-next-chunk "-->
            <!--:class="{disabled : !allowedChunk(1)}">-->
          <!--<a class="page-link" href="javascript:void(0);"-->
             <!--@click="setChunk(1)">&gt;&gt;</a>-->
        <!--</li>-->
      </ul>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      pageParent: {
        type: Number,
        default: 1,
      },
      records: {
        type: Number,
        required: true
      },
      chunk: {
        type: Number,
        required: false,
        default: 6
      },
      perPage: {
        type: Number,
        required: true,
      },
    },
    data: function () {
      return {
        page: this.pageParent,
      }
    },
    watch: {
      records() {
        if (this.page > this.totalPages) {
          this.page = 1;
        }
      },
      pageParent() {
        this.page = this.pageParent;
      }
    },
    computed: {
      pages: function () {
        if (!this.records)
          return []

        return range(this.paginationStart, this.chunk, this.totalPages)
      },
      totalPages: function () {
        return this.records ? Math.ceil(this.records / this.perPage) : 1
      },
      totalChunks: function () {
        return Math.ceil(this.totalPages / this.chunk)
      },
      currentChunk: function () {
        return Math.ceil(this.page / this.chunk)
      },
      paginationStart: function () {
        return ((this.currentChunk - 1) * this.chunk) + 1
      },
      pagesInCurrentChunk: function () {

        return this.paginationStart + this.chunk <= this.totalPages ? this.chunk : this.totalPages - this.paginationStart + 1

      },
    },
    methods: {
      setPage: function (page) {
        if (this.allowedPage(page)) {
          this.paginate(page)
        }
      },
      paginate (page) {
        this.page = page
        this.$emit('Pagination:page', page)
      },
      next: function () {
        return this.setPage(this.page + 1)
      },
      prev: function () {
        return this.setPage(this.page - 1)
      },
      setChunk: function (direction) {
        this.setPage((((this.currentChunk - 1) + direction) * this.chunk) + 1)
      },
      allowedPage: function (page) {
        return page >= 1 && page <= this.totalPages
      },
      allowedChunk: function (direction) {
        return (parseInt(direction) === 1 && this.currentChunk < this.totalChunks)
          || (parseInt(direction) === -1 && this.currentChunk > 1)
      },
      allowedPageClass: function (direction) {
        return this.allowedPage(direction) ? '' : 'disabled'
      },
      allowedChunkClass: function (direction) {
        return this.allowedChunk(direction) ? '' : 'disabled'
      },
      activeClass: function (page) {
        return parseInt(this.page) === parseInt(page) ? 'active' : ''
      }
    }
  }

  function range (start, chunk, total) {
    if( start + chunk > total) {
      start = Math.max(total - chunk + 1, 1);
    }
    var end = chunk > total ? total : chunk;
    return Array.apply(0, Array(end))
      .map(function (element, index) {
        return index + start
      })
  }
</script>

<style lang="scss" scoped>
  .pagination {
    list-style-type: none !important;
    padding-bottom: 31px !important;
  }
  .page-item {
    &.active {
      a {
        background-color: rgb(0, 112, 192);
        color: white;
      }
    }
    a {
      position: relative;
      float: left;
      padding: 5px 12px;
      width: auto;
      line-height: 1.6;
      text-decoration: none;
      color: black;
      background-color: #fff;
      border: 1px solid #ddd;
      margin-left: -1px;
      border-radius: 4px;
      margin-right: 9px;
      font-size: 13px;
      height: 31px;
      cursor: pointer;
      &:hover {
        background-color: #fff;
        color: black;
      }
      &:link {
        background-color: #fff;
        color: black;
      }
    }
  }
  .page-prev {
    a {
      transform: scale(0.9,1);
      // &:before {
      //     content: "\e257";
      // }
    }
  }
  .page-next {
    a {
      transform: scale(0.9,1);
      // &:before {
      //     content: "\e258";
      // }
    }
  }
</style>
