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
        try {
            $data = [
                "name" => $this->request->getVar('name'),
                "author" => $this->request->getVar('author'),
            ];
            $this->imageModel->insert($data);
            return $this->response->setJSON([
                "message" => "Record added successfully"
            ])->setStatusCode(201);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                "Error" => $e->getMessage()
            ]);
        }
    }

    public function update($id)
    {
        try {
            $data = [
                "name" => $this->request->getVar('name'),
                "author" => $this->request->getVar('author'),
            ];
            $this->imageModel->update($id, $data);
            return $this->response->setJSON([
                "message" => "Record updated successfully"
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                "Error" => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $this->imageModel->delete($id);
            return $this->response->setJSON([
                "message" => "Record deleted successfully"
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                "Error" => $e->getMessage()
            ]);
        }
    }
}