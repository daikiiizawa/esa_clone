<?php

class DocumentsController extends AppController{


    public $components = [
        'Paginator' => [
            'limit' => 10,
            'order' => ['created' => 'desc']
        ]
    ];

    public function index(){
        $this->set('title_for_layout', '一覧画面');
        $documents = $this->Paginator->paginate('Document');
        $this->set('documents', $documents);
    }
}