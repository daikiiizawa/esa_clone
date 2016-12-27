<?php

class CommentsController extends AppController {
    public $uses = ['Comment', 'Customer', 'User'];

    public function add(){
        if ($this->request->is('post')) {
            $this->Comment->create();
            $documentId = $this->request->data['Comment']['document_id'];
            $this->set('documentId', $documentId);

            if ($this->Comment->save($this->request->data)){
                $this->Flash->success('対応内容を登録しました');
                return $this->redirect(['controller' => 'documents', 'action' => 'view',$documentId]);

            } else {
                $this->Flash->error('対応内容が未入力です');
                return $this->redirect(['controller' => 'documents', 'action' => 'view',$documentId]);
            }
        }
    }

}