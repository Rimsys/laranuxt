<template>
  <div>
    <div
      class="grid grid-cols-1 sm:grid-cols-2"
      @mouseover="hover = true"
      @mouseleave="hover = false"
    >
      <div class="bg-blue-100 ">
        <img class="object-cover w-auto h-600" :src="bio.image">
      </div>
      <div class="bg-red-50 py-20 pl-10 text-left pr-20 border-inherit">
        <div v-if="hover" @click="editModalActive = true">
          <Icon-edit class="w-5 h-5 float-right" />
        </div>
        <h2 class="pt-70 pb-10 text-2xl font-semibold text-blue-700 ">
          About me
        </h2>
        <p class="text-lg">{{ bio.first_name }} {{ bio.last_name }}</p>
        <small>socials: </small>
        <div class="flex flex-row space-x-4 ...">
          <div class="text-sm">
            <a
              v-if="bio"
              :href="bio.github_url"
              target="_blank"
            ><IconGithub
              class="w-5 h-5 bg-black-100"
            /></a>
          </div>
          <div class="text-sm">
            <a
              v-if="bio"
              :href="bio.linkedin_url"
              target="_blank"
            ><IconEnvelope
              class="w-5 h-5 bg-black-100"
            /></a>
          </div>
        </div>
        <p class="pt-10">{{ bio.professional_summary }}</p>
        <interest-get-interest :interests="bio.interests" />
      </div>
    </div>
    <value-get-value :myvalues="bio.myvalues" />

    <modal-base
      v-if="editModalActive"
      :destroyed="() => (editModalActive = false)"
    >
      <store-biodata :bio="bio" @update-bio="updateBioInTheUi($event)" />
    </modal-base>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import ModalBase from '../ModalBase.vue'
import StoreBiodata from './StoreBiodata.vue'
import { Bio, BioData } from '@/types/api'

export default Vue.extend({
  name: 'GetBiodata',
  components: { ModalBase, StoreBiodata },
  data () {
    const bio: BioData = []

    return {
      bio,
      hover: false,
      editModalActive: false,
    }
  },
  mounted () {
    this.getBio()
  },
  methods: {
    async getBio (): Promise<void> {
      this.bio = (await this.$axios.get('bioData')).data.data as BioData
    },
    updateBioInTheUi (event: { initial: any; updated: Bio }): void {
      const { initial, updated } = event

      initial.first_name = updated.first_name
      initial.last_name = updated.last_name
      initial.headline = updated.headline
      initial.email = updated.email
      initial.location = updated.location
      initial.professional_summary = updated.professional_summary
      initial.interests = [updated.interests]
      initial.myvalues = updated.myvalues
      initial.github_url = updated.github_url
      initial.linkedin_url = updated.linkedin_url

      this.$toast.success('Biodata updated')
      this.editModalActive = false
    },
  },
})
</script>
