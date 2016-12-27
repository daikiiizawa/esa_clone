<div class='container'>
<div class="col-md-12">

    <div class="col-md-7" style="margin-top: 17px">
        <span class="h2" style="display: inline">
            <?= h($document['Document']['title']) ;?>
        </span>
        <span class="h3">
            <?= $this->Html->link(
                '<span class="glyphicon glyphicon-pencil"></span>',[
                    'action' => 'edit',$document['Document']['id'],
                    ], [
                    'escape' => false
                    ]) ;?>
        </span>
    </div>

    <div class="col-md-5">
        <span><b>Created by <?= $this->Html->link(h($document['User']['screen_name']),
            []);?>
        </b><br>
        <?= $this->Time->format($document['Document']['created'], '%Y-%m-%d %H:%M');?></span>
    </div>

</div>
<div class="col-md-7" style="margin-top: 17px">
    <table class="table">
        <tbody>
            <tr>
                <td><?= $this->Markdown->transform(h($document['Document']['body']));?></td>
            </tr>
        </tbody>
    </table>


    <?= $this->Html->link('編集', [
        'action' => 'edit',
        $document['Document']['id']
        ], [
        'class' => 'btn btn-primary'
        ]);?>

    <hr>

    <?php if ($currentUser['role'] == 'admin' || $currentUser['id'] == $document['User']['id']) :?>
        <?= $this->Form->postlink('削除',[
            'action' => 'delete',
            $document['Document']['id']
            ], [
            'confirm' => '本当に削除してよろしいですか？',
            'class' => 'btn btn-danger'
            ]);?>
    <?php endif ;?>

</div>
</div>