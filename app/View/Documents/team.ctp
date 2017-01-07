<div class='container'>
<div class="col-md-12">

<div class="col-md-7" style="margin-top: 17px">
    <span class="h2 text-info" style="display: inline">Team</span>

    <!-- 管理者のみ編集・削除権限を持つ -->
    <?php if ($currentUser['role'] == 'admin'):?>
        <?= $this->Html->link('add User',[
            'controller' => 'users', 'action' => 'add'], [
            'class' => 'btn btn-primary pull-right'
            ]); ?>
    <?php endif ;?>
</div>

<div class="col-md-7" style="margin-top: 17px">
    <table class="table table-striped">
        <thead class="h4">
            <th>Members (<?= count($users);?>)</th>
            <th></th>
        </thead>

        <tbody>
            <?php foreach($users as $user) :?>
                <tr>
                    <td>
                        <b class="h3"><?= $this->Html->link($user['User']['screen_name'], []) ;?></b>
                        <span class="bg-info">( <?= count($user['Document']);?> )</span>
                        <br>
                        <b><?= $this->Html->link($user['User']['name'],'',['style'=>'text-decoration:none; color:black']) ;?></b>

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
                    </td>
                </tr>
            <?php endforeach ;?>
        </tbody>
    </table>
</div>
</div>
</div>