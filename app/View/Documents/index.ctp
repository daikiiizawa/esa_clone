<style>
/* 親の[ul] */
.syncer-acdn-parent
{
    /*width: 250px ;*/
    margin: 0px.0 0 -40px ;
    /*padding: 12px 18px ;*/
    padding: 12px 10px 800px 18px;
    background-color: #585858 ;
    border: 2px solid rgba( 0,0,0, 0.1 ) ;
}

/* 子の[ul] */
.syncer-acdn-child
{
    display: none ;
}

/* 余白設定 */
.syncer-acdn-child ,
.syncer-acdn-parent li ,
.syncer-acdn-parent li p
{
    margin: 0 ;
    padding: 0 ;
}

/* 親と子の[li] */
.syncer-acdn-parent li
{
    list-style: none ;
}


/* 親の[a] */
.syncer-acdn-parent li p a
{
    position: relative ;
    top: 0 ;
    left: 0 ;
}

.syncer-acdn-parent li p a:after ,
.syncer-acdn-parent li p a:hover:after
{
    color: #333 ;
    background: rgba( 0,0,255 , 0.1 ) ;
}

.syncer-acdn-parent li p a:after
{
    position: absolute ;
    top: 50% ;
    right: 12px ;
    /*content: "開閉" ;*/
    font-size: .85em ;
    margin-top: -12.5px ;
    height: 17px ;
    line-height: 17px ;
    padding: 4px 8px ;
}


/* 親の[a]と子の[li] */
.syncer-acdn-parent li p a ,
.syncer-acdn-child li
{
    border-bottom: 1px solid rgba( 0,0,0, 0.1 ) ;
}


/* 親と子の[a] */
.syncer-acdn-parent li a
{
    display: block ;
    padding: 8px 0 ;
    /*font-weight: 700 ;*/
    text-decoration: none ;
    color: #FFFFFF;
    font-size: 90%;
}

.link
{
    display: block ;
    padding: 8px 0 ;
    /*font-weight: 700 ;*/
    text-decoration: none ;
    color: #FFFFFF;
    font-size: 90%;
    background-color: #585858 ;
    border:none;
    white-space: nowrap;
}

.syncer-acdn-parent li a:hover
{
    cursor: pointer ;
    color: #f00 ;
    background: rgba( 0,0,0, 0.1 ) ;
}

.link:hover
{
    cursor: pointer ;
    color: #f00 ;
    background: rgba( 0,0,0, 0.1 ) ;
}

/* 子の[a] */
.syncer-acdn-child li a:before
{
    content: "∟" ;
    padding-right: 5px ;
    margin-left: 10px ;
}
.link:before
{
    content: "∟" ;
    padding-right: 5px ;
    margin-left: 10px ;
}
}
</style>
<script>
    // DOMを全て読み込んでから処理する
    $(function()
    {
        // [.syncer-acdn]にクリックイベントを設定する
        $( '.syncer-acdn' ).click( function()
        {
            // [data-target]の属性値を代入する
            var target = $( this ).data( 'target' ) ;

            // [target]と同じ名前のIDを持つ要素に[slideToggle()]を実行する
            $( '#' + target ).slideToggle() ;

            // 終了
            return false ;
        } ) ;
    }) ;
</script>

<div class="col-md-12">
<!-- アコーディオンメニュー -->
<div class="col-md-3 small" style="margin-left: -30px">
    <ul class="syncer-acdn-parent">
        <p>
            <?= $this->Html->link('README', [
                ], [
                'style' => "color:#FFFFFF"
                ]);?>
        </p>
        <?php foreach ($unique_large_categories as $unique_large_category) :?>
            <?php if ($unique_large_category != 'カテゴリなし'): ?>
                <li><p><a class="syncer-acdn " data-target="syncer-acdn-<?= $unique_large_category;?>">&nbsp;<?= $unique_large_category;?></a></p>
                    <ul id="syncer-acdn-<?= $unique_large_category;?>" class="syncer-acdn-child">
                        <?php foreach ($categories as $category): ?>
                            <?php if ($unique_large_category == strstr($category, "/", TRUE) && substr(strstr($category, "/"),1) !== 'カテゴリなし') :?>
                                <li>
                                    <?= $this->Form->create(NULL, [
                                        'url' => [
                                        'action' => 'find'
                                        ]
                                        ]); ?>

                                    <?= $this->Form->hidden('category', [
                                        'value' => $category
                                        ]); ?>

                                    <?= $this->Form->end([
                                        'label' => substr(strstr($category, "/"),1),
                                        'class' => 'link',
                                        'style' => 'padding-right:190px; max-width: 190px'
                                        ]); ?>

                                </li>
                            <?php endif ;?>
                        <?php endforeach ;?>

                        <?php foreach ($categories as $category): ?>
                            <!-- カテゴリなしの場合 -->
                            <?php if ($unique_large_category == strstr($category, "/", TRUE) && substr(strstr($category, "/"),1) == 'カテゴリなし') :?>
                                <li>
                                    <?= $this->Form->create(NULL, [
                                        'url' => [
                                        'action' => 'find'
                                        ]
                                        ]); ?>

                                    <?= $this->Form->hidden('category', [
                                        'value' => $category
                                        ]); ?>

                                    <?= $this->Form->end([
                                        'label' => '# 全て表示 (カテゴリなし含む)',
                                        'class' => 'link',
                                        'style' => 'padding-right:190px; max-width: 190px'
                                        ]); ?>

                                </li>
                            <?php endif ;?>
                        <?php endforeach ;?>

                    </ul>
                </li>
            <?php endif; ?>
        <?php endforeach ;?>

        <!-- nocategoryメニュー -->
        <li><p><a class="syncer-acdn" data-target="syncer-acdn-nocategory">&nbsp;(no category)</a></p>
            <ul id="syncer-acdn-nocategory" class="syncer-acdn-child">
                <?php foreach ($no_categories as $no_category): ?>
                    <li>
                        <?= $this->Form->create(NULL, [
                            'url' => [
                            'action' => 'find'
                            ]
                            ]); ?>

                        <?= $this->Form->hidden('category', [
                            'value' => '(no category)/'.$no_category
                            ]); ?>

                        <?= $this->Form->end([
                            'label' => $no_category,
                            'class' => 'link',
                            'style' => 'padding-right:190px; max-width: 190px'
                            ]); ?>
                    </li>
                <?php endforeach ;?>
            </ul>
        </li>
    </ul>
</div>

<!-- READMEの表示 -->
<div class="col-md-9" style="margin-top: 17px">

    <!-- タイトル    -->
    <div class="col-md-12">
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
    <hr class="col-md-12">

    <!-- 本文 -->
    <?= $this->Markdown->transform(h($readme[0]['Document']['body']));?>
</div>
</div>