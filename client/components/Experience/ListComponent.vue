<template>
  <li
    class="col-span-1 bg-white rounded-lg shadow "
    @mouseover="hover = true"
    @mouseleave="hover = false"
  >
    <div v-if="hover" @click="editModalActive = true">
      <Icon-edit class="w-5 h-5 float-right" />
    </div>
    <div class="w-full flex items-center justify-between p-6 space-x-6">
      <div class="flex-1 ">
        <div class="flex items-center space-x-3">
          <h3 class="text-gray-800 text-sm  font-medium">
            {{ experience.company_name }}
          </h3>
        </div>
        <p class="mt-1 text-gray-400 text-sm leading-5 ">
          {{ experience.position }}
        </p>
      </div>
      <div>
        <span
          class="flex-shrink-0 inline-block px-2 text-teal-800 text-xs leading-4 font-small bg-green-100 rounded-full py-0.5"
        >
          {{ experience.start_date }} -
          {{ experience.is_current_position ? 'current' : experience.end_date }}
        </span>
      </div>
    </div>
    <div class="border-t border-gray-200">
      <ul class="list-disc p-8">
        <li
          v-for="(responsibility, index) in experience.responsibilities"
          :key="index"
        >
          {{ responsibility }}
        </li>
      </ul>
    </div>
    <modal-component
      v-if="editModalActive"
      :destroyed="() => (editModalActive = false)"
    >
      <store-component
        :experience="experience"
        @experience-updated="$emit('experience-updated', $event)"
      />
    </modal-component>
  </li>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import ModalComponent from '../ModalComponent.vue'
import StoreComponent from './StoreComponent.vue'
import { Experiencies } from '@/client/types/api'
export default Vue.extend({
  name: 'ExperienceListComponent',
  components: { ModalComponent, StoreComponent },
  props: {
    experience: {
      type: Object as PropType<Experiencies>,
      required: true,
    },
  },
  data () {
    return {
      hover: false,
      editModalActive: false,
    }
  },
})
</script>
