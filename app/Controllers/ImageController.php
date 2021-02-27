<?php


namespace App\Controllers;


use Exception;

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
        $result = [];
        foreach ($images as $image) {
            array_push($result, [
                "id" => $image->id,
                "name" => $image->name,
                "author" => $image->author,
                "view_count" => (new ViewCountController)->index($image->id)
            ]);
        }
        return $this->response->setJSON([
            "result" => $result
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
        } catch (Exception $e) {
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
        } catch (Exception $e) {
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
        } catch (Exception $e) {
            return $this->response->setJSON([
                "Error" => $e->getMessage()
            ]);
        }
    }

    public function view($id)
    {
        (new ViewCountController)->incrementCounter($id);
        $image = $this->imageModel->where('id', $id)->first();
        return view('image_view', [
            "id" => $id,
            "name" => $image->name,
            "author" => $image->author,
            ]);
    }
}