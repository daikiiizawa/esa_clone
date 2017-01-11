<?php

class UsersController extends AppController {

    public $components = [
        'Paginator' => [
            'limit' => 10,
            'order' => ['created' => 'desc']
        ]
    ];


    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('signup');
    }


    public function login() {
        $this->set('title_for_layout', 'Login');
        if($this->Auth->user()){
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->request->is('post')) {
            if($this->Auth->login()){
                $this->Flash->success('ログインしました');
                $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('メールアドレスかパスワードが違います');
        }
    }

    public function signup() {
        $this->set('title_for_layout', 'Signup');

        if($this->request->is('post')){
            $this->User->create();
            if($this->User->save($this->request->data)){
                $this->Flash->success('ユーザーを登録しました');
                return $this->redirect(['action' => 'login']);
            }
        }
    }

    public function add() {
        $this->set('title_for_layout', 'Add user');

        if($this->request->is('post')){
            $this->User->create();
            if($this->User->save($this->request->data)){
                $this->Flash->success('ユーザーを登録しました');
                return $this->redirect(['controller' => 'documents', 'action' => 'team']);
            }
        }
    }

    public function edit($id = null){
        $this->set('title_for_layout', 'Edit user');
        if (!$this->User->exists($id)) {
            throw new NotFoundException('ユーザーが見つかりません');
        }

        if ($this->request->is(['post', 'put'])) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->Flash->success('ユーザー情報を更新しました');
                return $this->redirect(['controller' => 'documents', 'action' => 'team']);
            }
        } else {
            $this->request->data = $this->User->findById($id);

            // 既存のパスワード情報をpostしない
            $this->request->data['User']['password'] ='';
            $photo = $this->request->data['User']['photo'];
            $photo_dir = $this->request->data['User']['photo_dir'];
            $this->set('photo', $photo);
            $this->set('photo_dir', $photo_dir);

        }
        $this->set('id',$id);
    }

    public function save($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundExeption('ユーザーが見つかりません');
        }

        if ($this->request->is(['post', 'put'])) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success('ユーザー情報を更新しました');
                return $this->redirect(['controller' => 'documents', 'action' => 'team']);
            } else {
            $this->Flash->error('保存できませんでした。');
            return $this->redirect(['controller' => 'documents', 'action' => 'team']);
            }
        } else {
            $this->Flash->error('失敗');
            return $this->redirect(['controller' => 'documents', 'action' => 'team']);
        }
    }

    public function logout() {
        $this->Flash->success('ログアウトしました');
        $this->redirect($this->Auth->logout());
    }

    public function delete($id = null){
        if (!$this->User->exists($id)) {
            throw new NotFoundException('ユーザーが見つかりません');
        }


        $this->request->allowMethod('post', 'delete');
        $this->User->delete($id);
        $this->Flash->success('ユーザーを削除しました。');
        return $this->redirect(['controller' => 'documents', 'action' => 'team']);
    }

    public function view($id = null){
        $this->set('title_for_layout', 'User view');
        if (!$this->User->exists($id)) {
            throw new NotFoundException('ユーザーが見つかりません');
        }

        $user = $this->User->findById($id);
        $this->set('user', $user);

        $user_id = $user['User']['id'];
        $documents = $this->paginate('Document',array('Document.user_id' => $user_id));
        $this->set(compact('documents'));
    }

}