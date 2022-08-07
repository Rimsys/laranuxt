<template>
  <div>
    <p class="pt-5"><b>Interest: </b></p>
    <div
      v-for="(interest, index) in interests"
      :key="index"
      class="flex flex-row space-x-4"
    >
      <div>{{ interest }}</div>
    </div>
  </div>
</template>
<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { BioData } from '@/client/types/api'
export default Vue.extend({
  name: 'InterestComponent',
  props: {
    interests: {
      type: Array as PropType<BioData>,
      required: true,
    },
  },
})
</script>
