<div class='container'>
<div class="col-md-12">

    <!-- ユーザー情報 -->
    <div class="col-md-12" style="margin-top: 10px">
        <div class="col-md-1" style="margin-right:20px">
            <!-- イメージ表示 -->
            <?php if ($user['User']['photo']) :?>
                <?= $this->Html->image("/files/user/photo" . "/" . $user['User']["photo_dir"] . "/" . $user['User']["photo"] ,['style' => 'width: 80px']);?>
            <?php else :?>
                <?= $this->Html->image("/img/acountSample.png" ,['style' => 'width: 80px']);?>
            <?php endif ;?>
        </div>

        <div class="col-md-6">
            <b class="h3"><?= $this->Html->link($user['User']['screen_name'], []) ;?></b>
            <span class="bg-info">( <?= count($user['Document']);?> )</span>
            <br>
            <b><?= $this->Html->link($user['User']['name'],'',['style'=>'text-decoration:none; color:black']) ;?></b>

            <!-- 管理者のみ編集・削除権限を持つ -->
            <?php if ($currentUser['role'] == 'admin'):?>
                <?= $this->Html->link('Edit', [
                    'controller' => 'users',
                    'action' => 'edit',
                    $user['User']['id']
                    ], [
                    'class' => 'btn btn-primary pull-right'
                    ]); ?>
                <br>

                <div style="padding-top:10px">
                    <span style="text-decoration:none; color:gray;"><?= $user['User']['email'] ;?></span>
                </div>
            <?php endif ;?>
        </div>
    </div>

    <hr class="col-md-12">

    <!-- 投稿情報一覧 -->
    <h4 class="text-info" style="margin:0 0 20px 30px">◆Document一覧</h4>
    <?php if(count($documents) == 0): ?>
        <p class="text-info col-md-11 col-md-offset-1"><?= '投稿がありません';?></p>
    <?php endif;?>

    <?php foreach($documents as $document) :?>
        <div class="col-md-12">
            <div class="col-md-1" style="margin-right:10px">
                <!-- イメージ表示 -->
                <?php if ($user['User']['photo']) :?>
                    <?= $this->Html->image("/files/user/photo" . "/" . $user['User']["photo_dir"] . "/" . $user['User']["photo"] ,['style' => 'width: 70px']);?>
                <?php else :?>
                    <?= $this->Html->image("/img/acountSample.png" ,['style' => 'width: 70px']);?>
                <?php endif ;?>
            </div>

            <div class="col-md-7" style="margin-right:20px">
                <?= $this->Html->link($document['Document']['title'], [
                    'controller' => 'documents',
                    'action' => 'view',
                    $document['Document']['id']
                    ]) ;?>
                <br>

                <small class="pull-right">Created by <b>
                    <?= $this->Html->link(h($document['User']['screen_name']), [
                        'action' => 'view',
                        $user['User']['id']
                        ]);?>
                </b><br>
                <?= $this->Time->format($document['Document']['created'], '%Y-%m-%d %H:%M');?></small>
            </div>
        </div>
        <hr class="col-md-7">

    <?php endforeach ;?>

</div>
</div>