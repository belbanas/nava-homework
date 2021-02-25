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
                "view_count" => $views->view_count
            ])->setStatusCode(200);
        } catch (Exception $e) {
            // If something went wrong set the counts to zero.//
            return $this->response->setJSON([
                "Error" => $e->getMessage(),
                "view_count" => 0]);
        }
    }

    public function incrementCounter($id)
    {
        $views = $this->viewCountModel->where('image_id', $id)->first();
        if ($views === null) {
            try {
                $this->viewCountModel->insert([
                    "image_id" => $id,
                    "view_count" => 1
                ]);
            } catch (Exception $e) {
                return [
                    "Error" => $e->getMessage()
                ];
            }
        } else {
            try {
                $this->viewCountModel->where('image_id', $id)->increment('view_count');
            } catch (Exception $e) {
                return [
                    "Error" => $e->getMessage()
                ];
            }
        }
        return [
            "message" => "OK"
        ];
    }
}