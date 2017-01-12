<div class='container'>
    <div class="col-md-12">

    <h2 class="text-success">Confirm view</h2>

        <div class="col-md-8" style="margin-top: 17px">
            <span class="h2" style="display: inline">
                <?= h($confirm['Document']['title']) ;?>
            </span>
        </div>

        <div class="col-md-4">
            <span><b>Created by <?= $this->Html->link(h($document['User']['screen_name']),
                []);?>
            </b><br>
            <?= $this->Time->format($document['Document']['created'], '%Y-%m-%d %H:%M');?></span>
        </div>

    </div>
    <div class="col-md-12" style="margin-top: 17px">
        <div class="col-md-8">
            <table class="table">
                <tbody>
                    <tr>
                        <td><?= $this->Markdown->transform($confirm['Document']['body']);?></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="col-md-4"></div>
    </div>

    <div class="col-md-8">
    <?= $this->Form->create('Document', [
        'url' => ["action" => "save"],
        "type" => "post"
        ]);?>

    <?= $this->Form->hidden('id'); ?>
    <?= $this->Form->hidden('title'); ?>
    <?= $this->Form->hidden('body'); ?>
    <?= $this->Form->hidden('user_id'); ?>

    <?= $this->Form->end([
        'label' => 'Update!',
        'class' => 'btn-group btn btn-primary pull-right',
        'style' => 'margin: 0px 10px 20px 0px;'
        ]); ?>&#010;


    <?= $this->Form->create('Document', [
        'url' => ["action" => "edit"],
        "type" => "post"
        ]);?>

    <?= $this->Form->hidden('id'); ?>
    <?= $this->Form->hidden('title'); ?>
    <?= $this->Form->hidden('body'); ?>
    <?= $this->Form->hidden('user_id'); ?>

    <?= $this->Form->end([
        'label' => 'Return',
        'class' => 'btn-group btn btn-default pull-right',
        'style' => 'margin: 0px 10px 20px 0px;'
        ]); ?>&#010;

    </div>



</div>