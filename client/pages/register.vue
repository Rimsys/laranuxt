<template>
  <div class="min-h-screen container pt-10 pb-10">
    <div
      class="flex max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden lg:max-w-4xl"
    >
      <div
        class="hidden lg:block lg:w-1/2 bg-cover"
        style="background-image: url('https://source.unsplash.com/daily')"
      />

      <div class="w-full py-8 px-6 md:px-8 lg:w-1/2">
        <nuxt-link
          to="/"
          class="flex title-font font-medium items-center justify-center text-gray-900 mb-4"
        >
          <span class="ml-3 text-xl">Resume Builder</span>
        </nuxt-link>

        <p class="text-xl text-gray-600 text-center">Create your account</p>

        <form @submit.prevent="register">
          <div class="mt-4">
            <label
              class="block text-gray-600 text-sm font-medium mb-2"
              for="RegisterName"
            >Name</label>
            <input
              id="RegisterName"
              v-model="form.name"
              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"
              type="text"
            >

            <span v-if="error && error.name" class="text-xs text-red-600">
              {{ error.name[0] }}
            </span>
          </div>

          <div class="mt-4">
            <label
              class="block text-gray-600 text-sm font-medium mb-2"
              for="RegisterName"
            >Job Title</label>
            <input
              id="RegisterName"
              v-model="form.job_title"
              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"
              type="text"
            >

            <span v-if="error && error.job_title" class="text-xs text-red-600">
              {{ error.job_title[0] }}
            </span>
          </div>

          <div class="mt-4">
            <label
              class="block text-gray-600 text-sm font-medium mb-2"
              for="RegisterEmail"
            >Email</label>
            <input
              id="RegisterEmail"
              v-model="form.email"
              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"
              type="email"
            >

            <span v-if="error && error.email" class="text-xs text-red-600">
              {{ error.email[0] }}
            </span>
          </div>

          <div class="mt-4">
            <label
              class="block text-gray-600 text-sm font-medium mb-2"
              for="RegisterEmail"
            >Mobile No</label>
            <input
              id="RegisterMobile"
              v-model="form.mobile_no"
              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"
              type="text"
            >

            <span v-if="error && error.mobile_no" class="text-xs text-red-600">
              {{ error.mobile_no[0] }}
            </span>
          </div>

          <div class="mt-4">
            <label
              class="block text-gray-600 text-sm font-medium mb-2"
              for="RegisterEmail"
            >Location</label>
            <input
              id="RegisterMobile"
              v-model="form.location"
              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"
              type="text"
            >

            <span v-if="error && error.location" class="text-xs text-red-600">
              {{ error.location[0] }}
            </span>
          </div>

          <div class="mt-4">
            <label
              class="block text-gray-600 text-sm font-medium mb-2"
              for="RegisterPassword"
            >Password</label>

            <input
              id="RegisterPassword"
              v-model="form.password"
              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"
              type="password"
            >

            <span v-if="error && error.password" class="text-xs text-red-600">
              {{ error.password[0] }}
            </span>
          </div>

          <div class="mt-8">
            <button
              class="flex items-center justify-center bg-blue-500 text-white font-bold py-2 px-4 w-full rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
            >
              <svg v-if="loading" class="mr-3 h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
            {{ loading ? 'Processing...' : 'Create Account' }}  
            </button>
          </div>
        </form>

        <div class="mt-4 flex items-center justify-between">
          <span class="border-b w-1/5 md:w-1/4" />

          <nuxt-link
            to="/login"
            class="text-xs text-gray-500 uppercase hover:underline"
          >
            or sign in
          </nuxt-link>

          <span class="border-b w-1/5 md:w-1/4" />
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { CreateAccount } from '@/types/api'
export default Vue.extend({
  data () {
    const form = {} as CreateAccount
    const error:String | null = null
    const loading:boolean = false
    return {
      form,
      error,
      loading
    }
  },
  methods: {
    async register () {
      this.error = null
      this.loading = true
      await this.$axios
        .$post('api/v1/register', {
          ...this.form,
          password_confirmation: this.form.password,
        })
        .then(() => {
          this.loading = false
          this.$toast.success('Your account was created successfully!')
          this.$router.push('/login')
        })
        .catch(e => {
          this.loading = false
          this.error = e.response.data.errors ?? e.response.data
        }
        )
    },
  },
})
</script>
