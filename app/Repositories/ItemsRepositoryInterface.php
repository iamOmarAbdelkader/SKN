<?php
namespace App\Repositories;

interface ItemsRepositoryInterface {

    public function create($data);
    
    public function findById($id);

    public function delete($id);
}