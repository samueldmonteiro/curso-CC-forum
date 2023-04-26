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

    const result = await axios.post(
        form.action, registerData,
        { headers: { 'Content-Type': 'application/json' } }
    );

    const response = result.data;
    console.log(response);

    const container = document.querySelector('.form-body');
    if (container.querySelector('.alert')) container.querySelector('.alert').remove();
    container.prepend(alert(response.message, response.type));

    if (response.status == true) {
        window.location.href = response.redirect;
    }
});


