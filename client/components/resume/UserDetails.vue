<template>
  <div>
    <template v-if="!loading">
      <form class="w-full border-b-2 border-gray-200 pb-3 mb-3" @submit.prevent="update_user">
        <h2 class="text-xl text-blue-700 mb-3 border-b-2 border-gray-200 pb-3">Personal Details</h2>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
              for="grid-first-name"
            >
              Name
            </label>
            <input
              id="grid-first-name"
              v-model="user.name"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
              type="text"
              placeholder="Jane"
              required="required"
            >
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
              for="grid-job-title"
            >
              Job Title
            </label>
            <input
              id="grid-job-title"
              v-model="user.job_title"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              type="text"
              placeholder="Full stack developer"
              required="required"
            >
          </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
              for="grid-github"
            >
              Github Profile
            </label>
            <input
              id="grid-github"
              v-model="user.github_profile"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
              type="url"
              placeholder="Jane"
            >
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
              for="grid-linkedin"
            >
              Linkedin Profile
            </label>
            <input
              id="grid-linkedin"
              v-model="user.linkedin_profile"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              type="url"
              placeholder="https://linkedin.com/profile"
            >
          </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
              for="grid-mobile-no"
            >
              Mobile Number
            </label>
            <input
              id="grid-mobile-no"
              v-model="user.mobile_no"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              type="text"
              placeholder="+1 123 234"
              required="required"
            >
          </div>
          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
              for="grid-email"
            >
              Email
            </label>
            <input
              id="grid-email"
              v-model="user.email"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              type="email"
              placeholder="myname@example.com"
              required="required"
            >
          </div>
          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
              for="grid-location"
            >
              Location
            </label>
            <input
              id="grid-location"
              v-model="user.location"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              type="text"
              placeholder="city, country"
              required="required"
            >
          </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3 mb-6 md:mb-0">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
              for="grid-mobile-no"
            >
              Description
            </label>
            <textarea
              id="grid-responsibility-no"
              v-model="user.description"
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              placeholder="Description"
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
            {{ update_state ? 'saving...':'SAVE' }}
          </button>
        </div>
      </form>
    </template>
    <div v-else class="grid place-items-center h-screen">
      <p class="text-3xl animate-bounce capitalize">Fetching Data</p>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { User } from '@/types/api'
export default Vue.extend({
  name: 'UserDetails',
  data () {
    const user = {} as User
    const loading:boolean = true
    const update_state:boolean = false
    return {
      user,
      loading,
      update_state,
    }
  },
  mounted () {
    this.get_user()
  },
  methods: {
    async get_user ():Promise<void> {
      this.loading = true
      try {
        await this.$axios.get('api/v1/user').then((response) => {
          this.user = response.data.data
        }).finally(() => {
          this.loading = false
        })
      } catch (error) {
        console.log('error occurred')
      }
    },
    async update_user ():Promise<void> {
      this.update_state = true
      const data = {
        name: this.user.name,
        email: this.user.email,
        job_title: this.user.job_title,
        mobile_no: this.user.mobile_no,
        github_profile: this.user.github_profile,
        linkedin_profile: this.user.linkedin_profile,
        location: this.user.location,
        description: this.user.description,
      }
      console.log(data);
      try {
        await this.$axios.patch('api/v1/user', data).then(() => {
          this.update_state = false
          this.$toast.show({
            type: 'success',
            title: 'Success',
            message: 'Profile Updated Successfully',
          })
        })
      } catch (error) {
        this.update_state = false
        this.$toast.show({
          type: 'danger',
          title: 'Error',
          message: 'Oops, something went wrong',
        })
      }
    },
  },
})
</script>
