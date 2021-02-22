<?php


namespace App\Controllers;


class ImageController extends BaseController
{
    protected $db;
    protected $imageModel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->imageModel = model('Image', true, $db);
    }

    public function index()
    {
        $images = $this->imageModel->findAll();
        return $this->response->setJSON([
            "result" => $images
        ]);
    }

    public function create()
    {
        $data = [
            "name" => $this->request->getVar('name'),
            "author" => $this->request->getVar('author'),
        ];
        $this->imageModel->insert($data);
        return $this->response->setJSON([
            "message" => "Record added successfully"
        ]);
    }
}