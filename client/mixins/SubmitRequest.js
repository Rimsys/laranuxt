import {clearErrorsFromFields, clearFormFields, concatenateError, showErrorsBelowFields} from '@/helpers'
import axios from "axios";
import {serialize} from 'object-to-formdata'

export default {

  data() {

    return {

      additional_form_data: {},

      form_submitted: false,

      success_message: '',

      reset_form: true, // it will be overridden to 'false' from every component in case of edit

      form_has_file: false
    }

  },

  methods: {

    submitRequest(success_callback, error_callback) {

      this.form_submitted = true;

      if (this.form) {
        clearErrorsFromFields(this.form.errors);
      }

      let form_data = null;

      if (this.form) {
        form_data = serialize(this.form.fields, {indices: true, booleansAsIntegers: true});

        for (const key in this.additional_form_data) {
          form_data.append(key, this.additional_form_data[key]);
        }
      }

      let headers = {
        'accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('auth_token'),
      }

      if (this.form_has_file) {
        headers['content-type'] = 'multipart/form-data'
      }

      let axios_config = {
        headers: headers
      }

      axios
        .post(`${this.$config.apiUrl}/${this.form_url}`, form_data, axios_config)
        .then((response) => {

          this.form_submitted = false;

          if (response.data.has_err) {

            alert(response.data.message)

          } else {
            // reset form-controls in case of creating a resource (i.e. keep data in form-controls in case of editing a resource) but
            // data should remain in form-controls if the case is 'edit'
            if (this.form && this.reset_form) {
              clearFormFields(this.form.fields)
            }


            if (success_callback && typeof success_callback === 'function') {
              success_callback(response);
            }

            if (response.data.message) {
              alert(response.data.message);

            } else if (this.success_message) {
              alert(this.success_message)

            } else {
              alert('Saved successfully')
            }

          }

        })
        .catch((error) => {

          let response_err = error.response;

          if (response_err) { // status code that falls out of the range of 2xx

            if (response_err.status == 422) {
              if (this.form) {
                showErrorsBelowFields(response_err.data.errors, this.form.errors);
                //alert('Please fix errors')

              } else {
                alert(concatenateError(response_err.data.errors))
              }
            } else {

              // If your user's session expires due to lack of activity, subsequent requests to the Laravel application may
              // receive 401 or 419 HTTP error response
              if (response_err.status == 401 || response_err.status == 419) {
                //alert('Session expired, you need to login again');
                window.location.href = '/login';
              } else {
                alert(response_err.data.message)
              }

            }

          } else {
            alert(error)
          }

          this.form_submitted = false;

          if (error_callback && typeof error_callback === 'function') {
            error_callback(error);
          }


        });
    }
  }

}
