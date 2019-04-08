<?php

namespace App\Repository;

interface Crud {

    public function insert(array $data);


    public function findById(int $id);


    public function update(array $data, int $id);


    public function delete(int $id);


    public function search(string $keyword);

}
