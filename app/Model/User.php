<?php
App::uses(
    'BlowfishPasswordHasher',
    'Controller/Component/Auth'
    );

class User extends AppModel{
    // 使用するビヘイビアの宣言
    public $actsAs = [
        // UploadプラグインのUploadBehaviorという意味
        'Upload.Upload' => [
            // photoというカラムに Uploadビヘイビアを使ってファイル名を登録する
            'photo' => [
                // デフォルトのカラム名 dir を photo_dir に変更
                'fields' => ['dir' => 'photo_dir'],
                'deleteOnUpdate' => true,
            ]
        ],
    ];

    public $hasMany = [
        'Document' => [
            'className' => 'Document',
            'dependent' => true // User が削除されたら Tweet も再帰的に削除する
        ],
        'Comment' => [
            'className' => 'Comment'
        ]
    ];

    public $validate = [
        'name' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => '名前を入力してください'
            ],
            'maxlength' => [
                'rule' => ['between', 1, 255],
                'message' => '名前は255字以下で入力して下さい'
            ],
        ],
        'screen_name' => [
            'required' => [
                'rule' => 'notBlank',
                'message' => 'ニックネームを入力してください'
            ],
            'maxlength' => [
                'rule' => ['between', 1, 255],
                'message' => ' ニックネームは255字以下で入力して下さい'
            ],
        ],
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
        'role' => [
            'valid' => [
                'rule' => ['inList', ['admin', 'student']],
                'message' => '選択して下さい',
                'allowEmpty' => false
            ]
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

        // 画像ファイルアップロードのバリデーション追加
        'photo' => [
            'UnderPhpSizeLimit' => [
                'allowEmpty' => true,
                'rule' => 'isUnderPhpSizeLimit',
                'message' => 'アップロード可能なファイルサイズを超えています。'
            ],
            'BelowMaxSize' => [
                'rule' => ['isBelowMaxSize', 5242880],
                'message' => 'アップロード可能なファイルサイズを超えています。'
            ],
            'CompletedUpload' => [
                'rule' => 'isCompletedUpload',
                'message' => 'ファイルが正常にアップロードされませんでした。'
            ],
            'ValidMimeType' => [
                'rule' => ['isValidMimeType', ['image/jpeg', 'image/png', 'image/gif'], false],
                'message' => 'プロフィール画像はjpg/gif/png形式でアップロードしてください。'
            ],
            'ValidExtension' => [
                'rule' => ['isValidExtension', ['jpeg', 'jpg', 'png', 'gif'], false],
                'message' => 'プロフィール画像はjpg/gif/png形式でアップロードしてください。'
            ],
            'size' => [
                'maxFileSize' => [
                    'rule' => ['fileSize', '<=', '500KB'],  // 500K以下
                    'message' => ['プロフィール画像のサイズは500KB以下にしてください。']
                ],
            ],
        ]
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
