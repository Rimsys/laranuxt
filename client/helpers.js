export function resetForm(fields, errors) {
    // clearing fields
    for (const field in fields) {
        fields[field] = '';
    }
    // clearing errors
    for (const field in errors) {
        errors[field] = '';
    }
}


export function clearErrorsFromFields(errors) {
    for (const attribute in errors) {
        // errors[attribute] = '';
        if (!Array.isArray(errors[attribute])) {
            errors[attribute] = '';
        }
    }

}

export function clearFormFields(form_fields, except) {

    if (!except) {
        except = [];
    }

    for (const attribute in form_fields) {
        if (!except.includes(attribute)) {
            if (Array.isArray(form_fields[attribute])) {
                form_fields[attribute] = [];
            } else {
                form_fields[attribute] = '';
            }
        }
    }
}


export function showErrorsBelowFields(errors, error_fields_arr) {

    for (const field_name in errors) {

        // checking if any of the array-based object has validation_errors (note: the format of array-based object's errors is
        // object.*.attribute) '*' is a index/position of the object in an array of objects
        //if (field_name.search(`${field_name}.`) >= 0) {
        if (field_name.indexOf(".") >= 0) {

            const index = field_name.replace(/[^0-9]/gi, "");

            const res = field_name.split(/\.\d+\./gm);

            error_fields_arr[res[0]][index][res[1]] = errors[field_name][0];

        } else {

            error_fields_arr[field_name] = errors[field_name][0];

        }

    }

}

export function concatenateError(errors) {
    let all_errors = '';
    for (const field_name in errors) {
        all_errors += `${errors[field_name][0]}<br>`;
    }
    return all_errors;
}

