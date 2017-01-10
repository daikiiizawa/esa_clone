<div class='container'>
<div class="col-md-12">

    <div class="col-md-8" style="margin-top: 17px">
        <span class="h2 text-info" style="display: inline">Team</span>

        <!-- 管理者のみ編集・削除権限を持つ -->
        <?php if ($currentUser['role'] == 'admin'):?>
            <?= $this->Html->link('add User',[
                'controller' => 'users', 'action' => 'add'], [
                'class' => 'btn btn-primary pull-right'
                ]); ?>
        <?php endif ;?>
    </div>
</div>

<div class="col-md-12" style="margin: 17px 0 0 17px">
    <span class="h4">◆Members (<?= count($users);?>)</h4>
    <hr>
</div>

    <?php foreach($users as $user) :?>
        <div class="col-md-12" style="margin-top: 10px">
            <div class="col-md-1" style="margin-right:20px">

                <!-- イメージ表示 -->
                <?php if ($user['User']['photo']) :?>
                    <?= $this->Html->link($this->Html->image("/files/user/photo" . "/" . $user['User']["photo_dir"] . "/" . $user['User']["photo"] ,
                        ['style' => 'width: 80px']), [
                        'controller' => 'users',
                        'action' => 'view',
                        $user['User']['id']
                        ],[
                        'escape' => false
                        ]) ;?>
                <?php else :?>
                    <?= $this->Html->link($this->Html->image("/img/acountSample.png" ,
                        ['style' => 'width: 80px']), [
                        'controller' => 'users',
                        'action' => 'view',
                        $user['User']['id']
                        ], [
                        'escape' => false
                        ]) ;?>
                <?php endif ;?>
            </div>

            <div class="col-md-6">
                <b class="h3">
                    <?= $this->Html->link($user['User']['screen_name'], [
                        'controller' => 'users',
                        'action' => 'view',
                        $user['User']['id']
                    ]) ;?>

                </b>
                <span class="bg-info">( <?= count($user['Document']);?> )</span>
                <br>
                <b><?= $this->Html->link($user['User']['name'],[
                    'controller' => 'users',
                    'action' => 'view',
                    $user['User']['id']
                    ],[
                    'style' => 'text-decoration:none; color:black'
                    ]) ;?></b>

                <!-- 管理者のみ編集・削除権限を持つ -->
                <?php if ($currentUser['role'] == 'admin'):?>
                    <?= $this->Form->postlink('削除', [
                        'controller' => 'users',
                        'action' => 'delete',
                        $user['User']['id']
                        ], [
                        'confirm' => '本当に削除してよろしいですか？',
                        'class' => 'btn btn-danger btn-xs pull-right',
                        'style' => 'margin-left:10px'
                        ]);?>
                    <?= $this->Html->link('編集', [
                        'controller' => 'users',
                        'action' => 'edit',
                        $user['User']['id']
                        ], [
                        'class' => 'btn btn-default btn-xs pull-right'
                        ]); ?>
                    <br>

                    <div style="padding-top:10px">
                        <span style="text-decoration:none; color:gray;"><?= $user['User']['email'] ;?></span>
                    </div>
                <?php endif ;?>
            </div>
        </div>

        <hr class="col-md-7">

    <?php endforeach ;?>

</div>
</div>
</div>