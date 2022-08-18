<template>
  <section>
    <form class="w-full border-b-2 border-gray-200 pb-3 mb-3 mt-5" @submit.prevent="save_education">
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-degree-name">
            Degree Name
          </label>
          <Textinput
            id="name"
            :model-value.sync="local_education.degree_name"
            type="text"
            label="Name"
            required="required"
            class="appearance-none block w-full text-gray-700 border border-blue-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          />
        </div>
        <div class="w-full md:w-1/2 px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-university-name">
            University Name
          </label>
          <Textinput
            id="name"
            :model-value.sync="local_education.university_name"
            type="text"
            label="Name"
            required="required"
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
            :model-value.sync="local_education.from_date"
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
            :model-value.sync="local_education.to_date"
            type="date"
            label="Name"
            required="required"
            class="appearance-none block w-full text-gray-700 border border-blue-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          />
        </div>
      </div>

      <div class="w-full flex justify-center">
        <button
          class="flex items-center justify-center bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-md border-4 text-white py-2 px-3 rounded"
          type="submit"
          :disabled="update_state"
        >
          <svg v-if="update_state" class="mr-3 h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
          {{ update_state ? 'saving...' : 'SAVE' }}
        </button>
        <button
          class="ml-2 bg-white text-md py-2 px-3 rounded"
          type="button"
          @click.once="$emit('close_education')"
        >
          CANCEL
        </button>
      </div>
    </form>
  </section>
</template>

<script lang="ts">
import Vue from 'vue'
import { Education } from '@/types/api'
export default Vue.extend({
  name: 'EditEducation',
  props: {
    education: {
      required: true,
      type: Object as () => Education,
    },
  },
  data () {
    const local_education = {} as Education
    const update_state:boolean = false
    return {
      local_education,
      update_state,
    }
  },
  mounted () {
    this.local_education = this.education
  },
  methods: {
    async save_education ():Promise<void> {
      this.update_state = true
      const data = {
        degree_name: this.local_education.degree_name,
        university_name: this.local_education.university_name,
        from_date: this.local_education.from_date,
        to_date: this.local_education.to_date,
      }

      const url = 'educations/' + this.local_education.id
      await this.$axios.put(url, data).then(() => {
        this.update_state = false
        this.$toast.show({
          type: 'success',
          title: 'Success',
          message: 'Education Update Successfully',
        })
        this.$emit('close_education')
      }).catch(() => {
        this.update_state = false
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
