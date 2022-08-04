<template>
  <div v-if="confirming" class="my-1">

    <button :disabled="deleting_item" type="button" class=" px-2 py-1 rounded text-sm text-white"
            :class="deleting_item ? 'bg-red-400': 'bg-red-500'"
            @click="deleteItem">
      Yes
    </button>

    <button :disabled="deleting_item" type="button" class="bg-gray-400 px-2 py-1 rounded text-sm text-white"
            @click="confirming=false">
      No
    </button>

  </div>
  <button v-else type="button" class="py-1 text-sm text-white bg-yellow-400 rounded px-2"
          @click="showPrompt">
    Delete
  </button>
</template>

<script>

import axios from "axios";

export default {
  name: "DeleteButton",
  props: {
    delete_url: {
      type: String,
      required: false
    },
    show_prompt: {
      type: Boolean,
      default: true,
    },
    onDeleteCallback: {
      type: Function,
      default: null
    }
  },

  emits: ['DeleteItem', 'ItemDeleted'],

  data() {
    return {
      confirming: false,
      deleting_item: false
    }
  },
  methods: {
    deleteItem() {

      if (this.onDeleteCallback) {

        this.onDeleteCallback();
        this.deleting_item = false;
        this.confirming = false;

      } else {

        this.deleting_item = true;

        const form_data = new FormData();
        form_data.append('_method', 'DELETE'); // Required By Laravel

        let headers = {
          'accept': 'application/json',
          'Authorization': 'Bearer ' + localStorage.getItem('auth_token'),
        }

        let axios_config = {
          headers: headers
        }

        axios
          .post(`${this.$config.apiUrl}/${this.delete_url}`, form_data, axios_config)
          .then((response) => {

            this.deleting_item = false;
            this.confirming = false;

            if (response.data.has_err) {
              alert(response.data.message)

            } else {
              alert("Deleted successfully")
              this.$emit('ItemDeleted', response.data.data);
            }

          })
          .catch((error) => {

            let response_err = error.response;

            if (response_err) { // status code that falls out of the range of 2xx

              // If your user's session expires due to lack of activity, subsequent requests to the Laravel application may
              // receive 401 or 419 HTTP error response
              if (response_err.status == 401 || response_err.status == 419) {
                //alert('Session expired, you need to login again')
                window.location.href = '/login';
              } else {
                alert(response_err.data.message)
              }

            } else {
              alert(error)
            }

            this.deleting_item = false;
            this.confirming = false;

          });

      }

    },
    showPrompt() {
      if (this.show_prompt) {
        this.confirming = true;
      }
    }
  }
}
</script>
