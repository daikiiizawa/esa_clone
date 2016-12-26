<div class='container'>
<div class="col-md-12">

    <h2>Members(<?= count($users);?>)</h2>

</div>
<div class="col-md-10" style="margin-top: 17px">
    <table class="table table-striped">
        <thead class="text-info">
            <th>name</th>
        </thead>

        <tbody>
            <?php foreach($users as $user) :?>
                <tr>
                    <td>
                        <?= $user['User']['screen_name'] ;?>
                    </td>
                    <?php if ($currentUser['role'] == 'admin'):?>
                        <td>
                            <div class="btn btn-primary">編集</div>
                        </td>
                    <?php endif ;?>
                </tr>

            <?php endforeach ;?>
        </tbody>

    </table>

</div>
</div>