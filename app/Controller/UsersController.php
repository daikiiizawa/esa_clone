<?php

class UsersController extends AppController {

    // public function beforeFilter() {
    //     parent::beforeFilter();

    //     $this->Auth->allow('add');
    // }


    public function login() {

        // if ($this->Auth->user()) {
        //     return $this->redirect($this->Auth->redirectUrl());
        // }

        // if ($this->request->is('post')) {
        //     if ($this->Auth->login()) {
        //         $this->redirect($this->Auth->redirectUrl());
        //     }

        //     $this->Flash->error('メールアドレスかパスワードが違います');
        // }
    }
    // public function add() {

    //     if ($this->Auth->user()) {
    //         return $this->redirect($this->Auth->redirectUrl());
    //     }

    //     if ($this->request->is('post')) {
    //         $this->User->create();
    //         if ($this->User->save($this->request->data)) {
    //             $this->Flash->success('ユーザーを登録しました');
    //             return $this->redirect(['action' => 'login']);
    //         }
    //     }
    // }

    public function logout() {
    //     $this->redirect($this->Auth->logout());
    }

}