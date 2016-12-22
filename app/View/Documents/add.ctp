<div class="container">


    <h2>ドキュメント登録</h2>
    <?= $this->Form->create('Document', [
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
        'rows' => '7',
        'class' => 'form-control',
        'style' => 'width:70%; max-width:100%; max-height:300px'
        ]); ?>


    <?= $this->Form->end([
        'label' => '登録する',
        'class' => 'btn btn-primary',
        'style' => 'margin: 20px 0px 20px 0px;'
        ]); ?>

    <?= $this->Html->link(
        '戻る',['action' => 'index'],[
        'class' => "btn btn-default"]
        ) ;?>

</div>
</div>