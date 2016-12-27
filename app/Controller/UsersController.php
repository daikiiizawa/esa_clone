<?php

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('signup');
    }


    public function login() {
        $this->set('title_for_layout', 'ログイン');
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
        $this->set('title_for_layout', 'ユーザー登録');
        // if($this->Auth->user()){
        //     return $this->redirect($this->Auth->redirectUrl());
        // }

        if($this->request->is('post')){
            $this->User->create();
            if($this->User->save($this->request->data)){
                $this->Flash->success('ユーザーを登録しました');
                return $this->redirect(['action' => 'login']);
            }
        }
    }

    public function edit(){
        $this->set('title_for_layout', '設定変更');
        if($this->request->is(['post', 'put'])){
            if($this->User->save($this->request->data)) {
                $this->Flash->success('パスワードを変更しました');
                $user = $this->User->find('first',
                    ['fields' => ['id', 'email', 'password'],
                    'conditions' => ['id' => $this->Auth->user('id')]]);
                $this->Auth->login($user['User']);

                return $this->redirect($this->Auth->redirectUrl());
            }
        } else {
            $this->request->data = $this->User->findById($this->Auth->user('id'));
        }
    }


    public function logout() {
        $this->redirect($this->Auth->logout());
    }

}