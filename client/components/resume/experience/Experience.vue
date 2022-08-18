<template>
  <div>
    <li
      v-if="!enable_edit"
      class="bg-white px-3 py-2 flex justify-between mb-2"
    >
      <span>{{ experience.company_name }} | {{ experience.job_title }} ({{ experience.from_date | formatDate }} - {{ experience.to_date | formatDate }})</span>
      <span>
        <span
          type="button"
          class="text-blue-700 cursor-pointer"
          @click.once="edit()"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
            />
            <path
              fill-rule="evenodd"
              d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
              clip-rule="evenodd"
            />
          </svg>
        </span>
        <span
          type="button"
          class="text-red-500 cursor-pointer"
          @click.once="$emit('deleteExperience',experience.id)"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
              clip-rule="evenodd"
            />
          </svg>
        </span>
      </span>
    </li>
    <edit-experience v-if="enable_edit" :experience="experience" @close_experience="enable_edit = !enable_edit" />
  </div>
</template>
<script lang="ts">
import Vue from 'vue'
import EditExperience from './EditExperience.vue'
import { Experience } from '@/types/api'
export default Vue.extend({
  components: { EditExperience },
  filters: {
    formatDate: (dateStr: string) =>
      Intl.DateTimeFormat('us-EN').format(new Date(dateStr)),
  },
  props: {
    experience: {
      required: true,
      type: Object as () => Experience,
    },
  },
  data () {
    const enable_edit:boolean = false
    return {
      enable_edit,
    }
  },
  methods: {
    edit ():void {
      this.enable_edit = !this.enable_edit
    },
  },
})
</script>
