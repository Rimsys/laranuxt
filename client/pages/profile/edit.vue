<template>
  <div class="container mt-5 p-2 lg:p-5 bg-gray-300 mb-5">
    <NuxtLink
      to="/profile"
      class="bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 mt-2 mb-2 rounded"
      type="button"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6"
        fill=""
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
      >
        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
      </svg>
    </NuxtLink>

    <user-details />
    <list-skills />
    <experience />
    <education />
    <language />
    <hobby />
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { User } from '@/types/api'
import UserDetails from '@/components/resume/UserDetails.vue'
import ListSkills from '@/components/resume/skill/ListSkills.vue'
import Experience from '@/components/resume/experience/ListExperience.vue'
import Education from '@/components/resume/education/ListEducation.vue'
import Language from '@/components/resume/language/ListLanguage.vue'
import Hobby from '@/components/resume/hobby/ListHobby.vue'
export default Vue.extend({
  components: { UserDetails, ListSkills, Experience, Education, Language, Hobby },
  middleware: 'auth',
  data () {
    const user = {} as User
    return {
      user,
    }
  },
})
</script>
