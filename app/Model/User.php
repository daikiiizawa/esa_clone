<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel{
    public $validate = [
        'email' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'メールアドレスを入力してください'
            ],
            'validEmail' => [
                'rule' => 'email',
                'message' => '正しいメールアドレスを入力してください'
            ],
            'emailExists' => [
                'rule' => ['isUnique', 'email'],
                'message' => '入力されたメールアドレスは既に登録されています'
            ],
            'maxlength' => [
                'rule' => ['between', 1, 255],
                'message' => 'メールアドレスは255字以下で入力して下さい'
            ],
        ],

        'password' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'パスワードを入力してください'
            ],
            'numeric' => [
                'rule' => 'alphaNumeric',
                'message' => 'パスワードは半角英数字のみ使用できます'
            ],
            'minlength' =>[
                'rule' => ['minLength', 8],
                'message' => 'パスワードは8文字以上で入力して下さい'
            ],
            'maxlength' => [
                'rule' => ['between', 1, 255],
                'message' => 'パスワードは255字以下で入力して下さい'
            ],
            'match' => [
                'rule' => 'passwordConfirm',
                'message' => 'パスワード(確認)と一致していません'
            ],
        ],

        'password_confirm' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'パスワード(確認)を入力してください'
            ],
        ],

        //パスワード変更時のバリデーション
        'password_current' =>[
            'required' => [
                'rule' => 'notBlank',
                'message' => '現在のパスワードが入力されていません'
            ],
            'match' => [
                'rule' => 'checkCurrentPassword',
                'message' => '現在のパスワードが間違っています'
            ]
        ],
    ];

    public function passwordConfirm($check) {
        if ($check['password'] === $this->data['User']['password_confirm']) {
            return true;
        }
        return false;
    }

    public function beforeSave($options = []){
        if(isset($this->data['User']['password'])){
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data['User']['password'] = $passwordHasher->hash($this->data['User']['password']);
        }
        return true;
    }

    public function checkCurrentPassword($check){
        $password = array_values($check)[0];

        $user = $this->findById($this->data['User']['id']);

        $passwordHasher = new BlowfishPasswordHasher();

        if($passwordHasher->check($password, $user['User']['password'])){
            return true;
        }
            return false;
    }
}
