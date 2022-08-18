<template>
  <div class="container mt-5 p-2 lg:p-5 bg-gray-300 mb-5">
    <template v-if="!loading">
      <div class="md:flex">
        <div class="w-full md:w-1/2">
          <h1 class="text-xl text-blue-600 font-semibold">{{ user.name }}</h1>
          <p>{{ user.job_title }}</p>
          <NuxtLink
            to="profile/edit"
            class="bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 mt-2 rounded"
            type="button"
            @click.once="update_user"
          >
            EDIT RESUME
          </NuxtLink>
        </div>
        <div class="flex w-full md:w-1/2 md:justify-end">
          <p>
            <span v-if="user.mobile_no" class="flex block">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 mt-1 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
              </svg>
              {{ user.mobile_no }}
            </span>
            <span v-if="user.email" class="flex block">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-1 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
              </svg>
              {{ user.email }}
            </span>
            <span v-if="user.github_profile" class="flex block">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 mt-1 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"
                />
              </svg>
              <a
                :href="user.github_profile"
                class="text-blue-500"
                target="_blank"
              >{{ $auth.user.data.github_profile }}</a>
            </span>
            <span v-if="user.linkedin_profile" class="flex block">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 mt-1 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"
                />
              </svg>
              <a
                :href="user.linkedin_profile"
                class="text-blue-500"
                target="_blank"
              >{{ user.linkedin_profile }}</a>
            </span>
            <span v-if="user.location" class="flex block">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 mt-1 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                />
              </svg>
              {{ user.location }}
            </span>
          </p>
        </div>
      </div>
      <div class="w-full mt-5 border-b-2 border-gray-200 pb-5">
        <p>{{ user.description }}</p>
      </div>
      <div class="grid grid-cols-4 gap-5 mt-5">
        <div class="col-span-3">
          <h2 class="text-xl text-blue-600 font-semibold">Experience</h2>
          <section v-for="experience in experiences" :key="experience.id">
            <div class="flex mt-5">
              <h3 class="w-1/2 font-bold">{{ experience.job_title }}</h3>
              <p
                class="w-1/2 flex justify-end"
              >
                <span class="text-blue-500 pr-2">{{ experience.company_name }} </span> | {{ experience.from_date | formatDate }} - {{ experience.to_date | formatDate }}
              </p>
            </div>
            <p class="mt-2 text-blue-500">My roles and responsibilities with Tagsen.</p>
            <p class="mt-2  whitespace-pre-line">{{ experience.responsibilities }}</p>
          </section>
        </div>
        <div class="border-l-2 border-gray-200 pl-5">
          <h2 class="text-xl text-blue-600 font-semibold">Skills</h2>
          <ul class="mt-2">
            <li
              v-for="skill in skills"
              :key="skill.id"
            >
              {{ skill.name }},
            </li>
          </ul>

          <h2 class="text-xl mt-5 text-blue-600 font-semibold">Education</h2>
          <ul class="mt-2">
            <li
              v-for="education in educations"
              :key="education.id"
            >
              {{ education.degree_name }}, {{ education.university_name }}, {{ education.from_date | formatDate }} - {{ education.to_date | formatDate }}
            </li>
          </ul>

          <h2 class="text-xl mt-5 text-blue-600 font-semibold">Languages</h2>
          <ul class="mt-2">
            <li
              v-for="language in languages"
              :key="language.id"
            >
              {{ language.language_name }},
            </li>
          </ul>

          <h2 class="text-xl mt-5 text-blue-600 font-semibold">Hobbies</h2>
          <ul class="mt-2">
            <li
              v-for="hobby in hobbies"
              :key="hobby.id"
            >
              {{ hobby.hobby_name }},
            </li>
          </ul>
        </div>
      </div>
    </template>
    <div v-else class="grid place-items-center h-screen">
      <p class="text-3xl animate-bounce capitalize">Fetching Data.....</p>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { User, Skill, Experience, Education, Hobby, Language } from '@/types/api'

export default Vue.extend({
  filters: {
    formatDate: (dateStr: string) =>
      Intl.DateTimeFormat('us-EN').format(new Date(dateStr)),
  },
  middleware: 'auth',
  data () {
    const user = {} as User
    const experiences:Experience[] = []
    const skills:Skill[] = []
    const educations:Education[] = []
    const languages:Language[] = []
    const hobbies:Hobby[] = []
    const loading:boolean = true
    return {
      user,
      experiences,
      skills,
      educations,
      languages,
      hobbies,
      loading,
    }
  },
  mounted () {
    this.get_user()
    this.get_experiences()
    this.get_skills()
    this.get_educations()
    this.get_languages()
    this.get_hobbies()
  },
  methods: {
    async get_user (): Promise<void> {
      this.user = (await this.$axios.get('api/v1/user')).data.data as User
    },
    async get_experiences (): Promise<void> {
      this.experiences = (await this.$axios.get('experiences')).data.data as Experience[]
    },
    async get_skills (): Promise<void> {
      this.skills = (await this.$axios.get('skills')).data.data as Skill[]
    },
    async get_educations (): Promise<void> {
      this.educations = (await this.$axios.get('educations')).data.data as Education[]
    },
    async get_languages (): Promise<void> {
      this.languages = (await this.$axios.get('languages')).data.data as Language[]
    },
    async get_hobbies (): Promise<void> {
      await this.$axios.get('hobbies').then((response) => {
        this.hobbies = response.data.data
      }).finally(() => {
        this.loading = false
      })
    },
  },
})
</script>
