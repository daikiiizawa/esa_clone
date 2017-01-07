<div class="col-md-8 col-md-offset-2">

    <h2>ユーザー登録</h2>

    <?= $this->element('Users/form'); ?>

    <?= $this->Html->link('戻る',[
        'controller' => 'documents', 'action' => 'team'
        ], [
        'class' => 'btn btn-default pull-left',
        'style' => 'margin-left:10px'
        ]); ?>

</div>
