<?php

class Document extends AppModel {

    public $validate = [
        'family_name' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => '姓を入力して下さい'
            ],
            'length' => [
                'rule' => ['between', 1, 50],
                'message' => '姓を50字以下で入力して下さい'
            ],
        ],
    ];

    public $belongsTo = [
        'User' => ['className' => 'User'],
    ];
}

