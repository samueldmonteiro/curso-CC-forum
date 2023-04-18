if(document.querySelector(".topic-subject")){

    document.querySelectorAll(".topic-subject").forEach(subject =>{
        content = subject.innerHTML;

        if(content.length > 150){

            minSubject = subject.innerHTML.substring(0,150) + "...";
            subject.innerHTML = minSubject;
        }
    })
}

if(document.querySelector('#answer') && document.querySelector(".write-answer")){
    document.querySelector("#answer").addEventListener('click',writeAnswer)
}

function writeAnswer(){

    localWrite = document.querySelector(".write-answer");

    if(localWrite.classList.contains('hide-write-answer')){
        localWrite.classList.remove("hide-write-answer")
        localWrite.classList.add("show-write-answer")

    }else{

        localWrite.classList.add("hide-write-answer")
        localWrite.classList.remove("show-write-answer") 
    }
}



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
if(document.querySelector("#confirmDeletionTopic")){
    document.querySelector("#confirmDeletionTopic").addEventListener("click", confirmDeletionTopic)
}

if(document.querySelector("#delete-topic")){
    document.querySelector("#delete-topic").addEventListener("click", buildTopicDeletetion)
}

if(document.querySelector(".form-create-topic")){

    formCreateTopic = document.querySelector(".form-create-topic");

    formCreateTopic.addEventListener("submit",function(e){
        buildForm(e, sendFormTopic);
    })
}

if(document.querySelector("#completed-topic")){

    buttonCompleteTopic = document.querySelector("#completed-topic");
    buttonCompleteTopic.addEventListener("click",completeTopic)
}

function buildTopicDeletetion(e){
    topicId = e.currentTarget.closest(".topic-item").dataset.id;
    modalDeleteTopic = document.querySelector("#modalDeleteTopic");
    modalDeleteTopic.dataset.id = topicId;
    
}

function confirmDeletionTopic(e){
    topicId = e.currentTarget.closest("#modalDeleteTopic").dataset.id;
    form = new FormData();
    form.append("topic_id", topicId);

    fetch("topic_delete_action.php",{
        method: "POST",
        body: form
    }).then(()=>{
       window.location.reload();
    })
}

function completeTopic(e){

    topicId = e.currentTarget.closest(".topic-item").dataset.id;
    
    form = new FormData();
    form.append("topic_id", topicId);

    fetch("topic_state_action.php",{
        method:"POST",
        body: form
    })
    .then(()=>{
        window.location.reload();
    })
}

function sendFormTopic(form){
  
    fetch("topic_action.php",{
        method: "POST",
        body: form
    })
    .then(res => res.json())
    .then((json)=>{

        console.log(json);
        displayMessage(json.type, json.msg, 2000);
        
        if(json.type != "error"){
            insertNewTopic(json.data)
        }
    })
}

function insertNewTopic(info){

    containerTopic = document.querySelector(".topics");
    
    try{
        topicItem = document.querySelector(".topic-item-preview").cloneNode(true);
    }catch(e){
        window.location.reload();
    }
    
    info.content_topic = info.content_topic.replaceAll('&#13;', "<br>");

    topicItem.querySelector(".user-avatar").style = `background-image: url('${info.user_avatar}')`;
    topicItem.querySelector(".username").innerHTML = info.user_name;
    topicItem.querySelector(".username").href = info.user_profile;
    topicItem.querySelector(".short-info").innerHTML = `${info.category_topic} - ${info.user_grade}ºano`;
    topicItem.querySelector(".state").innerHTML = info.state_topic;
    topicItem.querySelector(".count-answers span").innerHTML = info.count_answers;
    topicItem.querySelector(".topic-subject").innerHTML = info.content_topic;
    topicItem.querySelector(".answer-topic a").href = info.answer_topic;

    containerTopic.prepend(topicItem)

}
