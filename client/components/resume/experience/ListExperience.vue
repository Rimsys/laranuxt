<template>
  <section>
    <h2 class="text-xl text-blue-700 mb-3 border-b-2 border-gray-200 pb-3">Experience</h2>
    <ul>
      <S_Experience
        v-for="s_experience in experiences"
        :key="s_experience.id"
        :experience="s_experience"
        @refresh_experience="get_experiences"
        @deleteExperience="danger"
      />
    </ul>
    <add-experience @refresh_experience="get_experiences()" />
  </section>
</template>

<script lang="ts">
import Vue from 'vue'
import AddExperience from './AddExperience.vue'
import S_Experience from './Experience.vue'
import { Experience } from '@/types/api'

export default Vue.extend({
  name: 'Experience',
  components: { AddExperience, S_Experience },
  filters: {
    formatDate: (dateStr: string) =>
      Intl.DateTimeFormat('us-EN').format(new Date(dateStr)),
  },
  data () {
    const experiences:Experience[] = []
    const experience = {} as Experience
    return {
      experiences,
      experience,
    }
  },
  mounted () {
    this.get_experiences()
  },
  methods: {
    async get_experiences (): Promise<void> {
      this.experiences = (await this.$axios.get('experiences')).data.data as Experience[]
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
          action: () => this.delete_experience(id),
        },
      })
    },

    async delete_experience (id:number) {
      const url = 'experiences/' + id
      await this.$axios.delete(url).then(() => {
        this.get_experiences()
        this.$toast.show({
          type: 'success',
          title: 'Success',
          message: 'Experience Deleted Successfully',
        })
      }).catch(() => {
        this.$toast.show({
          type: 'danger',
          title: 'Error',
          message: 'Oops, something went wrong',
        })
      })
    },

  },
})
</script>
