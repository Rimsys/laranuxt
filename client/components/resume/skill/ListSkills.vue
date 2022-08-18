<template>
  <section>
    <h2 class="text-xl text-blue-700 mb-3 border-b-2 border-gray-200 pb-3">Skills</h2>
    <ul class="mt-5 mb-3 border-b-2 border-gray-200 pb-3">
      <S_Skill
        v-for="c_skill in skills"
        :key="c_skill.id"
        :skill="c_skill"
        @refresh_skills="refresh_edit"
        @deleteSkill="danger"
      />
      <div v-if="!enable_add" class="w-full flex justify-center mt-5">
        <button
          class="bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-md border-4 text-white py-2 px-3 rounded"
          type="button"
          @click="enable_add = !enable_add"
        >
          ADD NEW SKILL
        </button>
      </div>
      <add-skill v-if="enable_add" @refresh_skills="refresh_skills" />
    </ul>
  </section>
</template>

<script lang="ts">
import Vue from 'vue'
import AddSkill from './AddSkill.vue'
import S_Skill from './Skill.vue'
import { Skill } from '@/types/api'

export default Vue.extend({
  name: 'ListSkills',
  components: { AddSkill, S_Skill },

  data () {
    const skills:Skill[] = []
    const skill = {} as Skill
    const enable_add:boolean = false
    const enable_edit:boolean = false
    const edit_skill_id:number = 0

    return {
      skills,
      skill,
      edit_skill_id,
      enable_add,
      enable_edit,
    }
  },
  mounted () {
    this.get_skills()
  },
  methods: {
    async get_skills ():Promise<void> {
      this.skills = (await this.$axios.get('skills')).data.data as Skill[]
    },

    danger (id:number) {
      this.$modal.show({
        type: 'danger',
        title: 'Are you sure?',
        body: 'once removed, you will not be able to get it back.',
        secondary: {
          label: 'Cancel',
          theme: 'while',
          action: () => this.$toast.success('You cancelled deletion'),
        },
        primary: {
          label: 'Confirm Delete',
          theme: 'red',
          action: () => this.delete_skill(id),
        },
      })
    },

    async delete_skill (id:number):Promise<void> {
      const url = 'skills/' + id
      await this.$axios.delete(url).then(() => {
        this.get_skills()
        this.$toast.show({
          type: 'success',
          title: 'Success',
          message: 'Skill Deleted Successfully',
        })
      }).catch(() => {
        this.$toast.show({
          type: 'danger',
          title: 'Error',
          message: 'Oops, something went wrong',
        })
      })
    },

    async refresh_skills ():Promise<void> {
      this.skills = (await this.$axios.get('skills')).data.data as Skill[]
      this.enable_add = !this.enable_add
    },
    async refresh_edit ():Promise<void> {
      this.skills = (await this.$axios.get('skills')).data.data as Skill[]
      this.enable_edit = !this.enable_edit
    },
  },
})
</script>
