<template>
  <modal
    ref="modal"
    title="选择单词本"
    @open="open"
    @submit="submit"
  >
    <template slot="btn">
      <el-button icon="el-icon-tickets">选择单词本</el-button>
    </template>
    <template slot="body">
      <el-select
        v-model="value"
        placeholder="请选择单词本"
      >
        <el-option
          v-for="item in book.data"
          :key="item.id"
          :label="item.name"
          :value="item.id"
        >
          <div class="option-box">
            <span>{{ item.name }}</span>
            <span>{{ item.english_count }}</span>
          </div>
        </el-option>
      </el-select>
    </template>
  </modal>
</template>
<script>
import Modal from "@/common/components/Modal";
import { mapMutations, mapState } from "vuex";
export default {
  components: {
    Modal,
  },
  data: () => ({
    value: ""
  }),
  methods: {
    ...mapMutations({
      updateCurrent: "book",
      updatebook_id: "english"
    }),
    open() {
      this.value = this.book.current_id;
    },
    async submit() {
      this.updatebook_id({
        book_id: this.value
      });
      this.updateCurrent({
        current_id: this.value
      });
      this.$refs.modal.hidden();
    }
  },
  computed: {
    ...mapState(["book"])
  }
};
</script>
<style lang="scss" scoped>
button {
  width: 100%;
}
.option-box {
  @include flex;
  justify-content: space-between;
}
</style>
