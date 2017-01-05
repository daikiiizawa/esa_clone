<?php

class Document extends AppModel {

    public $validate = [
        'title' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'タイトルを入力して下さい'
            ],
            'length' => [
                'rule' => ['between', 1, 255],
                'message' => 'タイトルを255字以下で入力して下さい'
            ],
        ],
        'body' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => '内容を入力して下さい'
            ],
            'length' => [
                'rule' => ['between', 1, 4000],
                'message' => '4000字以下で入力して下さい'
            ],
        ],
    ];

    public $belongsTo = [
        'User' => ['className' => 'User'],
    ];

    public $hasMany = [
        'Comment' => [
            'className' => 'Comment',
            'dependent' => true
        ]
    ];
}

