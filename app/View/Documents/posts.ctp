<div class="col-md-12" style="margin-top: 17px">
    <span class="h2 text-info" style="display: inline">Posts</span>
</div>

<!-- ページネーション -->
<ul class="pagination pagination-sm" style="margin-left:30px">
    <?= $this->Paginator->first('First') ;?>
    <?= $this->Paginator->prev('Prev', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
    <?= $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1, 'ellipsis' => '<li class="disabled"><a>...</a></li>')); ?>
    <?= $this->Paginator->next('Next', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
    <?= $this->Paginator->last('Last') ;?>
</ul>

<div class="col-md-12" style="margin-top: 17px">

    <?php foreach($documents as $document) :?>

        <div class="col-md-1" style="margin-right:10px">
            <!-- イメージ表示 -->
            <?php if ($document['User']['photo']) :?>
                <?= $this->Html->link($this->Html->image("/files/user/photo" . "/" . $document['User']["photo_dir"] . "/" . $document['User']["photo"] ,['style' => 'width: 70px']), [
                    'controller' => 'users',
                    'action' => 'view',
                    $document['User']['id']
                    ], [
                    'escape' => false
                    ]) ;?>
            <?php else :?>
                <?= $this->Html->link($this->Html->image("/img/acountSample.png" ,['style' => 'width: 70px']), [
                    'controller' => 'users',
                    'action' => 'view',
                    $document['User']['id']
                    ], [
                    'escape' => false
                    ]); ?>
            <?php endif ;?>
        </div>

        <div class="col-md-7">
            <?= $this->Html->link($document['Document']['title'], [
                'action' => 'view',
                $document['Document']['id']
                ], [
                'class' => 'h4'
                ]) ;?>
            <br>

            <small class=pull-right>Created by <b>
                <?= $this->Html->link(h($document['User']['screen_name']), [
                    'controller' => 'users',
                    'action' => 'view',
                    $document['User']['id']
                    ]);?>
            </b><br>
            <?= $this->Time->format($document['Document']['created'], '%Y-%m-%d %H:%M');?></small class=pull-right>
            </small>
        </div>

        <hr class="col-md-12">

    <?php endforeach ;?>

    <!-- ページネーション -->
    <ul class="pagination pagination-sm col-md-12" style="margin:0 0 50px 30px">
        <?= $this->Paginator->first('First') ;?>
        <?= $this->Paginator->prev('Prev', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
        <?= $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1, 'ellipsis' => '<li class="disabled"><a>...</a></li>')); ?>
        <?= $this->Paginator->next('Next', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
        <?= $this->Paginator->last('Last') ;?>
    </ul>

</div>