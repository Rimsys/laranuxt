<template>
  <section>
    <div v-if="!show_add_hobby_form" class="w-full flex justify-center mb-3 border-b-2 border-gray-200 pb-3">
      <button
        class="bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-md border-4 text-white py-2 px-3 rounded mt-3"
        type="button"
        @click="show_add_hobby_form = !show_add_hobby_form"
      >
        ADD Hobby
      </button>
    </div>

    <form v-if="show_add_hobby_form" class="w-full border-b-2 border-gray-200 pb-3 mb-3" @submit.prevent="save_hobby">
      <div class="flex items-center border-b border-teal-500 py-2">
        <Textinput
          id="name"
          :model-value.sync="hobby.hobby_name"
          type="text"
          label="Name"
          required="required"
          placeholder="Hobby Name"
          class="appearance-none block w-full text-gray-700 border border-blue-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        />

        <button
          class="flex items-center justify-center bg-blue-500 hover:bg-blue-700 border-blue-500 hover:text-md border-4 text-white py-2 px-3 rounded"
          type="submit"
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
          class="border-white bg-white border-4 text-teal-500 hover:text-teal-800 text-md py-2 px-2 rounded"
          type="button"
          @click.once="show_add_hobby_form = !show_add_hobby_form"
        >
          Cancel
        </button>
      </div>
    </form>
  </section>
</template>

<script lang="ts">
import Vue from 'vue'
import { Hobby } from '@/types/api'
export default Vue.extend({
  name: 'AddHobby',
  data () {
    const show_add_hobby_form:boolean = false
    const hobby = {} as Hobby
    const add_state:boolean = false
    return {
      show_add_hobby_form,
      hobby,
      add_state,
    }
  },
  methods: {
    async save_hobby ():Promise<void> {
      this.add_state = true
      const data = {
        hobby_name: this.hobby.hobby_name,
      }

      await this.$axios.post('hobbies', data).then(() => {
        this.add_state = false
        this.show_add_hobby_form = !this.show_add_hobby_form
        this.$toast.show({
          type: 'success',
          title: 'Success',
          message: 'Hobby Added Successfully',
        })
        this.$emit('refresh_hobby')
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
