<?php

class Comment extends AppModel {

    public $validate = [
        'body' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => '内容を入力して下さい'
            ],
            'length' => [
                'rule' => ['between', 1, 1100],
                'message' => '1100字以下で入力して下さい'
            ],
        ],
    ];

    public $belongsTo = [
        'Document' => ['className' => 'Document'],
        'User' => ['className' => 'User',]
    ];
}

