<div class="container">

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
        'rows' => '22',
        'class' => 'form-control',
        'style' => 'width:70%; max-width:100%; max-height:460px'
        ]); ?>

    <?= $this->Form->hidden('user_id', ['value' => $user_id]); ?>

    <?= $this->Form->end([
        'label' => '登録',
        'class' => 'btn btn-primary',
        'style' => 'margin: 20px 0px 20px 0px;'
        ]); ?>

    <?= $this->Html->link(
        '戻る',['action' => 'index'],[
        'class' => "btn btn-default"]
        ) ;?>

</div>