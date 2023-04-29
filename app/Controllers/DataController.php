<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataModel;

class DataController extends BaseController
{
    public function data_json()
    {
        $dataModel = new DataModel();
        $getData = $dataModel->findAll();
        $jsonData = [];

        foreach ($getData as $data) {
            $json = [
                'id' => $data['id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'no_hp' => $data['no_hp'],
                'created_at' => $data['created_at'],
            ];
            array_push($jsonData, $json);
        }

        return $this->response->setJSON($jsonData);
    }
    public function index()
    {
        return view('data_table');
    }

    public function data_create_submit(){
        $dataModel = new DataModel();
    
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'no_hp' => $this->request->getVar('no_hp'),
        ];
    
        $dataModel->save($data);
        
        return $this->response->setJSON(['message' => 'Data successfully added']);
    }
    

    public function delete_data($id){
        $dataModel = new DataModel();
        $dataModel->delete($id);
        return $this->response->setJSON(['message' => 'Data deleted successfully.']);
    }
    
    public function get_data($id){
        $dataModel = new DataModel();
        $data = $dataModel->find($id); // retrieve data by id
    
        // check if data exists
        if ($data) {
            return $this->response->setJSON($data); // return JSON response
        } else {
            return $this->response->setStatusCode(404); // return 404 Not Found response
        }
    }

    public function edit_data($id){
        $dataModel = new DataModel();
        
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'no_hp' => $this->request->getVar('no_hp'),
        ];
        
        $dataModel->update($id, $data);
            
        return $this->response->setJSON(['message' => 'Data successfully updated']);
    }    
}
