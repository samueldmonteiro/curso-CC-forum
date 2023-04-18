import './bootstrap';
import { newMessage } from './newMessage';

document.querySelectorAll('.auth-form').forEach(form => {
    form.addEventListener('submit', async e => {
        e.preventDefault();
        const form = e.currentTarget;
        const formData = new FormData(form);

        const postData = JSON.stringify({ email: formData.get('email'), password: formData.get('password') });
        console.log(postData, form.action);

        const result = await axios.post(
            form.action, postData,
            { headers: { 'Content-Type': 'application/json' } }
        );

        const data = result.data;

        const container = document.querySelector('.form-login-body');
        if (container.querySelector('.alert')) container.querySelector('.alert').remove();
        document.querySelector('.form-login-body').prepend(newMessage(data.message, data.type));

        if (data.status == true) {
            setTimeout(_ => {
                window.location.href = data.redirect;
            }, 1500);
        }

        console.log(result.data);
    });
});
