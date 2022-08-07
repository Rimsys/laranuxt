<template>
  <div>
    <div>
      <div class="section-heading text-center font__color-white">
        MY <span class="">Experience</span>
      </div>
    </div>
    <div>
      <ul
        v-if="experiencies.length &gt; 0"
        class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full sm:grid-cols-2 lg:grid-cols-3"
      >
        <experience-list-component
          v-for="(experience, index) in experiencies"
          :key="index"
          :experience="experience"
          @experience-updated="updateExperienceInTheUi($event)"
        />
      </ul>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { Experience } from '@/types/api'
export default Vue.extend({
  name: 'ExperienceComponent',
  data () {
    const experiencies: Experience = []

    return {
      experiencies,
    }
  },

  mounted () {
    this.getExperience()
  },
  methods: {
    async getExperience (): Promise<void> {
      this.experiencies = (await this.$axios.get('experience')).data
        .data as Experience
    },
    updateExperienceInTheUi (event: { initial: any; updated: Experience }) {
      const { initial, updated } = event
      const index = this.experiencies.findIndex(
        experience => experience.company_name === initial.company_name,
      )
      this.experiencies[index].company_name = updated[index].company_name
      this.experiencies[index].position = updated[index].position
      this.experiencies[index].start_date = updated[index].start_date
      this.experiencies[index].end_date = updated[index].end_date
      this.experiencies[index].responsibilities =
        updated[index].responsibilities

      this.$toast.success('Experience updated')
    },
  },
})
</script>
