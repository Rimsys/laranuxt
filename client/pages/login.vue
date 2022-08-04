<template>

  <div class="flex items-center justify-center h-screen">

    <div class="grid grid-cols-12 gap-6 w-full px-10">

      <div class="col-span-12">

        <h1 class="text-center font-bold">Login</h1>

        <label class="block mb-3">
          <span class="text-gray-700">Email</span>
          <input type="text" class="mt-1 block w-full" v-model="form.fields.email">
          <div class="text-red-600" v-if="form.errors.email">{{ form.errors.email }}</div>
        </label>


        <label class="block mb-3">
          <span class="text-gray-700">Password</span>
          <input type="text" class="mt-1 block w-full" v-model="form.fields.password">
          <div class="text-red-600" v-if="form.errors.password">{{ form.errors.password }}</div>
        </label>


        <button type="button" @click="login" class="bg-green-400 font-semibold py-2 rounded-md text-white w-full mt-3">
          Login
        </button>

      </div>

    </div>

  </div>

</template>

<script>

import SubmitRequest from "../mixins/SubmitRequest";

export default {

  mixins: [SubmitRequest],

  data() {
    return {

      form_submitted: false,

      form_url: 'login',

      form: {
        fields: {
          email: '', password: ''
        },
        errors: {
          email: '', password: ''
        }
      },

    }
  },

  methods: {

    login() {

      this.submitRequest((response) => {

        localStorage.setItem('auth_token', response.data.data.token);

        setTimeout(() => {
          window.location.href = `${window.location.origin}/resume-builder`;
        }, 500);

      });
    }

  },

}
</script>
