<template>
  <div class="w-full max-w-xs">
    <form class="mb-3" @submit.prevent="updateSkill">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Name
        </label>
        <input
          v-model="skillToUpdate.name"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          type="text"
          placeholder="name"
        >
      </div>
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="strength"
        >
          Strength
        </label>
        <input
          v-model="skillToUpdate.strength"
          type="text"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="strength"
        >
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
import { Skill } from '@/client/types/api'

export default Vue.extend({
  name: 'StoreSkill',
  props: {
    skill: {
      type: Object as PropType<Skill>,
      required: true,
    },
  },
  data () {
    return {
      skillToUpdate: {
        name: '',
        strength: '',
      },
    }
  },
  mounted () {
    this.setSkillToUpdate()
  },
  methods: {
    setSkillToUpdate () {
      this.skillToUpdate.name = this.skill.name
      this.skillToUpdate.strength = String(this.skill.strength)
    },
    async updateSkill () {
      await this.$axios
        .patch(`/skill/update/${this.skill.id}`, this.skillToUpdate)
        .then(() => {
          this.$emit('skill-updated', {
            initial: this.skill,
            updated: this.skillToUpdate,
          })
        })
        .catch((error) => {
          this.$toast.danger(error.response.data.message)
        })
    },
  },
})
</script>
