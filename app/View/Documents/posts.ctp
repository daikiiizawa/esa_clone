<div class='container'>
<div class="col-md-12">

<div class="col-md-7" style="margin-top: 17px">
    <span class="h2 text-info" style="display: inline">Posts</span>
</div>

<div class="col-md-8" style="margin-top: 17px">
    <table class="table table-striped">
        <tbody>
            <?php foreach($documents as $document) :?>
                <tr>
                    <td><?= $this->Html->link($document['Document']['title'], [
                        'action' => 'view', $document['Document']['id']
                        ]) ;?>
                    </td>
                    <td class="col-md-5">
                        <span>Created by <b><?= $this->Html->link(h($document['User']['screen_name']),
                            []);?>
                        </b><br>
                        <?= $this->Time->format($document['Document']['created'], '%Y-%m-%d %H:%M');?></span>
                    </td>
                </tr>

            <?php endforeach ;?>
        </tbody>
    </table>
</div>


</div>