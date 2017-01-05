<div class="container">

<div class="col-md-6">
    <?= $this->Form->create('Comment',[
        'url' => ['action' => 'edit'],
        'type'  => 'post',
        'novalidate' => true,
        ]); ?>

    <div class="form-group">
    <?= $this->Form->input('body', [
        'label' => false,
        'type'  => 'text',
        'rows' => '20',
        'class' => 'form-control',
        'style' => 'max-width:100%; max-height:700px'
        ]); ?>
    </div>

    <?= $this->Form->hidden('id'); ?>

    <?= $this->Form->end([
        'label' => '更新',
        'class' => 'btn btn-primary',
        'style' => 'margin: 20px 0px 20px 0px;'
        ]); ?>

    <?= $this->Html->link(
        '戻る',['controller' => 'documents', 'action' => 'view',$document_id],[
        'class' => "btn btn-default"]
        ) ;?>

</div>

</div>