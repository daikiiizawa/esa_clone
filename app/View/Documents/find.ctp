<div class="col-md-9">
<div class="col-md-12" style="margin-top: 17px">
    <span class="h2 text-info" style="display: inline">
        <?php if(strstr($category, "/") !== '/カテゴリなし'):?>
            <?= $category;?>
        <?php else :?>
            <?= strstr($category, "/",TRUE);?>
        <?php endif;?>
    </span>
</div>

<!-- ドキュメントリスト -->
<div class="col-md-12" style="margin-top: 30px">

    <?php foreach($documents as $document) :?>
        <?php if (  strstr($document['Document']['title'], $category) &&
                    strstr(strstr($document['Document']['title'],'/',TRUE), strstr($category,'/',TRUE))
        ):?>

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

            <div class="col-md-10">

                <div>
                    <span class="small text-muted"><?= strstr($category,"/",TRUE);?></span>
                    <span class="small text-muted">/</span>
                    <span class="small text-muted"><?= substr(strstr($category,"/"),1);?></span>
                </div>

                <?= $this->Html->link(substr(str_replace($category, '', $document['Document']['title']),1), [
                    'action' => 'view',
                    $document['Document']['id']
                    ], [
                    'class' => 'h3'
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

        <!-- 中カテゴリなしの場合の一覧表示 -->
        <?php elseif (  strstr($document['Document']['title'], strstr($category,'/',TRUE)) &&
                        strstr('/カテゴリなし', strstr($category,'/')) &&
                        strstr(strstr($document['Document']['title'],'/',TRUE), strstr($category,'/',TRUE))
                        ):?>

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

            <div class="col-md-10">

                <div>
                    <span class="small text-muted"><?= strstr($category,"/",TRUE);?></span>
                    <span class="small text-muted">/ #全て表示</span>
                </div>

                <?= $this->Html->link(str_replace($category, '', $document['Document']['title']), [
                    'action' => 'view',
                    $document['Document']['id']
                    ], [
                    'class' => 'h3'
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

        <!-- 大カテゴリなしの場合の一覧表示 -->
        <?php elseif ($document['Document']['title'] == substr(strstr($category,'/'),1)):?>

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

            <div class="col-md-10">

                <div>
                    <span class="small text-muted"><?= strstr($category,"/",TRUE);?></span>
                    <span class="small text-muted">/</span>
                    <span class="small text-muted"><?= substr(strstr($category,"/"),1);?></span>
                </div>

                <?= $this->Html->link(str_replace($category, '', $document['Document']['title']), [
                    'action' => 'view',
                    $document['Document']['id']
                    ], [
                    'class' => 'h3'
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

        <?php endif ;?>

    <?php endforeach ;?>

</div>

</div>