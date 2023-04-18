if(document.querySelector(".answer-item")){
    document.querySelectorAll(".answer-item").forEach(answerItem =>{
        buttonDeleteAnswer = answerItem.querySelector("#button-delete-answer");
        if(buttonDeleteAnswer){
            buttonDeleteAnswer.addEventListener("click",buildAnswerDeletetion);
        }
    })
}

function buildAnswerDeletetion(e){
    modalDeleteAnswer = document.querySelector("#modalDeleteAnswer");
    answerId = e.currentTarget.closest(".answer-item").dataset.id;
    modalDeleteAnswer.dataset.id = answerId;
}


if(document.querySelector(".delete-ok")){
    document.querySelector(".delete-ok").addEventListener("click", confirmAnswerDeletetion)
}

function confirmAnswerDeletetion(e){
    idAnswer = e.currentTarget.closest("#modalDeleteAnswer").dataset.id;
    form = new FormData();
    form.append("id_answer", idAnswer);

    fetch("answer_delete_action.php",{
        method: "POST",
        body: form
    }).then(()=>{
        window.location.reload();
    })
}

if(document.querySelector("#like-answer")){
    document.querySelectorAll("#like-answer").forEach(buttonLike =>{
        buttonLike.addEventListener("click",likeAnswer)
    })
}

function likeAnswer(e){
    iconLike = e.currentTarget.querySelector('i');
    countLike = e.currentTarget.querySelector(".count-like");
    answerId = e.currentTarget.closest(".answer-item").dataset.id;

    if(iconLike.classList.contains('bi-heart')){
        iconLike.classList.remove('bi-heart')
        iconLike.classList.add('bi-heart-fill')
        countLike.innerHTML = parseInt(countLike.innerHTML) + 1

    }else{
        iconLike.classList.add('bi-heart')
        iconLike.classList.remove('bi-heart-fill')
        countLike.innerHTML = parseInt(countLike.innerHTML) - 1
    }

    form = new FormData();
    form.append("id_answer", answerId);
    fetch("answer_like_action.php",{
        method: "POST",
        body: form
    })
}

if(document.querySelector("#send-answer")){
    document.querySelector("#send-answer").addEventListener("click",function(e){
        buildFormAnswer(e)
    })
}

function buildFormAnswer(e){
    sendButton = e.currentTarget;
    topicItem = sendButton.closest(".topic-item");
    contentAnswer = topicItem.querySelector("#content-answer").value;
    topicId = topicItem.dataset.id;

    formData = new FormData();
    formData.append("id_topic", topicId);
    formData.append("content_answer", contentAnswer);

    sendFormAnswer(formData);
}

function sendFormAnswer(form){
    fetch("answer_action.php",{
        method: "POST",
        body: form
    })
    .then(res => res.json())
    .then(function(json){

        if(json.type != "error"){
            window.location.reload();
        }
    })
}