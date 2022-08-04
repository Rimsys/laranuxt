import axios from "axios";
import {concatenateError} from "@/helpers";

export default {

  methods: {

    getData(url, query_string_obj, hide_loader_callback, success_callback, retry_callback) {

      let headers = {
        'accept': 'application/json',
      }

      if (typeof window !== 'undefined') {
        headers['Authorization'] = 'Bearer ' + localStorage.getItem('auth_token')
      }

      let axios_config = {
        headers: headers,
        params: query_string_obj
      }

      axios.get(`${this.$config.apiUrl}/${url}`, axios_config).then((response) => {

        // handle success
        if (hide_loader_callback) {
          hide_loader_callback();
        }


        if (response.data.has_err) {
          alert(response.data.message);
          if (retry_callback) {
            retry_callback()
          }
        } else {
          if (success_callback) {
            success_callback(response);
          }
        }

      }).catch((error) => {

        // handle error
        if (hide_loader_callback) {
          hide_loader_callback()
        }

        if (retry_callback) {
          retry_callback();
        }


        let response_err = error.response;

        if (response_err) { // status code that falls out of the range of 2xx
          if (response_err.status == 422) {
            alert(concatenateError(response_err.data.errors));

          } else {

            // If your user's session expires due to lack of activity, subsequent requests to the Laravel application may
            // receive 401 or 419 HTTP error response
            if (response_err.status == 401 || response_err.status == 419) {
              //alert('Session expired, you need to login again');
              window.location.href = '/login';
            } else {
              alert(response_err.data.message);
            }

          }
        } else {
          alert(error);
        }

      });

    }

  }
}
