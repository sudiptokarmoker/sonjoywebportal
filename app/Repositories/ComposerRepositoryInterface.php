<?php
namespace App\Repositories;

interface ComposerRepositoryInterface{
    public function all();
    public function save(array $data);
    public function edit($id);
    public function update(array $data, $id);
    public function delete($id);
}