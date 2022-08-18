<template>
  <div class="mt-10 container flex items-center justify-center ">
    <div
      class="bg-white w-full max-w-sm rounded-lg shadow-md overflow-hidden mx-auto"
    >
      <div class="py-5 px-8">
        <nuxt-link
          to="/"
          class="flex title-font font-medium items-center justify-center text-gray-900 mb-4"
        >
          <span class="text-xl">Resume Builder</span>
        </nuxt-link>

        <p class="text-xl text-gray-600 text-center">Sign in to your account</p>

        <form @submit.prevent="loginPassport">
          <div class="mt-4">
            <label
              class="block text-gray-600 text-sm font-medium mb-2"
              for="LoggingEmailAddress"
            >Email</label>
            <input
              id="LoggingEmailAddress"
              v-model="form.username"
              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"
              type="email"
              required="required"
            >
          </div>

          <div class="mt-4">
            <div class="flex justify-between">
              <label
                class="block text-gray-600 text-sm font-medium mb-2"
                for="loggingPassword"
              >Password</label>
              <!-- <nuxt-link
                to="/forgot-password"
                class="text-xs text-gray-500 hover:underline"
              >
                Forget Password?
              </nuxt-link> -->
            </div>

            <input
              id="loggingPassword"
              v-model="form.password"
              class="bg-white text-gray-700 border border-gray-300 rounded py-2 px-4 block w-full focus:border-blue-500 focus:outline-none focus:shadow-outline"
              type="password"
              required="required"
            >
          </div>

          <div class="mt-3">
            <span
              v-if="error"
              class="inline-flex items-center font-semibold text-sm text-red-600"
            >
              <svg
                aria-hidden="true"
                class="fill-current mr-2"
                height="12"
                width="12"
                viewBox="0 0 16 16"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M10.115 1.308l5.635 11.269A2.365 2.365 0 0 1 13.634 16H2.365A2.365 2.365 0 0 1 .25 12.577L5.884 1.308a2.365 2.365 0 0 1 4.231 0zM8 10.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM8 9c.552 0 1-.32 1-.714V4.714C9 4.32 8.552 4 8 4s-1 .32-1 .714v3.572C7 8.68 7.448 9 8 9z"
                  fill-rule="evenodd"
                />
              </svg>
              {{ error.message }}
            </span>
          </div>

          <div class="mt-8">
            <button
              class="flex items-center justify-center bg-blue-500 text-white font-bold py-2 px-4 w-full rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
              :disabled="loading"
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
              {{ loading ? 'Loading...' : 'Login' }}
            </button>
          </div>
        </form>
      </div>

      <div
        class="flex items-center justify-center py-4 bg-gray-100 text-center"
      >
        <span class="text-gray-600 text-sm">Don't have an account? </span>

        <nuxt-link
          to="/register"
          class="text-blue-600 font-bold mx-2 text-sm hover:text-blue-500"
        >
          Sign up
        </nuxt-link>
      </div>
    </div>
  </div>
</template>
<script lang="ts">
import Vue from 'vue'
import { LoginForm } from '@/types/api'
export default Vue.extend({
  auth: 'guest',
  data () {
    const form = {} as LoginForm
    const error:string | null = null
    const loading:boolean = false
    return {
      form,
      error,
      loading,
    }
  },
  methods: {
    async loginPassport () {
      this.error = null
      this.loading = true
      await this.$auth
        .loginWith('laravelPassportPassword', { data: this.form })
        .then(() => {
          this.loading = false
          this.$router.push('/profile')
        })
        .catch((error) => {
          this.loading = false
          this.error = error.response.data.errors ?? error.response.data
        })
    },
  },
})
</script>
