import alert from "./alert";
import { qs, qsAll } from './utils';


const topic = qs('.topic-item');
const topicId = topic.dataset.id;

qs('#confirmDeletionTopic').addEventListener('click', deleteTopic);

function deleteTopic() {

    axios.delete(`/topicos/${topicId}`, {
        headers: { 'Content-Type': 'application/json' }
    })
        .then(response => {
            console.log(response.data)
            window.location.href = '/';
        }).catch(error => {
            console.log(error)
        });
}

if (qs('#completed-topic')) {
    qs('#completed-topic').addEventListener('click', stateToggle);

    function stateToggle() {

        axios.post(`/topicos/${topicId}/state`, {
            headers: { 'Content-Type': 'application/json' }
        })
            .then(response => {
                console.log(response.data)
                window.location.reload();
            }).catch(error => {
                console.log(error);
            });
    }
}

