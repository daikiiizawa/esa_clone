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
            <span><b>Created by <?= $this->Html->link(h($document['User']['screen_name']),[
                'controller' => 'users',
                'action' => 'view',
                $document['User']['id']
                ]);?>
            </b><br>
            <?= $this->Time->format($document['Document']['created'], '%Y-%m-%d %H:%M');?></span>
        </div>

    </div>
    <div class="col-md-12" style="margin-top: 17px">
        <div class="col-md-8">
            <table class="table">
                <tbody>
                    <tr>
                        <td><?= $this->Markdown->transform($document['Document']['body']);?></td>
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
        <div class="col-md-4"></div>
    </div>
    <hr class="col-md-12">

    <!-- コメント一覧 -->
    <h4 class="text-info" style="margin:0 0 20px 30px">Comments（<?= count($document['Comment']);?>）</h4>
    <?php foreach($document['Comment'] as $document['Comment']) :?>
        <div class="col-md-12">

            <div class="col-md-1" style="margin-top: 17px">
                <!-- イメージ表示 -->
                <?php if ($document['Comment']['user_photo']) :?>
                    <?= $this->Html->image("/files/user/photo" . "/" . $document['Comment']["user_photo_dir"] . "/" . $document['Comment']["user_photo"] ,['style' => 'width: 80px']);?>
                <?php else :?>
                    <?= $this->Html->image("/img/acountSample.png" ,['style' => 'width: 80px']);?>
                <?php endif ;?>
            </div>

            <div class="col-md-7" style="margin-top: 15px; padding-top:10px ; margin-left: 28px; background-color:#F5F5F5">
                <div class="text-info" style="display: inline"><?= $document['Comment']['user_name'];?></div>
                <div class="text-muted pull-right">
                    <?= $this->Time->format($document['Comment']['created'], '%Y-%m-%d %H:%M');?>
                    <?php if ($currentUser['role'] == 'admin' || $currentUser['id'] == $document['Comment']['user_id']) :?>
                        <?= $this->Html->link(
                            '<span class="glyphicon glyphicon-pencil"></span>',[
                                'controller' => 'comments',
                                'action' => 'edit',$document['Comment']['id'],
                                ], [
                                'escape' => false
                                ]) ;?>

                        <?= $this->Form->postlink(
                            '<span class="glyphicon glyphicon-trash"></span>',[
                            'controller' => 'comments',
                            'action' => 'delete',
                            $document['Comment']['id']
                            ], [
                            'confirm' => '本当に削除してよろしいですか？',
                            'escape' => false
                            ]);?>
                    <?php endif ;?>

                </div>

                <br>
                <?= $this->Markdown->transform($document['Comment']['body']);?>
            </div>
        </div>
    <?php endforeach ;?>

    <hr class="col-md-12">
    <h4 class="col-md-12 text-info"><b><コメント入力欄></b></h6>

    <!-- コメント投稿フォーム -->
    <div class="col-md-12" style="margin-top: 17px">
        <div class="col-md-1">
                <?php if ($currentUser['photo']) :?>
                    <?= $this->Html->image("/files/user/photo" . "/" . $currentUser["photo_dir"] . "/" . $currentUser["photo"] ,['style' => 'width: 80px']);?>
                <?php else :?>
                    <?= $this->Html->image("/img/acountSample.png" ,['style' => 'width: 80px']);?>
                <?php endif ;?>
        </div>

        <div class="col-md-7" style="margin-bottom: 30px; margin-left: 28px; background-color:#F5F5F5;">
        <!-- 対応内容フォーム -->
            <?= $this->Form->create('Comment',[
                'novalidate' => true,
                'type' => 'post',
                'url' => [
                    'controller' => 'comments',
                    'action' => 'addconfirm'
                ]
            ]);?>

            <?= $this->Form->input('body', [
                'label' => false,
                'type'  => 'text',
                'rows' => '20',
                'class' => 'form-control',
                'style' => 'max-width:100%; max-height:700px; margin-top:10px'
            ]); ?>

            <!-- hiddenで送信 -->
            <?= $this->Form->hidden('document_id', ['value' => $document['Document']['id']]); ?>
            <?= $this->Form->hidden('user_id', ['value' => $user['id']]); ?>
            <?= $this->Form->hidden('user_name', ['value' => $user['name']]); ?>
            <?= $this->Form->hidden('user_photo', ['value' => $user['photo']]); ?>
            <?= $this->Form->hidden('user_photo_dir', ['value' => $user['photo_dir']]); ?>


            <?= $this->Form->end([
                'label' => '表示内容を確認',
                'class' => 'btn btn-primary pull-right',
                'style' => 'margin:20px 0 30px 0'
            ]) ;?>
        </div>
    </div>

</div>