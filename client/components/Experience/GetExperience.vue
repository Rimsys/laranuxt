<template>
  <div>
    <div id="experience">
      <div class="section-heading text-center font__color-white">
        MY <span class="">Experience</span>
      </div>
    </div>
    <div>
      <ul
        v-if="experiencies.length &gt; 0"
        class="grid grid-cols-1 gap-6 bg-gray-100 rounded p-8 w-full sm:grid-cols-2 lg:grid-cols-3"
      >
        <experience-list-experience
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
import { Experience, Experiencies } from '@/types/api'
export default Vue.extend({
  name: 'GetExperience',
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
    updateExperienceInTheUi (event: { initial: any; updated: Experiencies }) {
      const { initial, updated } = event
      const index = this.experiencies.findIndex(
        experience => experience.company_name === initial.company_name,
      )
      this.experiencies[index].company_name = updated.company_name
      this.experiencies[index].position = updated.position
      this.experiencies[index].start_date = updated.start_date
      this.experiencies[index].end_date = updated.end_date
      this.experiencies[index].responsibilities = [updated.responsibilities]

      this.$toast.success('Experience updated')
    },
  },
})
</script>
