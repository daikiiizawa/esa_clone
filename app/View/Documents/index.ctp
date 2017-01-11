<div class='container'>

<div class="col-md-12">
    <div class="col-md-4">

    </div>
    <div class="col-md-8">
        <span class="h2">
            <?= $this->Html->link(h($readme[0]['Document']['title']), [
                'action' => 'view',$readme[0]['Document']['id'],
            ]);?>
        </span>
        <span class="h3">
            <?= $this->Html->link(
                '<span class="glyphicon glyphicon-pencil"></span>',[
                    'action' => 'edit',$readme[0]['Document']['id'],
                    ], [
                    'escape' => false
                    ]) ;?>
        </span>
    </div>
</div>

<div class="col-md-4" style="margin-top: 17px">
    <table class="table table-striped">
        <thead class="text-info">
            <th>Title</th>
            <th>Contributor</th>
        </thead>

        <tbody>
            <?php foreach($documents as $document) :?>
                <tr>
                    <td><?= $this->Html->link($document['Document']['title'], [
                        'action' => 'view', $document['Document']['id']
                        ]) ;?></td>
                    <td><?= $document['User']['screen_name']?></td>
                </tr>

            <?php endforeach ;?>
        </tbody>
    </table>
</div>

<!-- READMEの表示 -->
<div class="col-md-8" style="margin-top: 17px">
    <table class="table">
        <tbody>
            <tr>
                <td><?= $this->Markdown->transform(h($readme[0]['Document']['body']));?></td>
            </tr>
        </tbody>
    </table>
</div>




</div>