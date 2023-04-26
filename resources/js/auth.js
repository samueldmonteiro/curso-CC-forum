import './bootstrap';
import alert from './alert';

document.querySelector('.form-login').addEventListener('submit', async e => {
    e.preventDefault();
    const form = e.currentTarget;
    const formData = new FormData(form);

    const loginData = JSON.stringify({ email: formData.get('email'), password: formData.get('password') });
    console.log(loginData, form.action);

    const result = await axios.post(
        form.action, loginData,
        { headers: { 'Content-Type': 'application/json' } }
    );

    const data = result.data;

    const container = document.querySelector('.form-body');
    if (container.querySelector('.alert')) container.querySelector('.alert').remove();
    document.querySelector('.form-login-body').prepend(alert(data.message, data.type));

    if (data.status == true) {
        setTimeout(_ => {
            window.location.href = data.redirect;
        }, 1500);
    }

    console.log(result.data);
});
