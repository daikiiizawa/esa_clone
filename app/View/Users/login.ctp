<div class="col-md-8 col-md-offset-2">

<h2>ログイン</h2>

    <?= $this->Flash->render('Auth');?>
    <?= $this->Form->create('User', [
        'type'  => 'post',
        'novalidate' => true,
        ]);?>

    <div class="form-group">
        <?= $this->Form->input('email', [
            'label' => 'メールアドレス',
            'class' => 'form-control'
            ]); ?>
    </div>
    <div class="form-group">
        <?= $this->Form->input('password', [
            'label' => 'パスワード',
            'type' => 'password',
            'class' => 'form-control'
            ]); ?>
    </div>

    <?= $this->Form->submit('ログイン', [
        'url' => [
        'controller' => 'document',
        'actino' => 'index'
        ],
        'class' => 'btn btn-primary'
        ]); ?>

    <div style="margin-top:10px;">
        <?= $this->Html->link('ユーザー登録', [
            'action' => 'signup'
            ]); ?><br>
    </div>

</div>