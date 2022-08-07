<template>
  <div>
    <div>
      <div class="section-heading text-center pt-10">
        VALUES
      </div>
      <div class="text-center" />
      {{ myvalues }}
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
  name: 'ValueComponent',
  props: { myvalues: String },
})
</script>
