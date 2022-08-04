<template>

  <div class="grid grid-cols-12 gap-6 w-full px-10 my-5">

    <h1 class="bg-indigo-100 col-span-12 py-1 text-2xl text-center">Work Experience</h1>

    <div class="col-span-12 md:col-span-4">

      <label class="block mb-3">
        <span class="text-gray-700">Job Title</span>
        <input type="text" class="mt-1 block w-full" v-model="form.fields.job_title">
        <div class="text-red-600" v-if="form.errors.job_title">{{ form.errors.job_title }}</div>
      </label>

      <label class="block mb-3">
        <span class="text-gray-700">Company</span>
        <input type="text" class="mt-1 block w-full" v-model="form.fields.company_name">
        <div class="text-red-600" v-if="form.errors.company_name">{{ form.errors.company_name }}</div>
      </label>

      <div class="flex justify-between">

        <label class="block mb-3 w-1/2 mr-2">
          <span class="text-gray-700">Start Date</span>
          <input type="date" class="mt-1 block w-full form-input" v-model="form.fields.start_date">
          <div class="text-red-600" v-if="form.errors.start_date">{{ form.errors.start_date }}</div>
        </label>

        <label class="block mb-3 w-1/2">
          <span class="text-gray-700">End Date</span>
          <input type="date" class="mt-1 block w-full" v-model="form.fields.end_date">
          <div class="text-red-600" v-if="form.errors.end_date">{{ form.errors.end_date }}</div>
        </label>

      </div>


      <div class="flex justify-between">

        <label class="block mb-3 w-1/2 mr-2 mt-1">
          <span class="text-gray-700">Country</span>
          <select class="form-select w-full" v-model="form.fields.country_id">
            <option v-for="country in countries" :value="country.id">
              {{ country.name }}
            </option>
          </select>
          <div class="text-red-600" v-if="form.errors.country_id">{{ form.errors.country_id }}</div>
        </label>

        <label class="block mb-3 w-1/2">
          <span class="text-gray-700">City</span>
          <input type="text" class="mt-1 block w-full" v-model="form.fields.city">
          <div class="text-red-600" v-if="form.errors.city">{{ form.errors.city }}</div>
        </label>

      </div>

      <label class="block mb-3">
        <span class="text-gray-700">Description</span>
        <textarea class="mt-1 block w-full" v-model="form.fields.city"></textarea>
        <div class="text-red-600" v-if="form.errors.city">{{ form.errors.city }}</div>
      </label>

      <div class="flex justify-center">

        <button type="button" @click="saveExperience"
                class="bg-green-400 font-semibold mr-3 mt-3 py-2 rounded-md text-white w-1/2">
          Save
        </button>

        <button type="button" @click="resetForm"
                class="bg-gray-400 font-semibold mt-3 py-2 rounded-md text-white w-1/2">
          Cancel
        </button>

      </div>

    </div>

    <div v-if="experiencesCount" class="col-span-12 md:col-span-8">

      <table class="table-auto table-auto text-center w-full">
        <thead>
        <tr>
          <th>Job Title</th>
          <th>Company</th>
          <th>Duration</th>
          <th>Location</th>
          <th>Actions</th>
        </tr>
        </thead>

        <tbody class="bg-white divide-y">
        <tr v-for="(experience, index) in experiences">
          <td class="py-4">{{ experience.job_title }}</td>
          <td>{{ experience.company_name }}</td>
          <td>{{ experience.start_date }} - {{ experience.end_date ?? '' }}</td>
          <td>
            <span v-if="experience.country_id">
              {{ getCountryName(experience.country_id) }}, {{ experience.city }}
            </span>
          </td>
          <td>

            <DeleteButton :delete_url="`experiences/${experience.id}`" @ItemDeleted="experienceDeleted"/>

            <button type="button" class="bg-indigo-400 px-5 py-1 rounded text-sm text-white"
                    @click="editExercise(index)">
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

      countries: [],

      experiences: [],

      form_submitted: false,

      form_url: 'experiences',

      form: {
        fields: {
          job_title: '', start_date: '', end_date: '',
          company_name: '', country_id: '', city: '', description: ''
        },
        errors: {
          job_title: '', start_date: '', end_date: '',
          company_name: '', country_id: '', city: '', description: ''
        }
      },

    }

  },

  methods: {

    saveExperience() {

      this.submitRequest((response) => {

        const experience = response.data.data.experience;

        const pos = this.experiences.findIndex(element => element.id == experience.id);

        if (pos === -1) { // push only if new experience was created
          this.experiences.push(response.data.data.experience)
        } else {
          this.experiences.splice(pos, 1, experience)

        }

        this.form_url = 'experiences'; // reset url to create new records

      });
    },

    experienceDeleted(response) {
      const pos = this.experiences.findIndex(element => element.id == response.id);
      if (pos > -1) {
        this.experiences.splice(pos, 1);
      }
    },

    getCountryName(country_id) {
      const country = this.countries.find(element => element.id == country_id);
      return country ? country.name : '';
    },

    editExercise(index) {
      const exercise = this.experiences[index];
      this.form.fields.job_title = exercise.job_title;
      this.form.fields.start_date = exercise.start_date;
      this.form.fields.end_date = exercise.end_date;
      this.form.fields.company_name = exercise.company_name;
      this.form.fields.country_id = exercise.country_id;
      this.form.fields.city = exercise.city;
      this.form.fields.description = exercise.description;

      this.form.fields._method = 'PUT';
      this.form_url = `experiences/${exercise.id}`
    },

    resetForm() {
      this.form_url = 'experiences'
      resetForm(this.form.fields, this.form.errors);
      this.form.fields._method = '';
    }

  },

  created() {

    this.getData('countries', '', '', (response) => {
      this.countries = response.data.data.countries;
    })

    this.getData('experiences', '', '', (response) => {
      this.experiences = response.data.data.experiences;
    })

  },

  computed: {

    experiencesCount() {
      return this.experiences.length
    }

  }

}
</script>
