<template>
  <div class="w-full max-w-xs">
    <form class="mb-3" @submit.prevent="storeExperienceData">
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="company_name"
        >
          Company Name
        </label>
        <input
          id="company_name"
          v-model="experienceToUpdate.company_name"
          name="company_name"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          type="text"
        >
      </div>
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="position"
        >
          Position
        </label>
        <input
          id="position"
          v-model="experienceToUpdate.position"
          name="position"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          type="text"
          placeholder="position"
        >
      </div>
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="start_date"
        >
          Start Date
        </label>
        <input
          id="start_date"
          v-model="experienceToUpdate.start_date"
          name="start_date"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          type="date"
          placeholder="start date"
        >
      </div>
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="end_date"
        >
          End Date
        </label>
        <input
          id="end_date"
          v-model="experienceToUpdate.end_date"
          name="end_date"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          type="date"
          placeholder="end date"
        >
      </div>
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="responsibilities"
        >
          Responsibilities
        </label>
        <input
          id="responsibilities"
          v-model="experienceToUpdate.responsibilities"
          name="responsibilities"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          type="text"
          placeholder="responsibilities"
        >
      </div>
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="is_current_position"
        >
          Is Current Position
        </label>
        <select
          id="is_current_position"
          v-model="experienceToUpdate.is_current_position"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        >
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
      </div>
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
      >
        Save
      </button>
    </form>
  </div>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { Experiencies } from '@/client/types/api'
export default Vue.extend({
  name: 'StoreExperience',
  props: {
    experience: {
      type: Object as PropType<Experiencies>,
      required: true,
    },
  },
  data () {
    return {
      experienceToUpdate: {
        company_name: '',
        position: '',
        start_date: '',
        end_date: '',
        responsibilities: [],
        is_current_position: false,
      },
    }
  },
  mounted () {
    this.setExperienceToUpdate()
  },

  methods: {
    setExperienceToUpdate () {
      this.experienceToUpdate = {
        ...this.experience,
        responsibilities: this.experience.responsibilities.join(','),
      }
    },

    async storeExperienceData () {
      await this.$axios
        .patch(
          `experience/update/${this.experience.id}`,
          this.experienceToUpdate,
        )
        .then(() => {
          this.$emit('experience-updated', {
            initial: this.experience,
            updated: this.experienceToUpdate,
          })
        })
        .catch((error) => {
          this.$toast.danger(error.response.data.message)
        })
    },
  },
})
</script>
