import { qs, qsAll } from './utils';
import alert from './alert';

const topicModal = qs('#modal-topic');

topicModal.querySelector('form').addEventListener('submit', async function(e) {

    e.preventDefault();

    const topicData = {
        category: this.querySelector('#t-category').value,
        title: this.querySelector('#t-title').value,
        content: tinyMCE.get('topicBody').getContent()
    }
    console.log(topicData);
    const resp = await axios.post(
        this.action, topicData,
        { headers: { 'Content-Type': 'application/json' } }
    );

    const data = resp.data;
    console.log(data);

    if (topicModal.querySelector('.alert')) topicModal.querySelector('.alert').remove();
    topicModal.querySelector('.modal-body').prepend(alert(data.message, data.type));

    if (data.type == 'info') {
        setTimeout(_ => {
            window.location.href = data.redirect;
        }, 900);
    }
});

