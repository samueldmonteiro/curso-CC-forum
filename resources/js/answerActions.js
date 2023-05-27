import { qs, qsAll } from './utils';
import alert from './alert';

qs("#answer").addEventListener('click', _ => {

    let writeAnswerArea = qs(".write-answer");
    writeAnswerArea.classList.toggle('hide-write-answer');
    writeAnswerArea.classList.toggle('show-write-answer');
});

const modalAnswerDelete = qs("#modalDeleteAnswer");

if (qs(".answer-item")) {
    qsAll(".answer-item").forEach(answerItem => {
        let buttonDeleteAnswer = answerItem.querySelector("#button-delete-answer");
        if (buttonDeleteAnswer) {
            buttonDeleteAnswer.addEventListener("click", e => {
                modalAnswerDelete.dataset.answer = answerItem.dataset.id;
                modalAnswerDelete.dataset.url = buttonDeleteAnswer.dataset.url;
            });
        }
    });

    modalAnswerDelete.querySelector('.confirm').addEventListener('click', answerDelete);
}

async function answerDelete() {

    const data = JSON.stringify({
        answer: modalAnswerDelete.dataset.answer
    });

    axios.delete(
        modalAnswerDelete.dataset.url,
        {
            data: data,
            headers: {
                'Content-Type': 'application/json',
            }
        }
    ).then(response => {
        window.location.reload();
    }).catch(error => {
        console.log(error.response.data.message);
        console.log(error.response.data.errors);
        modalAnswerDelete.prepend(alert(error.response.data.message, 'error'));
    });
}

if (qs(".answer-item")) {
    qsAll('#like-answer').forEach(likeArea => {
        likeArea.addEventListener("click", answerLikeToggle)
    });
}

function answerLikeToggle(e) {
    let iconLike = e.currentTarget.querySelector('i');
    let countLike = e.currentTarget.querySelector(".count-like");
    let answerId = e.currentTarget.closest(".answer-item").dataset.id;

    iconLike.classList.toggle('bi-heart');
    iconLike.classList.toggle('bi-heart-fill');

    if (!iconLike.classList.contains('bi-heart')) {
        countLike.innerHTML = parseInt(countLike.innerHTML) + 1;
    } else {
        countLike.innerHTML = parseInt(countLike.innerHTML) - 1;
    }

    const data = JSON.stringify({ answer: parseInt(answerId) });

    axios.post(
        '/respostas/like', data,
        { headers: { 'Content-Type': 'application/json' } }
    ).then(response => {
        console.log(response.data);
    }).catch(error => {
        console.log(error.response.data.message);
        console.log(error.response.data.errors);
    });
}

//114
