<template>
  <input
    :id="id"
    ref="input"
    :type="type"
    :value="modelValue"
    :required="required"
    v-bind="{ ...$attrs, class: null }"
    @input="$emit('update:modelValue', $event.target.value)"
  >
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
  props: {
    id: {
      required: true,
      type: String,
    },
    type: {
      default: 'text',
      type: String,
    },
    required: {
      default: false,
      type: Boolean,
    },
    errors: {
      type: Array,
      default: () => [],
    },
    modelValue: [String, Number],
  },
})
</script>
