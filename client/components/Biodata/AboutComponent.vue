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
        <interest-component :interests="bio.interests" />
      </div>
    </div>
    <value-component :myvalues="bio.myvalues" />

    <modal-component
      v-if="editModalActive"
      :destroyed="() => (editModalActive = false)"
    >
      <store-component :bio="bio" @update-bio="$emit('update-bio', $event)" />
    </modal-component>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import ModalComponent from '../ModalComponent.vue'
import StoreComponent from './StoreComponent.vue'
import { BioData } from '@/types/api'

export default Vue.extend({
  name: 'AboutComponent',
  components: { ModalComponent, StoreComponent },
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
    console.log(this.bio)
  },
  methods: {
    async getBio (): Promise<void> {
      this.bio = (await this.$axios.get('bioData')).data.data as BioData
    },
  },
})
</script>
