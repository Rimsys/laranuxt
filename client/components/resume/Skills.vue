<template>
  <div class="container p-2 lg:p-8 flex flex-col">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Skills</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">How many years of experience/practice.</p>
      </div>
      <div class="border-t border-gray-200">
        <ul class="px-6 py-5 flex flex-wrap flex-col space-y-3">
          <li class="flex space-x-5 justify-between hover:bg-gray-100 py-2 px-4" v-for="(skill, index) in skills" :key="index">
            <div class="list-group-item-info">
              <span data-testid="skill-name-0">{{ skill.name }}</span>
            </div>
            <div class="flex space-x-5">
              <div class="">
                <select class="bg-transparent border-gray-300 border py-1 px-3" @change="updateSkill(skill)" v-model="skill.years">
                  <option value="" selected="" disabled="" hidden="">Years</option>
                  <option v-for="index in 12" :key="index" :value="index">{{ index }}{{ index == 12 ? '+' : ''}} year{{ index > 1 ? 's' : ''}}</option>
                </select>
              </div>
              <div class="">
                <a @click.prevent="deleteSkill(skill)" class="cursor-pointer" title="Delete Skill">
                  X
                </a>
              </div>
            </div>
          </li>

          <li class="flex space-x-5 justify-between bg-blue-50 py-2 px-4 items-center">
            <div>
              <h3>Add new skill</h3>
            </div>
            <div class="list-group-item-info">
              <div class="">
                <select class="bg-transparent border-gray-300 border py-1 px-3" v-model="newSkill.name">
                  <option value="" selected="" disabled="" hidden="">Skill</option>
                  <option v-for="skill in unselectedSkills" :key="skill.id" :value="skill.name">{{ skill.name }}</option>
                </select>
              </div>
            </div>
            <div class="flex space-x-5">
              <div class="">
                <select class="bg-transparent border-gray-300 border py-1 px-3" v-model="newSkill.years">
                  <option value="" selected="" disabled="" hidden="">Years</option>
                  <option v-for="index in 12" :key="index" :value="index">{{ index }}{{ index == 12 ? '+' : ''}} year{{ index > 1 ? 's' : ''}}</option>
                </select>
              </div>
            </div>
            <div class="">
              <PushButton class="mr-2" theme="indigo" @click="saveNewSkill()" title="Save Skill">
                Save
              </PushButton>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { Skill, Skills } from '@/types/api'

export default Vue.extend({
  props: {
    resume_id: Number,
  },
  data () {
    const skills:Skills = []
    const allSkills:Skills = []
    const newSkill = {
      name: '',
      years: '',
    }

    return {
      skills,
      allSkills,
      newSkill,
    }
  },
  watch: {
    resume_id (newValue) {
      if (newValue !== 0 && newValue !== undefined)
        this.get()
    },
  },
  mounted () {
    this.$axios.get('skills').then((response) => {
      this.allSkills = response.data.data as Skills
    })
  },
  computed: {
    unselectedSkills () {
      return this.allSkills.filter((skill) => { return !this.skills.some(usedSkill => usedSkill.name === skill.name) })
    },
  },
  methods: {
    async get (): Promise<void> {
      this.skills = (
        await this.$axios.get(`resume/${this.resume_id}/skill`)
      ).data.data as Skills

      this.allSkills = (
        await this.$axios.get('skills')
      ).data.data as Skills
    },
    saveNewSkill () {
      this.$axios
        .post(`resume/${this.resume_id}/skill`, {
          name: this.newSkill.name,
          years: this.newSkill.years,
        })
        .then(() => {
          this.$toast.show({
            type: 'success',
            title: 'Success',
            message: 'Skill saved',
          })

          /* add new skill to collection */
          this.skills.push({
            name: this.newSkill.name,
            years: this.newSkill.years,
            order: this.skills.length + 1,
          })

          /* reset newSkill */
          this.newSkill = {
            name: '',
            years: '',
          }
        })
    },
    updateSkill (skill:Skill) {
      this.$axios
        .put(`resume/${this.resume_id}/skill`, {
          name: skill.name,
          years: skill.years,
          order: skill.order,
        })
        .then(() => {
          this.$toast.show({
            type: 'success',
            title: 'Success',
            message: `Skill ${skill.name} updated`,
          })
        })
    },
    deleteSkill (skill:Skill) {
      this.$axios
        .delete(`resume/${this.resume_id}/skill`, {
          params: { name: skill.name },
        })
        .then(() => {
          this.$toast.show({
            type: 'success',
            title: 'Success',
            message: `Skill ${skill.name} deleted`,
          })

          this.skills = this.skills.filter((obj) => { return obj !== skill })
        })
    },
  },
})
</script>
