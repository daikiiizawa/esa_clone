<div class="col-md-8 col-md-offset-2">

    <h2>ユーザー編集</h2>
    <?= $this->Form->create('User', [
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
            'label' => '新パスワード',
            'type'  => 'password',
            'class' => 'form-control',
            // 'default' => false
            ]); ?>
    </div>

    <div class="form-group">
        <?= $this->Form->input('password_confirm', [
            'label' => '新パスワード(確認)',
            'type'  => 'password',
            'class' => 'form-control'
            ]); ?>
    </div>

    <div class="form-group">
        <?= $this->Form->input('password_current', [
            'label' => '現在のパスワード',
            'type'  => 'password',
            'class' => 'form-control'
            ]); ?>
    </div>

    <div class="form-group">
    <?= $this->Form->input('photo', [
            'type'  => 'file',
            'label' => 'プロフィール画像',
            ]); ?>
    </div>

    <b>設定中の画像</b><br>
    <!-- ユーザー画像の表示 -->
    <?php if ($photo) :?>
        <?= $this->Html->image("/files/user/photo" . "/" . $photo_dir . "/" . $photo ,['style' => 'height: 80px']);?>
    <?php else :?>
        <p class='text-info' style="margin-bottom: 30px">
            <b><span class="glyphicon glyphicon-info-sign"></span><?= ' 登録されていないため、以下の画像に設定されます' ;?></b><br>
            <?= $this->Html->image("/img/acountSample.png" ,['style' => 'width: 80px']);?>
        </p>
    <?php endif ;?>


    <?= $this->Form->input('photo_dir', [
            'type' => 'hidden'
            ]); ?>

    <div class="form-group" style="margin-top: 30px">
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

    <?= $this->Form->hidden('id') ?>

    <?= $this->Form->submit('更新',[
        'class' => 'btn btn-primary pull-left',
        'style' => 'margin-right:10px'
        ]); ?>

    <?= $this->Html->link('戻る', [
        'controller' => 'documents',
        'action' => 'team'
        ], [
        'class' => 'btn btn-default pull-left',
        'style' => 'margin-right:10px'
        ]); ?>
</div>

<div class="col-md-8 col-md-offset-2">
<hr>
<h4 class="text-danger">ユーザー削除</h4>
    <?= $this->Form->postlink(
        '削除', [
            'action' => 'delete',
            $currentUser['id']
        ], [
            'confirm' => '本当に削除してよろしいですか？',
            'class' => "btn btn-danger",
            'style' => 'margin :10px 0 40px 0'
    ]); ?>
</div>
