<div class="container">


    <p>ドキュメント編集</p>
    <?= $this->Form->create('Document',[
        'url' => ['action' => 'edit'],
        'type'  => 'post',
        'novalidate' => true,
        ]); ?>

    <?= $this->Form->input('title', [
        'label' => 'タイトル',
        'class' => 'form-control',
        'style' => 'width:70%; max-width:100%;'
        ]); ?>

    <hr>
    <?= $this->Form->input('body', [
        'label' => false,
        'type'  => 'text',
        'rows' => '20',
        'class' => 'form-control',
        'style' => 'width:70%; max-width:80%; max-height:700px'
        ]); ?>

    <?= $this->Form->hidden('id'); ?>

    <?= $this->Form->end([
        'label' => '更新',
        'class' => 'btn btn-primary',
        'style' => 'margin: 20px 0px 20px 0px;'
        ]); ?>

    <?= $this->Html->link(
        '戻る',['action' => 'view',$id],[
        'class' => "btn btn-default"]
        ) ;?>

</div>
</div>