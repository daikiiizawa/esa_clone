<?php

class DocumentsController extends AppController{
    public $uses = ['Document', 'User'];

    public $components = [
        'Paginator' => [
            'limit' => 10,
            'order' => ['created' => 'desc']
        ],
        'Markdown.Markdown'
    ];

    // マークダウンプラグイン読み込み
    public $helpers = array('Markdown.Markdown');

    public function isAuthorized($user) {
        // 登録済ユーザーは投稿できる
        if ($this->action === 'add') {
            return true;
        }

        // 投稿のオーナーは編集や削除ができる
        if (in_array($this->action, array('view', 'edit', 'delete'))) {
            $documentId = (int) $this->request->params['pass'][0];
            if ($this->Document->isOwnedBy($documentId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

    public function index(){
        $this->set('title_for_layout', 'HOME');
        $readme = $this->Document->find('all', [
            'conditions' => ['Document.title LIKE' => 'README.md'. '%'],
            ]);
        $this->set('readme', $readme);

        $documents = $this->Paginator->paginate('Document');
        $this->set('documents', $documents);
    }


    public function view($id = null){
        $this->set('title_for_layout', 'ドキュメント詳細');
        if (!$this->Document->exists($id)) {
            throw new NotFoundException('ドキュメントがみつかりません');
        }

        $document = $this->Document->findById($id);
        $this->set('document', $document);
        $user = $this->Auth->user();
        $this->set('user', $user);
    }


    public function add(){
        $this->set('title_for_layout', 'ドキュメント追加');
        $user_id = $this->Auth->user()['id'];
        $this->set('user_id', $user_id);

        if ($this->request->is('post')) {
            $this->Document->create();

            if ($this->Document->save($this->request->data)) {
                $this->Flash->success('登録が完了しました');
                return $this->redirect(['action' => 'index']);
            }
        }
    }

    public function edit($id = null){
        $this->set('title_for_layout', 'ドキュメント編集');
        if (!$this->Document->exists($id)) {
            throw new NotFoundException('ドキュメントが見つかりません');
        }

        if (!$this->request->data) {
            $this->request->data = $this->Document->findById($id);
        }

        // if ($this->request->is('post', 'put')) {
        //     if ($this->Document->save($this->request->data)) {
        //         $this->Flash->success('更新しました。');
        //         return $this->redirect(['action' => 'view',$id]);
        //     }
        // } else {
        //     $this->request->data = $this->Document->findById($id);
        // }
        $this->set('id',$id);
    }

    public function confirm($id = null) {
        $this->set('title_for_layout', '確認画面');
        if (!$this->Document->exists($id)) {
            throw new NotFoundExeption('ドキュメントが見つかりません');
        }
        // 既存データ参照
        $document = $this->Document->findById($id);
        $this->set('document', $document);
        // 編集画面からのpostデータ
        $confirm = $this->request->data;
        $this->set('confirm', $confirm);
    }

    public function save($id = null) {
        if (!$this->Document->exists($id)) {
            throw new NotFoundExeption('ドキュメントが見つかりません');
        }
        if ($this->request->is(['post', 'put'])) {
            if ($this->Document->save($this->request->data)) {
                $this->Flash->success('更新しました');
                return $this->redirect(['action' => 'view',$id]);
            } else {
            $this->Flash->error('必須項目の編集に誤りがあるため保存できませんでした。');
            return $this->redirect(['action' => 'view',$id]);
            }
        } else {
            $this->Flash->error('失敗');
            return $this->redirect(['action' => 'view',$id]);
        }
    }

    public function delete($id = null){
        if (!$this->Document->exists($id)) {
            throw new NotFoundException('ドキュメントが見つかりません');
        }
        $this->request->allowMethod('post', 'delete');
        $this->Document->delete($id);
        $this->Flash->success('削除が完了しました。');
        return $this->redirect(['action' => 'index']);
    }

    public function team(){
        $this->set('title_for_layout', 'TEAM');
        $users = $this->User->find('all');
        $this->set('users', $users);
        // debug($users);
    }

    public function posts(){
        $this->set('title_for_layout', 'POSTS');
        $readme = $this->Document->find('all', [
            'conditions' => ['Document.title LIKE' => 'README.md'. '%'],
            ]);
        $this->set('readme', $readme);

        $documents = $this->Paginator->paginate('Document');
        $this->set('documents', $documents);
    }

}