<div class="container">

<div class="col-md-8">
    <?= $this->Form->create('Document', [
        'url' => ['action' => 'confirm'],
        'type'  => 'post',
        'novalidate' => true,
        ]); ?>

    <?= $this->Form->input('title', [
        'label' => 'Title',
        'class' => 'form-control',
        'style' => 'max-width: 100%;'
        ]); ?>

    <hr>

    <?= $this->Form->input('body', [
        'label' => false,
        'type'  => 'text',
        'rows' => '22',
        'class' => 'form-control',
        'style' => 'max-width:100%; max-height:460px'
        ]); ?>

    <?= $this->Form->hidden('id'); ?>
    <?= $this->Form->hidden('user_id'); ?>


    <?= $this->Form->end([
        'label' => 'Confirm document',
        'class' => 'btn btn-primary pull-right',
        'style' => 'margin: 20px 0px 20px 10px;'
        ]); ?>

    <?= $this->Html->link(
        'Return',['action' => 'view',$id],[
        'class' => 'btn btn-default pull-right',
        'style' => 'margin: 20px 0px 20px 0px;'
        ]) ;?>
</div>

</div>