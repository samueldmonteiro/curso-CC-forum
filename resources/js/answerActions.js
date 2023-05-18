import { qs, qsAll } from './utils';
import alert from './alert';

qs("#answer").addEventListener('click', _ => {

    let writeAnswerArea = qs(".write-answer");
    writeAnswerArea.classList.toggle('hide-write-answer');
    writeAnswerArea.classList.toggle('show-write-answer');
});

/**qs('#sendAnswerBtn').addEventListener('click', _ => {

    if (tinyMCE.get('answerContent').getContent() == "") {
        const errorMessage = alert('Escreva algo na sua resposta!', 'error');
        if (!qs('.answer-topic').querySelector('.alert')) qs('.answer-topic').prepend(errorMessage);
    }
});
**/
if (qs(".answer-item")) {
    qsAll(".answer-item").forEach(answerItem => {
        let buttonDeleteAnswer = answerItem.querySelector("#button-delete-answer");
        if (buttonDeleteAnswer) {
            buttonDeleteAnswer.addEventListener("click", buildAnswerDeletetion);
        }
    })
}

function buildAnswerDeletetion(e) {
    modalDeleteAnswer = qs("#modalDeleteAnswer");
    answerId = e.currentTarget.closest(".answer-item").dataset.id;
    modalDeleteAnswer.dataset.id = answerId;
}


if (qs(".delete-ok")) {
    qs(".delete-ok").addEventListener("click", confirmAnswerDeletetion)
}

function confirmAnswerDeletetion(e) {
    idAnswer = e.currentTarget.closest("#modalDeleteAnswer").dataset.id;
    form = new FormData();
    form.append("id_answer", idAnswer);

    fetch("answer_delete_action.php", {
        method: "POST",
        body: form
    }).then(() => {
        window.location.reload();
    })
}

if (qs("#like-answer")) {
    qsAll("#like-answer").forEach(buttonLike => {
        buttonLike.addEventListener("click", likeAnswer)
    })
}

function likeAnswer(e) {
    iconLike = e.currentTarget.querySelector('i');
    countLike = e.currentTarget.querySelector(".count-like");
    answerId = e.currentTarget.closest(".answer-item").dataset.id;

    if (iconLike.classList.contains('bi-heart')) {
        iconLike.classList.remove('bi-heart')
        iconLike.classList.add('bi-heart-fill')
        countLike.innerHTML = parseInt(countLike.innerHTML) + 1

    } else {
        iconLike.classList.add('bi-heart')
        iconLike.classList.remove('bi-heart-fill')
        countLike.innerHTML = parseInt(countLike.innerHTML) - 1
    }

    form = new FormData();
    form.append("id_answer", answerId);
    fetch("answer_like_action.php", {
        method: "POST",
        body: form
    })
}

//114
