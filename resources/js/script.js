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


