<template>
  <el-Pagination background
                 small
                 layout="total, prev, pager, next, jumper"
                 :total="module.total"
                 :current-page.sync="module.current_page"
                 :page-size.sync="module.per_page"
                 :page-sizes="module.page_sizes"
                 @current-change="handleCurrentChange"
                 @size-change="handleSizeChange">
  </el-Pagination>
</template>
<script>
export default {
  props: {
    module: Object
  },
  methods: {
    getData() {
      this.$emit("get-data");
    },
    handleCurrentChange() {
      this.getData();
    },
    handleSizeChange(val) {
      this.getData();
    }
  }
};
</script>
