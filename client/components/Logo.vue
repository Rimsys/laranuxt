<template>
  <div class="flex items-center">
    <IconLaravel class="w-16 h-16 -mt-8" primary="text-red-500" />
    <IconNuxt class="w-16 h-16 -ml-6 mt-8" />
  </div>
</template>
<script lang="ts">
import Vue from 'vue'
import { IconLaravel, IconNuxt } from 'tv-icon'
export default Vue.extend({
  name: 'Logo',
  components: { IconLaravel, IconNuxt },
})
</script>
