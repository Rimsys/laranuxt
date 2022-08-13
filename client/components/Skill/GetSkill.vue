<template>
  <div>
    <div id="skill" class="heading">
      <div class="text-center pt-5">
        MY <span class="font__color-1">Skill</span>
      </div>
    </div>
    <div class="row">
      <ul
        v-if="skills.length &gt; 0"
        class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full sm:grid-cols-2 lg:grid-cols-3"
      >
        <skill-list-skill
          v-for="(skill, index) in skills"
          :key="index"
          :skill="skill"
          @skill-updated="updateSkillInTheUi($event)"
        />
      </ul>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { Skill, Skills } from '@/types/api'
export default Vue.extend({
  name: 'GetSkill',
  data () {
    const skills: Skills = []
    return {
      skills,
    }
  },
  created () {
    this.getSkills()
  },
  methods: {
    async getSkills (): Promise<void> {
      this.skills = (await this.$axios.get('skill')).data.data as Skills
    },
    updateSkillInTheUi (event: { initial: any; updated: Skill }) {
      const { initial, updated } = event
      const index = this.skills.findIndex(skill => skill.name === initial.name)
      this.skills[index].name = updated.name
      this.skills[index].strength = updated.strength

      this.$toast.success('Skill updated')
    },
  },
})
</script>
