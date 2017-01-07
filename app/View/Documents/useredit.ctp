<div class="col-md-8 col-md-offset-2">

<h2>ユーザー編集</h2>

    <?= $this->Form->create('User',[
        'type'  => 'file',
        'novalidate' => true,
        ]); ?>

    <div class="form-group">
        <?= $this->Form->input('name', [
            'label' => '名前',
            'type' => 'text',
            'class' => 'form-control'
            ]); ?>
    </div>
    <div class="form-group">
        <?= $this->Form->input('screen_name', [
            'label' => 'ニックネーム',
            'type' => 'text',
            'class' => 'form-control'
            ]); ?>
    </div>
    <div class="form-group">
        <?= $this->Form->input('email', [
            'label' => 'メールアドレス',
            'type' => 'email',
            'class' => 'form-control'
            ]); ?>
    </div>
    <div class="form-group">
        <?= $this->Form->input('password', [
            'label' => 'パスワード(半角英数字8文字以上)',
            'type' => 'password',
            'class' => 'form-control'
            ]); ?>
    </div>
    <div class="form-group">
        <?= $this->Form->input('password_confirm', [
            'label' => 'パスワード(確認)',
            'type' => 'password',
            'class' => 'form-control'
            ]); ?>
    </div>
    <div class="form-group">
    <?= $this->Form->input('photo', [
            'type'  => 'file',
            'label' => 'プロフィール画像',
            ]); ?>
    </div>

    <?= $this->Form->input('photo_dir', [
            'type' => 'hidden'
            ]); ?>

    <div class="form-group">
    <?= $this->Form->input('role', [
            'type'    => 'select',
            'label' => '権限',
            'empty' => '選択して下さい',
            'class' => 'form-control',
            'options' => [
                'admin' => '管理者', 'student' => '生徒'
                ]
            ]); ?>
    </div>

    <div class="form-group">
    <?= $this->Form->submit('更新',[
        'class' => 'btn btn-primary pull-left',
        'style' => 'margin-right:10px'
        ]); ?>

        <?= $this->Html->Link('戻る', [
            'controller' => 'documents',
            'action' => 'team'], [
            'class' => 'btn btn-default pull-left'
            ]); ?><br>
    </div>
</div>
