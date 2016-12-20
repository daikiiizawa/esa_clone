<div class="container">

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
        'class' => 'btn btn-primary'
        ]); ?>

    <div style="margin-top:10px;">
        <?= $this->Html->link('サインアップ', [
            'action' => 'signup'
            ]); ?><br>
    </div>

</div>