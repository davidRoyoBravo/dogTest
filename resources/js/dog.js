
$(document).ready(function() {
   $('#form-add-dog .know-birthday').on('change', (e) => {
       const element = $(e.target);
       if(element.is(':checked')) {
           $('#form-add-dog .dogAge').addClass('d-none');
           $('#form-add-dog .dogBornDate').removeClass('d-none');
       } else {
           $('#form-add-dog .dogAge').removeClass('d-none');
           $('#form-add-dog .dogBornDate').addClass('d-none');
       }
   });

    $('#form-add-dog').on('submit',async (e) => {
        e.preventDefault();
        const form = $(e.target);
        form.find('.invalid-feedback').removeClass('d-inline');
        changeFormSubmitButton(form.find(':submit'));
        const payload = processFormParams(form.serializeArray());
        try {
            const resp = await axios.post('/api/dog', payload);
            window.location = '/dog';
        } catch (error) {
            showErrorsForm(form, error.response.data.errors);
        }
        changeFormSubmitButton(form.find(':submit'), false);
        return false;
    });

    const showErrorsForm = (form, errors) => {
        for (const error in errors) {
            const element = form.find('input[name=' + error + ']').siblings('.invalid-feedback');
            element.text(errors[error]);
            element.addClass('d-inline');
        }
    };

    const changeFormSubmitButton = (button, activate = true) => {
        if (activate === true) {
            button.find('.title').addClass('d-none');
            button.find('.loader').removeClass('d-none');
            button.prop('disabled', true);
        } else {
            button.find('.title').removeClass('d-none');
            button.find('.loader').addClass('d-none');
            button.prop('disabled', false);
        }
    }

    const processFormParams = params => {
        let payload = {};
        Object.keys(params).forEach((key) => {
            if(params[key].value) {
                payload[params[key].name] = params[key].value;
            }
        })
        return payload;
    }
});
