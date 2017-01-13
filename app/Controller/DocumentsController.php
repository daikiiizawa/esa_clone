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
        $this->set('title_for_layout', 'Home');
        $readme = $this->Document->find('all', [
            'conditions' => ['Document.title LIKE' => 'README.md'. '%'],
            ]);
        $this->set('readme', $readme);

        // $documents = $this->Paginator->paginate('Document');
        $documents = $this->Document->find('all');
        $this->set('documents', $documents);

        $titles = array();
        $large_categories = array();
        $medium_categories = array();
        $no_categories = array();
        $categories = array();

        foreach ($documents as $document) {
            array_push($titles, $document['Document']['title']);
            $pick_large_cate = strstr($document['Document']['title'], "/", TRUE);
            $pick_medium_cate = strstr(substr(strstr($document['Document']['title'], "/"), 1), "/", TRUE);
            if (!$pick_large_cate) {
                $pick_large_cate = 'カテゴリなし';
                array_push($no_categories, $document['Document']['title']);
            }
            if (!$pick_medium_cate) {
                $pick_medium_cate = 'カテゴリなし';
                // array_push($no_categories, $document['Document']['title']);
            }
            array_push($categories, $pick_large_cate.'/'.$pick_medium_cate);

            array_push($large_categories, $pick_large_cate);
            array_push($medium_categories, $pick_medium_cate);

        }
        $this->set('titles', $titles);
        $this->set('large_categories', $large_categories);
        $this->set('medium_categories', $medium_categories);
        $this->set('no_categories', $no_categories);
        $this->set('categories', $categories);

        $unique_large_categories = array_keys(array_count_values($large_categories));
        $this->set('unique_large_categories', $unique_large_categories);
        $unique_medium_categories = array_keys(array_count_values($medium_categories));
        $this->set('unique_medium_categories', $unique_medium_categories);

        $categories = array_keys(array_count_values($categories));
        $this->set('categories', $categories);

    }

    public function find() {
        $documents = $this->Document->find('all');
        $this->set('documents', $documents);

        if ($this->request->data) {
            $category = $this->request->data['Document']['category'];
            $this->set('category', $category);
        }

        $titles = array();
        $large_categories = array();
        $medium_categories = array();
        $no_categories = array();
        $categories = array();

        foreach ($documents as $document) {
            array_push($titles, $document['Document']['title']);
            $pick_large_cate = strstr($document['Document']['title'], "/", TRUE);
            $pick_medium_cate = strstr(substr(strstr($document['Document']['title'], "/"), 1), "/", TRUE);
            if (!$pick_large_cate) {
                $pick_large_cate = 'カテゴリなし';
                array_push($no_categories, $document['Document']['title']);
            }
            if (!$pick_medium_cate) {
                $pick_medium_cate = 'カテゴリなし';
                // array_push($no_categories, $document['Document']['title']);
            }
            array_push($categories, $pick_large_cate.'/'.$pick_medium_cate);

            array_push($large_categories, $pick_large_cate);
            array_push($medium_categories, $pick_medium_cate);

        }
        $this->set('titles', $titles);
        $this->set('large_categories', $large_categories);
        $this->set('medium_categories', $medium_categories);
        $this->set('no_categories', $no_categories);
        $this->set('categories', $categories);


        $unique_large_categories = array_keys(array_count_values($large_categories));
        $this->set('unique_large_categories', $unique_large_categories);
        $unique_medium_categories = array_keys(array_count_values($medium_categories));
        $this->set('unique_medium_categories', $unique_medium_categories);

        $categories = array_keys(array_count_values($categories));
        $this->set('categories', $categories);

    }

    public function view($id = null){
        $this->set('title_for_layout', 'Document view');
        if (!$this->Document->exists($id)) {
            throw new NotFoundException('ドキュメントがみつかりません');
        }

        $document = $this->Document->findById($id);
        $this->set('document', $document);
        $user = $this->Auth->user();
        $this->set('user', $user);
    }


    public function add(){
        $this->set('title_for_layout', 'New post');
        $user_id = $this->Auth->user()['id'];
        $this->set('user_id', $user_id);
    }

    public function edit($id = null){
        $this->set('title_for_layout', 'Edit post');
        if (!$this->Document->exists($id)) {
            throw new NotFoundException('ドキュメントが見つかりません');
        }

        if (!$this->request->data) {
            $this->request->data = $this->Document->findById($id);
        }
        $this->set('id',$id);
    }

    public function addconfirm($id = null) {
        $this->set('title_for_layout', 'Confirm post');
        $user_id = $this->Auth->user()['id'];
        $this->set('user_id',$user_id);

        // 編集画面からのpostデータ
        $confirm = $this->request->data;
        $this->set('confirm', $confirm);

        // 確認画面に入る前にバリデーション処理
        if ($this->request->is('post')) {
            // モデルにpostされたデータをセット
            $this->Document->set($this->request->data);

            if (!$this->Document->validates()) {
                $errors = $this->validateErrors($this->Document);
                $this->set('errors',$errors);
                $this->render('add');
            }
        }
    }

    public function confirm($id = null) {
        $this->set('title_for_layout', 'Confirm post');
        if (!$this->Document->exists($id)) {
            throw new NotFoundExeption('ドキュメントが見つかりません');
        }
        // 既存データ参照
        $document = $this->Document->findById($id);
        $this->set('document', $document);
        // 編集画面からのpostデータ
        $confirm = $this->request->data;
        $this->set('confirm', $confirm);

        // 確認画面に入る前にバリデーション処理
        if ($this->request->is('post')) {
            // モデルにpostされたデータをセット
            $this->Document->set($this->request->data);

            if (!$this->Document->validates()) {
                $errors = $this->validateErrors($this->Document);
                $this->set('errors',$errors);
                $id = $confirm['Document']['id'];
                $this->set('id', $id);
                $this->render('edit');
            }
        }
    }

    public function addsave($id = null) {
        if ($this->request->is(['post', 'put'])) {
            if ($this->Document->save($this->request->data)) {
                $this->Flash->success('投稿しました');
                return $this->redirect(['action' => 'index']);
            } else {
            $this->Flash->error('保存できませんでした。');
            return $this->redirect(['action' => 'index']);
            }
        } else {
            $this->Flash->error('失敗');
            return $this->redirect(['action' => 'view',$id]);
        }
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
        $this->set('title_for_layout', 'Team members');
        $users = $this->User->find('all');
        $this->set('users', $users);
    }

    public function posts(){
        $this->set('title_for_layout', 'Recent posts');
        $readme = $this->Document->find('all', [
            'conditions' => ['Document.title LIKE' => 'README.md'. '%'],
            ]);
        $this->set('readme', $readme);

        $documents = $this->Paginator->paginate('Document');
        $this->set('documents', $documents);
    }

}