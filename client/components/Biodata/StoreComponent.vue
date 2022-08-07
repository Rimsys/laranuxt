<template>
  <div>
    <form class="mb-3" @submit.prevent="storeBioData">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          First Name
        </label>
        <input
          id="first_name"
          v-model="bioToUpdate.first_name"
          name="first_name"
          type="text"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="First Name"
        >
      </div>
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="last_name"
        >
          Last Name
        </label>
        <input
          id="last_name"
          v-model="bioToUpdate.last_name"
          name="last_name"
          type="text"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="Last Name"
        >
      </div>
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="headline"
        >
          Headline
        </label>
        <input
          id="headline"
          v-model="bioToUpdate.headline"
          name="headline"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="Headline"
          cols="30"
          rows="10"
        >
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
          Email
        </label>
        <input
          id="email"
          v-model="bioToUpdate.email"
          name="email"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="Email"
          cols="30"
          rows="10"
        >
      </div>
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="location"
        >
          Location
        </label>
      </div>
      <input
        id="location"
        v-model="bioToUpdate.location"
        name="location"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        placeholder="Location"
        cols="30"
        rows="10"
      >
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2 pt-2"
          for="professional_summary"
        >
          Professional Summary
        </label>
        <textarea
          id="professional_summary"
          v-model="bioToUpdate.professional_summary"
          name="professional_summary"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="Professional Summary"
          cols="30"
          rows="10"
        />
      </div>
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="interests"
        >
          Interests
        </label>
        <input
          v-model="bioToUpdate.interests"
          name="interests"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="Interests"
          cols="30"
          rows="10"
        >
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="values">
          values
        </label>
        <textarea
          v-model="bioToUpdate.values"
          name=""
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="Values"
          cols="30"
          rows="10"
        />
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="github_url"
          >
            Github URL
          </label>
          <input
            id="github_url"
            v-model="bioToUpdate.github_url"
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            type="text"
          >
        </div>
        <div class="w-full md:w-1/2 px-3">
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="linkedin_url"
          >
            LinkedIn URL
          </label>
          <input
            id="linkedin_url"
            v-model="bioToUpdate.linkedin_url"
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            type="text"
          >
        </div>
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
import { Bio } from '@/client/types/api'
export default Vue.extend({
  name: 'BioDataStoreComponent',
  props: {
    bio: {
      type: Object as PropType<Bio>,
      required: true,
    },
  },
  data () {
    return {
      bioToUpdate: {
        first_name: '',
        last_name: '',
        headline: '',
        email: '',
        location: '',
        professional_summary: '',
        interests: [],
        myvalues: '',
        github_url: '',
        linkedin_url: '',
      },
    }
  },

  mounted () {
    this.setBioToUpdate()
  },

  methods: {
    setBioToUpdate () {
      this.bioToUpdate = {
        ...this.bio,
        interests: this.bio.interests,
      }
    },

    storeBioData () {
      this.$axios
        .patch(`bioData/update/${this.bio.id}`, this.bioToUpdate)
        .then(() => {
          this.$emit('update-bio', {
            initial: this.bio,
            updated: this.bioToUpdate,
          })
        })
        .catch((error) => {
          console.log(error)
        })
    },
  },
})
</script>
