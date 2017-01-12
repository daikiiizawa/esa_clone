<style>
/* 親の[ul] */
.syncer-acdn-parent
{
    width: 250px ;
    margin: 0px.0 0 -15px ;
    padding: 12px 18px ;
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

.syncer-acdn-parent li a:hover
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

    <ul class="syncer-acdn-parent"><p class="text-default" style="color:#FFFFFF">README</p>
        <?php foreach ($unique_large_categories as $unique_large_category) :?>
            <?php if ($unique_large_category != 'カテゴリなし'): ?>
                <li><p><a class="syncer-acdn " data-target="syncer-acdn-<?= $unique_large_category;?>">&nbsp;<?= $unique_large_category;?></a></p>
                    <ul id="syncer-acdn-<?= $unique_large_category;?>" class="syncer-acdn-child">
                        <?php foreach ($categories as $category): ?>
                            <?php if ($unique_large_category == strstr($category, "/", TRUE)) :?>
                                <li>
                                    <?= $this->Html->link(substr(strstr($category, "/"),1), [
                                        'action' => 'view',
                                        ]) ;?>
                                </li>
                            <?php endif ;?>
                        <?php endforeach ;?>

                    </ul>
                </li>
            <?php endif; ?>
        <?php endforeach ;?>
            <li><p><a class="syncer-acdn" data-target="syncer-acdn-nocategory">&nbsp;(no category)</a></p>
                <ul id="syncer-acdn-nocategory" class="syncer-acdn-child">
                    <?php foreach ($no_categories as $no_category): ?>
                        <li>
                            <?= $this->Html->link($no_category,[]) ;?>
                        </li>
                    <?php endforeach ;?>
                </ul>
            </li>
    </ul>

</div>


<div class="col-md-12">
    <div class="col-md-3"></div>

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

<div class="col-md-3 small" style="margin-top: 17px">
    <table class="table table-striped">
        <thead class="text-info">
            <th>Title</th>
        </thead>

        <tbody>
            <?php foreach($documents as $document) :?>
                <tr>
                    <td><?= $this->Html->link($document['Document']['title'], [
                        'action' => 'view',
                        $document['Document']['id']
                        ]) ;?>
                    </td>
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
