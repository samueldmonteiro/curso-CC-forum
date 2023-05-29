import './bootstrap';
import alert from './alert';
import { qs, qsAll } from "./utils";

qs('.form-login').addEventListener('submit', async e => {
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

    const container = qs('.form-body');
    if (container.querySelector('.alert')) container.querySelector('.alert').remove();
    qs('.form-login-body').prepend(alert(data.message, data.type));

    if (data.status == true) {
        setTimeout(_ => {
            window.location.href = data.redirect;
        }, 1500);
    }

    console.log(result.data);
});
