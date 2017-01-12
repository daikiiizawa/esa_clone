<div class='container'>

    <h2 class="text-success">Confirm view</h2>

    <div class="col-md-12" style="margin-top: 17px">
        <div class="col-md-1">
                <?php if ($confirm['Comment']['user_photo']) :?>
                    <?= $this->Html->image("/files/user/photo" . "/" . $confirm['Comment']["user_photo_dir"] . "/" . $confirm['Comment']["user_photo"] ,['style' => 'width: 80px']);?>
                <?php else :?>
                    <?= $this->Html->image("/img/acountSample.png" ,['style' => 'width: 80px']);?>
                <?php endif ;?>
        </div>

        <div class="col-md-7" style="margin-bottom: 30px; margin-left: 17px; background-color:#F5F5F5;">
            <div class="text-info" style="display: inline"><?= $confirm['Comment']['user_name'];?></div>
            <?= $this->Markdown->transform($confirm['Comment']['body']);?>
        </div>

            <?= $this->Form->create('Comment',[
                'novalidate' => true,
                'type' => 'file',
                'url' => [
                    'controller' => 'comments',
                    'action' => 'addsave'
                ]
            ]);?>

            <!-- hiddenで送信 -->
            <?= $this->Form->hidden('id'); ?>
            <?= $this->Form->hidden('document_id'); ?>
            <?= $this->Form->hidden('user_id'); ?>
            <?= $this->Form->hidden('user_name'); ?>
            <?= $this->Form->hidden('user_photo'); ?>
            <?= $this->Form->hidden('user_photo_dir'); ?>
            <?= $this->Form->hidden('body'); ?>
        <div class="col-md-4"></div>
    </div>

        <div class="col-md-8" style="margin-left: 17px;">
            <?= $this->Form->end([
                'label' => 'Comment!',
                'class' => 'btn btn-primary pull-right',
                'style' => 'margin-left:10px'
            ]) ;?>

            <?= $this->Form->create('Comment',[
                'novalidate' => true,
                'type' => 'file',
                'url' => [
                    'controller' => 'documents',
                    'action' => 'view',
                    $confirm['Comment']['document_id']
                ]
            ]);?>

            <!-- hiddenで送信 -->
            <?= $this->Form->hidden('id'); ?>
            <?= $this->Form->hidden('document_id'); ?>
            <?= $this->Form->hidden('user_id'); ?>
            <?= $this->Form->hidden('user_name'); ?>
            <?= $this->Form->hidden('user_photo'); ?>
            <?= $this->Form->hidden('user_photo_dir'); ?>
            <?= $this->Form->hidden('body'); ?>

            <?= $this->Form->end([
                'label' => 'Return',
                'class' => 'btn btn-default pull-right'
            ]) ;?>
        </div>

</div>