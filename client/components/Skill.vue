<template>

  <div class="grid grid-cols-12 gap-6 w-full px-10 my-5">

    <h1 class="bg-indigo-100 col-span-12 py-1 text-2xl text-center">Skill</h1>

    <div class="col-span-12 md:col-span-4">

      <label class="block mb-3">
        <span class="text-gray-700">Name</span>
        <input type="text" class="mt-1 block w-full" v-model="form.fields.name">
        <div class="text-red-600" v-if="form.errors.name">{{ form.errors.name }}</div>
      </label>


      <label class="block mb-3">
        <span class="text-gray-700">Years of Experience</span>
        <input type="number" min="1" step="1" class="mt-1 block w-full" v-model="form.fields.years_of_experience">
        <div class="text-red-600" v-if="form.errors.years_of_experience">{{ form.errors.years_of_experience }}</div>
      </label>

      <div class="flex justify-center">

        <button type="button" @click="saveSkill"
                class="bg-green-400 font-semibold mr-3 mt-3 py-2 rounded-md text-white w-1/2">
          Save
        </button>

        <button type="button" @click="resetForm"
                class="bg-gray-400 font-semibold mt-3 py-2 rounded-md text-white w-1/2">
          Cancel
        </button>

      </div>

    </div>

    <div v-if="skillsCount" class="col-span-12 md:col-span-8">

      <table class="table-auto table-auto text-center w-full">
        <thead>
        <tr>
          <th>Name</th>
          <th>Years of Experience</th>
          <th>Actions</th>
        </tr>
        </thead>

        <tbody class="bg-white divide-y">
        <tr v-for="(skill, index) in skills">
          <td class="py-4">{{ skill.name }}</td>
          <td>{{ skill.years_of_experience }}</td>
          <td>

            <DeleteButton :delete_url="`skills/${skill.id}`" @ItemDeleted="skillDeleted"/>

            <button type="button" class="bg-indigo-400 px-5 py-1 rounded text-sm text-white"
                    @click="editSkill(index)">
              Edit
            </button>

          </td>
        </tr>

        </tbody>
      </table>

    </div>

  </div>


</template>

<script>

import SubmitRequest from "../mixins/SubmitRequest";
import GetData from "../mixins/GetData";
import {resetForm} from '@/helpers'

export default {

  mixins: [SubmitRequest, GetData],

  data() {

    return {

      skills: [],

      form_submitted: false,

      form_url: 'skills',

      form: {
        fields: {
          name: '', years_of_experience: ''
        },
        errors: {
          name: '', years_of_experience: ''
        }
      },

    }

  },

  methods: {

    saveSkill() {

      this.submitRequest((response) => {

        const skill = response.data.data.skill;

        const pos = this.skills.findIndex(element => element.id == skill.id);

        if (pos === -1) { // push only if new skill was created
          this.skills.push(response.data.data.skill)
        } else {
          this.skills.splice(pos, 1, skill)

        }

        this.form_url = 'skills'; // reset url to create new records

      });
    },

    skillDeleted(response) {
      const pos = this.skills.findIndex(element => element.id == response.id);
      if (pos > -1) {
        this.skills.splice(pos, 1);
      }
    },


    editSkill(index) {
      const skill = this.skills[index];
      this.form.fields.name = skill.name;
      this.form.fields.years_of_experience = skill.years_of_experience;

      this.form.fields._method = 'PUT';
      this.form_url = `skills/${skill.id}`
    },

    resetForm() {
      this.form_url = 'skills'
      resetForm(this.form.fields, this.form.errors);
      this.form.fields._method = '';
    }

  },

  created() {

    this.getData('skills', '', '', (response) => {
      this.skills = response.data.data.skills;
    })

  },

  computed: {

    skillsCount() {
      return this.skills.length
    }

  }

}
</script>
