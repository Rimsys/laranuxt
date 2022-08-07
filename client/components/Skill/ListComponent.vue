<template>
  <div>
    <li
      class="col-span-1 bg-white rounded-lg shadow"
      @mouseover="hover = true"
      @mouseleave="hover = false"
    >
      <div v-if="hover" @click="editModalActive = true">
        <Icon-edit class="w-5 h-5 float-right" />
      </div>
      <div class="w-full flex items-center justify-between p-6 space-x-6">
        <div class="flex-1 truncate">
          <div class="flex items-center space-x-3">
            <h3 class="text-gray-900 text-sm leading-5 font-medium truncate">
              {{ skill.name }}
            </h3>
          </div>
        </div>
      </div>

      <div class="w-full rounded-full dark:bg-gray-700 p-5">
        <div
          class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
          :style="{ width: skill.strength + '%' }"
        >
          {{ skill.strength }}%
        </div>
      </div>
    </li>

    <modal-component
      v-if="editModalActive"
      :destroyed="() => (editModalActive = false)"
    >
      <store-component
        :skill="skill"
        @skill-updated="$emit('skill-updated', $event)"
      />
    </modal-component>
  </div>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import ModalComponent from '../ModalComponent.vue'
import StoreComponent from './StoreComponent.vue'
import { Skill } from '@/client/types/api'

export default Vue.extend({
  name: 'SkillListComponent',
  components: { ModalComponent, StoreComponent },
  props: {
    skill: {
      type: Object as PropType<Skill>,
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
