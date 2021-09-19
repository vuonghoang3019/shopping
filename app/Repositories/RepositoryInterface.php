<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function list();

    public function detail($id);

    public function create($attributes = []);

    public function update($id,$attributes = []);

    public function delete($id);
}
