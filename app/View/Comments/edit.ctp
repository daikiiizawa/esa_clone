<div class="container">

<div class="col-md-1" style="margin-top: 17px; margin-left: 15px">
    <!-- イメージ表示 -->
    <?php if ($comment['Comment']['user_photo']) :?>
        <?= $this->Html->image("/files/user/photo" . "/" . $comment['Comment']["user_photo_dir"] . "/" . $comment['Comment']["user_photo"] ,['style' => 'width: 80px']);?>
    <?php else :?>
        <?= $this->Html->image("/img/acountSample.png" ,['style' => 'width: 80px']);?>
    <?php endif ;?>
</div>

<!-- <div class="col-md-7" style="margin-bottom: 30px; margin-left: 17px; background-color:#F5F5F5;"> -->
<div class="col-md-7" style="margin:15px 0px 0px 17px; background-color:#F5F5F5;">
    <?= $this->Form->create('Comment',[
        'url' => ['action' => 'confirm'],
        'type'  => 'post',
        'novalidate' => true,
        ]); ?>

    <div class="form-group">
    <?= $this->Form->input('body', [
        'label' => false,
        'type'  => 'text',
        'rows' => '20',
        'class' => 'form-control',
        'style' => 'max-width:100%; max-height:700px; margin-top:10px'
        ]); ?>
    </div>

    <?= $this->Form->hidden('id'); ?>
    <?= $this->Form->hidden('document_id'); ?>
    <?= $this->Form->hidden('user_id'); ?>
    <?= $this->Form->hidden('user_name'); ?>
    <?= $this->Form->hidden('user_photo'); ?>
    <?= $this->Form->hidden('user_photo_dir'); ?>

    <?= $this->Form->end([
        'label' => '表示内容を確認',
        'class' => 'btn btn-primary pull-right',
        'style' => 'margin: 20px 0px 20px 10px;'
        ]); ?>

    <?= $this->Html->link(
        '戻る',['controller' => 'documents', 'action' => 'view',$document_id],[
        'class' => "btn btn-default pull-right",
        'style' => 'margin: 20px 0px 20px 0px;'
        ]) ;?>

</div>

</div>
