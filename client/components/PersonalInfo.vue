<template>

  <div class="grid grid-cols-12 gap-6 w-full px-10 my-5">

    <h1 class="bg-indigo-100 col-span-12 py-1 text-2xl text-center">Personal Information</h1>

    <div class="col-span-12 md:col-span-4">

      <label class="block mb-3">
        <span class="text-gray-700">Name</span>
        <input type="text" class="mt-1 block w-full" v-model="form.fields.name">
        <div class="text-red-600" v-if="form.errors.name">{{ form.errors.name }}</div>
      </label>

      <label v-if="form.fields.email" class="block mb-3">
        <span class="text-gray-700">Email</span>
        <div class="mt-1 block w-full">{{ form.fields.email }}</div>
      </label>


      <label class="block mb-3">
        <span class="text-gray-700">Phone Number</span>
        <input type="text" class="mt-1 block w-full" v-model="form.fields.phone_number">
        <div class="text-red-600" v-if="form.errors.phone_number">{{ form.errors.phone_number }}</div>
      </label>

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
        <span class="text-gray-700">Summary</span>
        <textarea class="mt-1 block w-full" v-model="form.fields.professional_summary"></textarea>
        <div class="text-red-600" v-if="form.errors.professional_summary">{{ form.errors.professional_summary }}</div>
      </label>

      <div class="flex justify-center">

        <button type="button" @click="savePersonalInfo"
                class="bg-green-400 font-semibold mr-3 mt-3 py-2 rounded-md text-white w-1/2">
          Save
        </button>

      </div>

    </div>

  </div>


</template>

<script>

import SubmitRequest from "../mixins/SubmitRequest";
import GetData from "../mixins/GetData";

export default {

  mixins: [SubmitRequest, GetData],

  data() {

    return {

      countries: [],

      form_submitted: false,

      form_url: '',

      reset_form: false,

      form: {
        fields: {
          name: '', email: '', phone_number: '', country_id: '', city: '', professional_summary: '',
        },
        errors: {
          name: '', phone_number: '', country_id: '', city: '', professional_summary: ''
        }
      },

    }

  },

  methods: {

    savePersonalInfo() {
      this.form.fields._method = 'PUT';
      this.submitRequest();
    },

  },

  created() {

    this.getData('countries', '', '', (response) => {
      this.countries = response.data.data.countries;
    })

    this.getData('users/get-personal-info', '', '', (response) => {

      const personal_info = response.data.data.personal_info;

      this.form.fields.name = personal_info.name;
      this.form.fields.email = personal_info.email;
      this.form.fields.phone_number = personal_info.phone_number;
      this.form.fields.country_id = personal_info.country_id;
      this.form.fields.city = personal_info.city;
      this.form.fields.professional_summary = personal_info.professional_summary;

      this.form_url = `users/${personal_info.id}`

    })

  },

}
</script>
