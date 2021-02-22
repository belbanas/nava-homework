<?php


namespace App\Controllers;


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
        $views = $this->viewCountModel->where('image_id', $id)->first();
        return $this->response->setJSON([
            "message" => $views->view_count
        ]);
    }
}