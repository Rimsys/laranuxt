<template>
  <section>
    <h2 class="text-xl text-blue-700 mb-3 border-b-2 border-gray-200 pb-3">Hobby</h2>
    <ul>
      <S_Hobby
        v-for="s_hobby in hobbies"
        :key="s_hobby.id"
        :hobby="s_hobby"
        @deleteHobby="danger"
      />
    </ul>
    <add-hobby @refresh_hobby="get_hobbies()" />
  </section>
</template>
<script lang="ts">
import Vue from 'vue'
import AddHobby from './AddHobby.vue'
import S_Hobby from './Hobby.vue'
import { Hobby } from '@/types/api'
export default Vue.extend({
  name: 'ListHobby',
  components: { AddHobby, S_Hobby },
  data () {
    const hobbies:Hobby[] = []
    const enable_edit:boolean = false
    const hobby = {} as Hobby
    return {
      hobbies,
      enable_edit,
      hobby,
    }
  },
  mounted () {
    this.get_hobbies()
  },
  methods: {
    async refresh_edit ():Promise<void> {
      this.hobbies = (await this.$axios.get('hobbies')).data.data as Hobby[]
      this.enable_edit = !this.enable_edit
    },
    edit (hobby:Hobby):void {
      this.hobby = hobby
      this.enable_edit = !this.enable_edit
    },
    async get_hobbies (): Promise<void> {
      this.hobbies = (await this.$axios.get('hobbies')).data.data as Hobby[]
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
          action: () => this.delete_hobby(id),
        },
      })
    },

    async delete_hobby (id:number) {
      const url = 'hobbies/' + id
      await this.$axios.delete(url).then(() => {
        this.get_hobbies()
        this.$toast.show({
          type: 'success',
          title: 'Success',
          message: 'Hobby Deleted Successfully',
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
