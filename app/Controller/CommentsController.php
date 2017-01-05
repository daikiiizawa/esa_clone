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

    public function edit($id = null){
        $this->set('title_for_layout', 'コメント編集');
        if (!$this->Comment->exists($id)) {
            throw new NotFoundException('コメントが見つかりません');
        }

        // リダイレクト先のドキュメントIDを取得
        $document_id = $this->Comment->findById($id)['Comment']['document_id'];
        $this->set('document_id',$document_id);

        if ($this->request->is('post', 'put')) {
            if ($this->Comment->save($this->request->data)) {
                $this->Flash->success('コメントを更新しました。');
                return $this->redirect(['controller' => 'documents', 'action' => 'view', $document_id]);
            }
        } else {
                $this->request->data = $this->Comment->findById($id);
        }
        $this->set('id',$id);

    }

    public function delete($id = null){
        if (!$this->Comment->exists($id)) {
            throw new NotFoundException('コメントが見つかりません');
        }

        // リダイレクト先のドキュメントIDを取得
        $document_id = $this->Comment->findById($id)['Comment']['document_id'];

        $this->request->allowMethod('post', 'delete');
        $this->Comment->delete($id);
        $this->Flash->success('削除が完了しました。');
        return $this->redirect(['controller' => 'documents', 'action' => 'view', $document_id]);
    }

}

