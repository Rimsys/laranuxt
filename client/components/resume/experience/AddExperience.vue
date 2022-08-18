<template>
  <section>
    <div v-if="!show_add_experiemce_form" class="w-full flex justify-center mb-3 border-b-2 border-gray-200 pb-3">
      <button
        class="bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-md border-4 text-white py-2 px-3 rounded mt-3"
        type="button"
        @click="show_add_experiemce_form = !show_add_experiemce_form"
      >
        ADD EXPERIENCE
      </button>
    </div>

    <form v-if="show_add_experiemce_form" class="w-full border-b-2 border-gray-200 pb-3 mb-3" @submit.prevent="save_experience">
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-company-name">
            Company Name
          </label>
          <Textinput
            id="name"
            :model-value.sync="experience.company_name"
            type="text"
            label="Name"
            required="required"
            placeholder="ABC Pvt ltd"
            class="appearance-none block w-full text-gray-700 border border-blue-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          />
        </div>
        <div class="w-full md:w-1/2 px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-job-title">
            Job Title
          </label>
          <Textinput
            id="name"
            :model-value.sync="experience.job_title"
            type="text"
            label="Name"
            required="required"
            placeholder="Full stack developer"
            class="appearance-none block w-full text-gray-700 border border-blue-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          />
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-github">
            From Date
          </label>
          <Textinput
            id="name"
            :model-value.sync="experience.from_date"
            type="date"
            label="Name"
            required="required"
            class="appearance-none block w-full text-gray-700 border border-blue-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          />
        </div>
        <div class="w-full md:w-1/2 px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-linkedin">
            To Date
          </label>
          <Textinput
            id="name"
            :model-value.sync="experience.to_date"
            type="date"
            label="Name"
            required="required"
            class="appearance-none block w-full text-gray-700 border border-blue-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          />
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-mobile-no">
            Responsiblities
          </label>
          <textarea-input
            id="description"
            :model-value.sync="experience.responsibilities"
            type="tel"
            required="required"
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            label="Description"
          />
        </div>
      </div>

      <div class="w-full flex justify-center">
        <button
          class="flex items-center justify-center bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-md border-4 text-white py-2 px-3 rounded"
          type="submit"
          :disabled="add_state"
        >
          <svg v-if="add_state" class="mr-3 h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle
              class="opacity-25"
              cx="12"
              cy="12"
              r="10"
              stroke="currentColor"
              stroke-width="4"
            />
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
          </svg>
          {{ add_state ? 'saving...' : 'SAVE' }}
        </button>
        <button
          class="ml-2 bg-white text-md py-2 px-3 rounded"
          type="button"
          @click.once="show_add_experiemce_form = !show_add_experiemce_form"
        >
          CANCEL
        </button>
      </div>
    </form>
  </section>
</template>

<script lang="ts">
import Vue from 'vue'
import { Experience } from '@/types/api'
export default Vue.extend({
  name: 'AddExperience',
  data () {
    const show_add_experiemce_form:boolean = false
    const experience = {} as Experience
    const add_state:boolean = false
    return {
      show_add_experiemce_form,
      experience,
      add_state,
    }
  },
  methods: {
    async save_experience ():Promise<void> {
      this.add_state = true
      const data = {
        company_name: this.experience.company_name,
        job_title: this.experience.job_title,
        from_date: this.experience.from_date,
        to_date: this.experience.to_date,
        responsibilities: this.experience.responsibilities,
      }

      await this.$axios.post('experiences', data).then(() => {
        this.add_state = false
        this.show_add_experiemce_form = !this.show_add_experiemce_form
        this.$toast.show({
          type: 'success',
          title: 'Success',
          message: 'Experience Added Successfully',
        })
        this.$emit('refresh_experience')
      }).catch(() => {
        this.add_state = false
        this.$toast.show({
          type: 'danger',
          title: 'Error',
          message: 'Oops, something went wrong',
        })
      })
    },
  },
})
</script>
