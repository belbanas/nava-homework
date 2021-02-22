<?php


namespace App\Controllers;




use Exception;

class ViewCountController extends BaseController
{
    protected $db;
    protected $viewCountModel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->viewCountModel = model('ViewCount', true, $db);
    }

    public function index($id)
    {
        try {
            $views = $this->viewCountModel->where('image_id', $id)->first();
            return $this->response->setJSON([
                "message" => $views->view_count
            ])->setStatusCode(200);
        } catch (Exception $e) {
            return $this->response->setJSON([
                "Error" => $e->getMessage()])->setStatusCode(400);
        }
    }
}