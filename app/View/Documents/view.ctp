<div class='container'>
    <div class="col-md-12">

        <div class="col-md-8" style="margin-top: 17px">
            <span class="h2" style="display: inline">
                <?= h($document['Document']['title']) ;?>
            </span>
            <span class="h3">
                <?= $this->Html->link(
                    '<span class="glyphicon glyphicon-pencil"></span>',[
                        'action' => 'edit',$document['Document']['id'],
                        ], [
                        'escape' => false
                        ]) ;?>
            </span>
        </div>

        <div class="col-md-4">
            <span><b>Created by <?= $this->Html->link(h($document['User']['screen_name']),
                []);?>
            </b><br>
            <?= $this->Time->format($document['Document']['created'], '%Y-%m-%d %H:%M');?></span>
        </div>

    </div>
    <div class="col-md-12" style="margin-top: 17px">
        <div class="col-md-8">
            <table class="table">
                <tbody>
                    <tr>
                        <td><?= $this->Markdown->transform(h($document['Document']['body']));?></td>
                    </tr>
                </tbody>
            </table>

            <?php if ($currentUser['role'] == 'admin' || $currentUser['id'] == $document['User']['id']) :?>
                <?= $this->Form->postlink('削除',[
                    'action' => 'delete',
                    $document['Document']['id']
                    ], [
                    'confirm' => '本当に削除してよろしいですか？',
                    'class' => 'btn btn-danger pull-right',
                    'style' => 'margin-left:10px'
                    ]);?>
            <?php endif ;?>


            <?= $this->Html->link('編集', [
                'action' => 'edit',
                $document['Document']['id']
                ], [
                'class' => 'btn btn-default pull-right'
                ]);?>


        </div>
    </div>


    <!-- コメント一覧 -->
    <?php foreach($document['Comment'] as $document['Comment']) :?>
        <div class="col-md-12">

            <div class="col-md-1" style="margin-top: 17px">
                <?= $this->User->photoImage($document, ['style' => 'width: 80px']); ?>
            </div>

            <div class="col-md-7" style="margin-top: 15px; padding-top:10px ; margin-left: 17px; background-color:#F5F5F5">
                <div class="text-info" style="display: inline"><?= $document['Comment']['user_name'];?></div>
                <div class="text-muted pull-right"><?= $this->Time->format($document['Comment']['created'], '%Y-%m-%d %H:%M');?></div>

                <br>
                <?= $this->Markdown->transform(h($document['Comment']['body']));?>
            </div>
        </div>
    <?php endforeach ;?>





    <!-- コメント投稿フォーム -->
    <div class="col-md-12" style="margin-top: 17px">
        <div class="col-md-1">
                <?php if ($currentUser['photo']) :?>
                    <?= $this->Html->image("/files/user/photo" . "/" . $currentUser["photo_dir"] . "/" . $currentUser["photo"] ,['style' => 'width: 80px']);?>
                <?php else :?>
                    <?= $this->Html->image("/img/acountSample.png" ,['style' => 'width: 80px']);?>
                <?php endif ;?>
        </div>

        <div class="col-md-7" style="margin-bottom: 30px; margin-left: 17px; background-color:#F5F5F5;">
        <!-- 対応内容フォーム -->
        <?= $this->Form->create('Comment',[
            'novalidate' => true,
            'url' => [
                'controller' => 'comments',
                'action' => 'add'
            ]
        ]);?>

        <?= $this->Form->input('body', [
            'label' => '対応内容',
            'label' => false,
            'type'  => 'text',
            'rows' => '20',
            'class' => 'form-control',
            'style' => 'max-width:100%; max-height:700px; margin-top:10px'
        ]); ?>

        <?= $this->Form->input('document_id', [
            'type' => 'hidden',
            'value' => $document['Document']['id']
        ]); ?>

        <?= $this->Form->input('user_id', [
            'type' => 'hidden',
            'value' => $currentUser['id']
        ]); ?>

        <?= $this->Form->input('user_name', [
            'type' => 'hidden',
            'value' => $currentUser['screen_name']
        ]); ?>

        <?= $this->Form->end([
            'label' => 'Comment',
            'class' => 'btn btn-primary pull-right',
            'style' => 'margin:20px 0 30px 0'
        ]) ;?>
        </div>

</div>