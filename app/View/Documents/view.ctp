<div class='container'>
<div class="col-md-12">

    <p>詳細画面</p>
    <h2 class="col-md-7"><?= $document['Document']['title'] ;?></h2>
    <div class="col-md-5">
        <span><b>Created by <?= $document['User']['screen_name'];?></b><br>
        <?= $this->Time->format($document['Document']['created'], '%Y-%m-%d %H:%M');?></span>

    </div>

</div>
<div class="col-md-10" style="margin-top: 17px">
    <table class="table">
        <tbody>
            <tr>
                <td style="white-space:pre-wrap"><?= $document['Document']['body'] ;?></td>
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