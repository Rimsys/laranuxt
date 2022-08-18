<template>
  <div>
    <nav class="p-5 flex flex-row bg-indigo-400">
      <div class="md:w-1/2 text-white text-xl">Resume Builder</div>
      <div class="md:w-1/2 flex justify-end space-x-5">
        <div v-if="$auth.loggedIn" class="ml-3 relative">
          <div>
            <button
              id="user-menu"
              class="relative z-10 flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-blue-300 transition duration-150 ease-in-out"
              aria-label="User menu"
              aria-haspopup="true"
              @click="accountDropdownIsOpen = !accountDropdownIsOpen"
            >
              <img
                class="h-8 w-8 rounded-full"
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                alt=""
              >
            </button>
            <button
              v-if="accountDropdownIsOpen"
              tabindex="-1"
              class="fixed w-full h-full inset-0 cursor-default"
              @click="accountDropdownIsOpen = false"
            />
          </div>

          <div
            v-if="accountDropdownIsOpen"
            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg"
          >
            <div
              class="py-1 rounded-md bg-white shadow-xs"
              role="menu"
              aria-orientation="vertical"
              aria-labelledby="user-menu"
              @click="accountDropdownIsOpen = false"
            >
              <button
                class="block duration-150 ease-in-out focus:bg-gray-100 focus:outline-none hover:bg-gray-100 leading-5 px-4 py-2 text-gray-700 text-left text-sm transition w-full"
                @click="profile"
              >
                Profile
              </button>
            </div>
            <div
              class="py-1 rounded-md bg-white shadow-xs"
              role="menu"
              aria-orientation="vertical"
              aria-labelledby="user-menu"
              @click="accountDropdownIsOpen = false"
            >
              <button
                class="block duration-150 ease-in-out focus:bg-gray-100 focus:outline-none hover:bg-gray-100 leading-5 px-4 py-2 text-gray-700 text-left text-sm transition w-full"
                @click="logout"
              >
                Sign out
              </button>
            </div>
          </div>
        </div>
        <nuxt-link
          v-else
          to="/login"
          tag="button"
          class="inline-flex items-center bg-white border-0 py-2 px-3 focus:outline-none hover:bg-gray-300 rounded text-base mt-4 md:mt-0"
        >
          Sign in
          <svg
            fill="none"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            class="w-4 h-4 ml-1"
            viewBox="0 0 24 24"
          >
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg>
        </nuxt-link>
      </div>
    </nav>
    <div class="flex items-center justify-center">
      <Nuxt />
    </div>
  </div>
</template>
<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
  data () {
    const accountDropdownIsOpen:boolean = false
    const error:string = ''
    return {
      accountDropdownIsOpen,
      error,
    }
  },
  methods: {
    profile () {
      this.$router.push('/profile')
    },
    async logout () {
      this.error = ''

      await this.$auth
        .logout('laravelPassportPassword')
        .then(() => this.$router.push('/'))
        .catch(e => (this.error = e.response.data))
    },
  },
})
</script>
<style>
html,body {
  @apply bg-gray-100
}
</style>
