<div class='container'>
<div class="col-md-12">

<div class="col-md-7" style="margin-top: 17px">
    <span class="h2 text-info" style="display: inline">Team</span>
    <?= $this->Html->link('add User',[
        'controller' => 'users', 'action' => 'signup'], [
        'class' => 'btn btn-primary pull-right'
        ]); ?>
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
                        <div style="padding-top:10px">
                            <span style="text-decoration:none; color:gray;"><?= $user['User']['email'] ;?></span>
                        </div>
                    </td>
                    <?php if ($currentUser['role'] == 'admin'):?>
                        <td>
                            <div class="btn btn-danger btn-xs pull-right" style="margin-left:10px;">Remove</div>

                            <div class="btn btn-default btn-xs pull-right">Edit</div>
                        </td>
                    <?php endif ;?>
                </tr>

            <?php endforeach ;?>
        </tbody>

    </table>

</div>
</div>
</div>