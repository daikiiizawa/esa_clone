<div class='container'>
<div class="col-md-12">

    <p>詳細画面</p>
    <h2><?= $document['Document']['title'] ;?>

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
    <?= $this->Form->postlink('削除',[
        'action' => 'delete',
        $document['Document']['id']
        ], [
        'confirm' => '本当に削除してよろしいですか？',
        'class' => 'btn btn-danger'
        ]);?>

</div>
</div>