<template>
  <c-form :form-item="formItem"
          :form-data="s_formData">
    <el-form-item>
      <slot></slot>
      <el-button v-if="useBtn"
                 size="small"
                 type="primary"
                 @click="submit">{{
        btnText
        }}</el-button>
    </el-form-item>
  </c-form>
</template>
<script>
import cForm from "@/common/components/Form";
export default {
  components: {
    cForm
  },
  props: {
    formItem: Array,
    formData: {
      type: Object,
      default: null
    },
    getFormData: Function,
    useBtn: {
      type: Boolean,
      default: false
    },
    btnText: {
      type: String,
      default: "提交"
    }
  },
  data: () => ({
    s_formData: null
  }),
  mounted() {
    this.reset();
  },
  methods: {
    reset() {
      this.s_formData = { ...this.formData } || this.getFormData();
    },
    submit() {
      for (const index in this.requiredItems) {
        const key = this.requiredItems[index];
        if (this.s_formData[key] === "") {
          return this.$util.msg.warning("请填写完整！");
        }
      }
      const data = this.$util.retainKeys(
        this.s_formData,
        this.formItem.map(el => el.key)
      );
      this.$emit("submit", data);
    }
  },
  computed: {
    requiredItems() {
      return this.formItem.filter(el => !el.empty).map(el => el.key);
    }
  }
};
</script>