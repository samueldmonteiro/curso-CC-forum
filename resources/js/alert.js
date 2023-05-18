export default function alert(content, type) {

    if (type == 'error') type = 'danger';

    const message = document.createElement('div');
    const style = `alert-${type}`;
    message.classList.add('alert', 'text-center', style);
    message.innerText = content;
    return message;
}
