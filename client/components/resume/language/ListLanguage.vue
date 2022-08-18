<template>
  <section>
    <h2 class="text-xl text-blue-700 mb-3 border-b-2 border-gray-200 pb-3">Language</h2>
    <ul>
      <S_Language
        v-for="s_language in languages"
        :key="s_language.id"
        :language="s_language"
        @deleteLanguage="danger"
      />
    </ul>
    <add-language @refresh_language="get_languages()" />
  </section>
</template>
<script lang="ts">
import Vue from 'vue'
import AddLanguage from './AddLanguage.vue'
import S_Language from './Language.vue'
import { Language } from '@/types/api'

export default Vue.extend({
  name: 'Language',
  components: { AddLanguage, S_Language },
  data () {
    const languages:Language[] = []
    const enable_edit:boolean = false
    const language = {} as Language
    return {
      languages,
      enable_edit,
      language,
    }
  },
  mounted () {
    this.get_languages()
  },
  methods: {
    async refresh_edit ():Promise<void> {
      this.languages = (await this.$axios.get('languages')).data.data as Language[]
      this.enable_edit = !this.enable_edit
    },
    async get_languages (): Promise<void> {
      this.languages = (await this.$axios.get('languages')).data.data as Language[]
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
          action: () => this.delete_language(id),
        },
      })
    },

    async delete_language (id:number) {
      const url = 'languages/' + id
      await this.$axios.delete(url).then(() => {
        this.get_languages()
        this.$toast.show({
          type: 'success',
          title: 'Success',
          message: 'Language Deleted Successfully',
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
