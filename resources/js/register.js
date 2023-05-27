import './bootstrap';
import alert from './alert';

document.querySelector('.form-register').addEventListener('submit', async e => {
    e.preventDefault();
    const form = e.currentTarget;
    const formData = new FormData(form);

    const registerData = JSON.stringify({
        name: formData.get('name'),
        email: formData.get('email'),
        password: formData.get('password'),
        confirm_password: formData.get('confirm_password'),
    });

    const formContainer = document.querySelector('.form-body');

    axios.post(
        form.action, registerData,
        { headers: { 'Content-Type': 'application/json' } }
    ).then(response => {

        if (formContainer.querySelector('.alert')) formContainer.querySelector('.alert').remove();
        formContainer.prepend(alert(response.data.message, response.data.type));

        window.location.href = response.data.redirect;
    }).catch(error => {

        if (formContainer.querySelector('.alert')) formContainer.querySelector('.alert').remove();
        formContainer.prepend(alert(error.response.data.message, 'error'));

    });
});


