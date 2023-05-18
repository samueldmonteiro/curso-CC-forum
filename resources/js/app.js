import './bootstrap';
import { qs, qsAll } from './utils';

// topics
if (qs('.topic-subject')) {
    qsAll('.topic-subject').forEach(subject => {

        const content = subject.innerHTML;
        console.log(content);
        if (content.length > 150) {
            subject.innerHTML = subject.innerHTML.substring(0, 150) + '...';
        }
    });
}

