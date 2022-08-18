<template>
  <section>
    <form class="w-full mb-2" @submit.prevent="save_hobby">
      <div class="flex items-center">
        <Textinput
          id="name"
          :model-value.sync="local_hobby.hobby_name"
          type="text"
          label="Name"
          required="required"
          class="appearance-none block w-full text-gray-700 border border-blue-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        />
        <button
          class="flex items-center justify-center bg-blue-500 hover:bg-blue-700 border-blue-500 hover:text-md border-4 text-white py-2 px-3 rounded"
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
          class="border-white bg-white border-4 text-teal-500 hover:text-teal-800 text-md py-2 px-2 rounded"
          type="button"
          @click.once="$emit('close_hobby')"
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
  name: 'EditHobby',
  props: {
    hobby: {
      required: true,
      type: Object as () => Hobby,
    },
  },
  data () {
    const local_hobby = {} as Hobby
    const update_state:boolean = false
    return {
      local_hobby,
      update_state,
    }
  },
  mounted () {
    this.local_hobby = this.hobby
  },
  methods: {
    async save_hobby ():Promise<void> {
      this.update_state = true
      const data = {
        hobby_name: this.local_hobby.hobby_name,
      }

      const url = 'hobbies/' + this.local_hobby.id
      await this.$axios.put(url, data).then(() => {
        this.update_state = false
        this.$toast.show({
          type: 'success',
          title: 'Success',
          message: 'Hobby Update Successfully',
        })
        this.$emit('close_hobby')
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
