
<?php

$stateStyle = "open";
if($topicItemPreview->state == "Concluído"){
    $stateStyle = "resolved";
}

?>
<div class="topic-item topic-item-preview">

    <div class="topic-item-head">
        <div class="topic-item-info">
            <div class="user-avatar" style="background-image: url('<?=$base?>media/avatars/<?=$topicItemPreview->user->avatar?>');"></div>
            <div>
                <a href="<?=$base?>profile.php?id=<?=$topicItemPreview->user->id?>" class="username"><?=$topicItemPreview->user->shortName()?></a>
                <p class="short-info"><?=$topicItemPreview->category?>  - <?=$topicItemPreview->user->grade?>ºano <span id="replyDate"><?=$topicItemPreview->replyDate()?></span></p>
            </div>
        </div>

        <div class="topic-item-states">
            <span class="state <?=$stateStyle?>"><?=$topicItemPreview->state?></span>
            <span class="count-answers"><i class="bi bi-chat-dots-fill"></i><span><?=count($topicItemPreview->answers)?></span> Respostas</span>
        </div>
    </div>
    
    <div class="topic-item-body">
        <div class="topic-item-content topic-subject">
            <?=nl2br($topicItemPreview->getBody())?>
        </div>
    </div>

    <div class="answer-topic">
        <a href="<?=$base?>topic.php?id=<?=$topicItemPreview->id?>" id="answer" class="btn btn-primary">Responder</a>
    </div>
</div>