<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div>

    <resume-general :resume="resume"></resume-general>

    <resume-skills :resume_id="resume.resume_id"></resume-skills>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { Resume } from '@/types/api'

export default Vue.extend({
  data () {
    const resume:Resume = {
      resume_id: 0,
      full_name: '',
      email: '',
      phone: '',
      role: '',
      about: '',
    }

    return {
      resume,
    }
  },
  created () {
    this.get('robson')
  },
  methods: {
    get (username: string) {
      this.$axios
        .get('profile', { params: { username } })
        .then(response => (this.resume = response.data.data as Resume))
    },
  },
})
</script>
