<div class='container'>
<div class="col-md-12">

    <h2>一覧画面</h2>

</div>
<div class="col-md-10" style="margin-top: 17px">
    <table class="table table-striped">
        <thead class="text-info">
            <th>タイトル</th>
        </thead>

        <tbody>
            <?php foreach($documents as $document) :?>
                <tr>
                    <td><?= $this->Html->link($document['Document']['title'], [
                        'action' => 'view', $document['Document']['id']
                        ]) ;?></td>
                </tr>

            <?php endforeach ;?>
        </tbody>

    </table>

</div>
</div>