<template>
  <section>
    <h2 class="text-xl text-blue-700 mb-3 border-b-2 border-gray-200 pb-3">Education</h2>
    <ul>
      <S_Education
        v-for="s_education in educations"
        :key="s_education.id"
        :education="s_education"
        @deleteEducation="danger"
      />
    </ul>
    <add-education @refresh_education="get_educations()" />
  </section>
</template>
<script lang="ts">
import Vue from 'vue'
import AddEducation from './AddEducation.vue'
import S_Education from './Education.vue'
import { Education } from '@/types/api'

export default Vue.extend({
  name: 'Education',
  components: { AddEducation, S_Education },
  filters: {
    formatDate: (dateStr: string) =>
      Intl.DateTimeFormat('us-EN').format(new Date(dateStr)),
  },
  data () {
    const educations:Education[] = []
    const education = {} as Education
    return {
      educations,
      education,
    }
  },
  mounted () {
    this.get_educations()
  },
  methods: {
    async get_educations (): Promise<void> {
      this.educations = (await this.$axios.get('educations')).data.data as Education[]
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
          action: () => this.delete_education(id),
        },
      })
    },

    async delete_education (id:number) {
      const url = 'educations/' + id
      await this.$axios.delete(url).then(() => {
        this.get_educations()
        this.$toast.show({
          type: 'success',
          title: 'Success',
          message: 'Education Deleted Successfully',
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
