<?php
namespace App\Repositories;

interface NovelsRepositoryInterface{
    public function save(array $data);
    public function all();
    public function edit($id);
    public function update(array $data, $id);
    public function delete($id);
    public function getNovelsCategoryId();
}