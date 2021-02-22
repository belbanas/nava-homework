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
        ])->setStatusCode(200);
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
        ])->setStatusCode(201);
    }

    public function update($id)
    {
        $name = $this->request->getVar('name');
        $author = $this->request->getVar('author');
        $data = [
            "name" => $name,
            "author" => $author,
        ];
        $this->imageModel->update($id, $data);
        return $this->response->setJSON([
            "message" => "Record updated successfully"
        ])->setStatusCode(200);
    }

    public function delete($id)
    {
        $this->imageModel->delete($id);
        return $this->response->setJSON([
            "message" => "Record deleted successfully"
        ])->setStatusCode(200);
    }
}