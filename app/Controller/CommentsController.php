<?php

class CommentsController extends AppController {
    public $uses = ['Comment', 'Customer', 'User'];

    public $components = ['Markdown.Markdown'];

    public $helpers = array('Markdown.Markdown');

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

    public function edit($id = null){
        $this->set('title_for_layout', 'Edit comment');
        if (!$this->Comment->exists($id)) {
            throw new NotFoundException('コメントが見つかりません');
        }

        // リダイレクト先のドキュメントIDを取得
        $document_id = $this->Comment->findById($id)['Comment']['document_id'];
        $this->set('document_id',$document_id);

        if (!$this->request->data) {
            $this->request->data = $this->Comment->findById($id);
        }

        $comment = $this->Comment->findById($id);
        $this->set('comment', $comment);
        $this->set('id',$id);
    }

    public function confirm($id = null){
        $this->set('title_for_layout', 'Confirm comment');
        if (!$this->Comment->exists($id)) {
            throw new NotFoundExeption('ドキュメントが見つかりません');
        }
        // 既存データ参照
        $comment = $this->Comment->findById($id);
        $this->set('comment', $comment);
        $document_id = $comment['Comment']['document_id'];
        $this->set('document_id', $document_id);
        // 編集画面からのpostデータ
        $confirm = $this->request->data;
        $this->set('confirm', $confirm);

        // 確認画面に入る前にバリデーション処理
        if ($this->request->is('post')) {
            // モデルにpostされたデータをセット
            $this->Comment->set($this->request->data);

            if (!$this->Comment->validates()) {
                $errors = $this->validateErrors($this->Comment);
                $this->set('errors',$errors);
                $id = $confirm['Comment']['id'];
                $this->set('id', $id);
                $this->render('edit');
            }
        }
    }

    public function addconfirm($id = null){
        $this->set('title_for_layout', 'Confirm comment');

        // 編集画面からのpostデータ
        $confirm = $this->request->data;
        $this->set('confirm', $confirm);
        $this->set('document_id', $confirm['Comment']['document_id']);

        // 確認画面に入る前にバリデーション処理
        if ($this->request->is('post')) {
            // モデルにpostされたデータをセット
            $this->Comment->set($this->request->data);

            if (!$this->Comment->validates()) {
                $errors = $this->validateErrors($this->Comment);
                $this->set('errors',$errors);
                $id = null;
                $this->set('id', $id);
                $this->render('addedit');
            }
        }

    }

    public function addsave($id = null) {
        $document_id = $this->request->data['Comment']['document_id'];

        if ($this->request->is(['post', 'put'])) {
            if ($this->Comment->save($this->request->data)) {
                $this->Flash->success('コメントしました');
                return $this->redirect(['controller' => 'documents', 'action' => 'view',$document_id]);
            } else {
            $this->Flash->error('保存できませんでした。');
            return $this->redirect(['controller' => 'documents', 'action' => 'view',$document_id]);
            }
        } else {
            $this->Flash->error('失敗');
            return $this->redirect(['action' => 'view',$id]);
        }
    }

    public function save($id = null) {
        if (!$this->Comment->exists($id)) {
            throw new NotFoundExeption('ドキュメントが見つかりません');
        }
        $document_id = $this->request->data['Comment']['document_id'];

        if ($this->request->is(['post', 'put'])) {
            if ($this->Comment->save($this->request->data)) {
                $this->Flash->success('コメントを更新しました');
                return $this->redirect(['controller' => 'documents', 'action' => 'view',$document_id]);
            } else {
            $this->Flash->error('保存できませんでした。');
            return $this->redirect(['controller' => 'documents', 'action' => 'view',$document_id]);
            }
        } else {
            $this->Flash->error('失敗');
            return $this->redirect(['action' => 'view',$id]);
        }
    }

    public function delete($id = null){
        if (!$this->Comment->exists($id)) {
            throw new NotFoundException('コメントが見つかりません');
        }

        // リダイレクト先のドキュメントIDを取得
        $document_id = $this->Comment->findById($id)['Comment']['document_id'];

        $this->request->allowMethod('post', 'delete');
        $this->Comment->delete($id);
        $this->Flash->success('コメントを削除しました。');
        return $this->redirect(['controller' => 'documents', 'action' => 'view', $document_id]);
    }

}