import './bootstrap';
import { qs, qsAll } from './utils';

// topics
if (qs('.topic-subject')) {
    qsAll('.topic-subject').forEach(subject => {

        const content = subject.innerHTML;
        if (content.length > 150) {
            subject.innerHTML = subject.innerHTML.substring(0, 150) + '...';
        }
    });
}

qs('.search-topics').addEventListener('submit', e => {
    e.preventDefault();
    searchTopics();
});

function searchTopics() {
    const search = qs('#search').value;
    window.location.href = '/busca/' + search;
}
