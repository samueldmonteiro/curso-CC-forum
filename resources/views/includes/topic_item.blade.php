
<div class="modal fade" id="modalDeleteTopic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Deseja mesmo Deletar Este Tópico?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" id="confirmDeletionTopic" class="btn btn-primary">Deletar</button>
      </div>
    </div>
  </div>
</div>

<div class="topic-item" data-id="<?=$topicItem->id?>">

    <div class="topic-item-head">
        <div class="topic-item-info">
            <div class="user-avatar" style="background-image: url('<?=$base?>media/avatars/<?=$topicItem->user->avatar?>');"></div>
            <div>
                <a href="<?=$base?>profile.php?id=<?=$topicItem->user->id?>" class="username"><?=$topicItem->user->shortName()?></a>
                <p><?=$topicItem->category?>  - <?=$topicItem->user->grade?> ºano <span id="replyDate"><?=$topicItem->replyDate()?></span></p>
            </div>
        </div>

        <span class="topic-item-states">
        <i class="bi bi-chat-dots-fill"></i>
            <span>

                <?php if(count($topicItem->answers) > 0):?>
                    Respondido
                <?php else:?>
                    Não Respondido
                <?php endif?>
            </span>
        </span>
    </div>

    <div class="topic-item-body">
        <div class="topic-item-content">
            <?=nl2br($topicItem->getBody())?>
        </div>
    </div>

    <div class="answer-topic">
        <div class="topic-actions">
            <span id="answer" class="btn btn-primary">Responder</span>   
            <div>
                <?php if($topicItem->mine):?>
                    <abbr title="Deletar Tópico">
                    <i id="delete-topic" data-bs-toggle="modal" data-bs-target="#modalDeleteTopic" class="bi bi-trash3-fill"></i>
                    </abbr>
                    <abbr title="Tópico Concluído">
                        <?php if($topicItem->state == "Concluído"):?>
                            <i id="completed-topic" class="bi bi-check-circle-fill"></i>
                        <?php else:?>
                            <i id="completed-topic" class="bi bi-check-circle"></i>
                        <?php endif?>
                    </abbr>
                <?php endif?>
                <span><abbr title="Denunciar"><i class="bi bi-flag-fill"></i></abbr></span>
                
            </div>
            
        </div>

        <div class="write-answer hide-write-answer">
            <!-- <div contenteditable="true" id="content-answer">
                Digite aqui ...
            </div> -->

            <textarea id="content-answer"></textarea>

            <button id="send-answer" type="button" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"></path>
                    </svg>
                    Enviar
            </button>
        </div>

    </div>
</div>