<template>

  <div class="grid grid-cols-12 gap-6 w-full px-10 my-5">

    <h1 class="bg-indigo-100 col-span-12 py-1 text-2xl text-center">Education</h1>

    <div class="col-span-12 md:col-span-4">

      <label class="block mb-3">
        <span class="text-gray-700">School</span>
        <input type="text" class="mt-1 block w-full" v-model="form.fields.school">
        <div class="text-red-600" v-if="form.errors.school">{{ form.errors.school }}</div>
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

      <label class="block mb-3 w-full mr-2">
        <span class="text-gray-700">Degree</span>
        <input type="text" class="mt-1 block w-full form-input" v-model="form.fields.degree">
        <div class="text-red-600" v-if="form.errors.degree">{{ form.errors.degree }}</div>
      </label>


      <label class="block mb-3">
        <span class="text-gray-700">Field of Study</span>
        <textarea class="mt-1 block w-full" v-model="form.fields.field_of_study"></textarea>
        <div class="text-red-600" v-if="form.errors.field_of_study">{{ form.errors.field_of_study }}</div>
      </label>

      <div class="flex justify-center">

        <button type="button" @click="saveEducation"
                class="bg-green-400 font-semibold mr-3 mt-3 py-2 rounded-md text-white w-1/2">
          Save
        </button>

        <button type="button" @click="resetForm"
                class="bg-gray-400 font-semibold mt-3 py-2 rounded-md text-white w-1/2">
          Cancel
        </button>

      </div>

    </div>

    <div v-if="educationsCount" class="col-span-12 md:col-span-8">

      <table class="table-auto table-auto text-center w-full">
        <thead>
        <tr>
          <th>School</th>
          <th>Duration</th>
          <th>Degree</th>
          <th>Field of Study</th>
          <th>Actions</th>
        </tr>
        </thead>

        <tbody class="bg-white divide-y">
        <tr v-for="(education, index) in educations">
          <td class="py-4">{{ education.school }}</td>
          <td>{{ education.start_date }} - {{ education.end_date ?? '' }}</td>
          <td>{{ education.degree }}</td>
          <td>{{ education.field_of_study }}</td>
          <td>

            <DeleteButton :delete_url="`education/${education.id}`" @ItemDeleted="educationDeleted"/>

            <button type="button" class="bg-indigo-400 px-5 py-1 rounded text-sm text-white"
                    @click="editEducation(index)">
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

      educations: [],

      form_submitted: false,

      form_url: 'education',

      form: {
        fields: {
          school: '', start_date: '', end_date: '', degree: '', field_of_study: ''
        },
        errors: {
          school: '', start_date: '', end_date: '', degree: '', field_of_study: ''
        }
      },

    }

  },

  methods: {

    saveEducation() {

      this.submitRequest((response) => {

        const education = response.data.data.education;

        const pos = this.educations.findIndex(element => element.id == education.id);

        if (pos === -1) { // push only if new education was created
          this.educations.push(response.data.data.education)
        } else {
          this.educations.splice(pos, 1, education)

        }

        this.form_url = 'education'; // reset url to create new records

      });
    },

    educationDeleted(response) {
      const pos = this.educations.findIndex(element => element.id == response.id);
      if (pos > -1) {
        this.educations.splice(pos, 1);
      }
    },


    editEducation(index) {
      const education = this.educations[index];
      this.form.fields.school = education.school;
      this.form.fields.start_date = education.start_date;
      this.form.fields.end_date = education.end_date;
      this.form.fields.degree = education.degree;
      this.form.fields.field_of_study = education.field_of_study;


      this.form.fields._method = 'PUT';
      this.form_url = `education/${education.id}`
    },

    resetForm() {
      this.form_url = 'education'
      resetForm(this.form.fields, this.form.errors);
      this.form.fields._method = '';
    }

  },

  created() {

    this.getData('education', '', '', (response) => {
      this.educations = response.data.data.educations;
    })

  },

  computed: {

    educationsCount() {
      return this.educations.length
    }

  }

}
</script>
