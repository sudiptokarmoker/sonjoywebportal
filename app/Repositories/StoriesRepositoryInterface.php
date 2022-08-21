<?php
namespace App\Repositories;

interface StoriesRepositoryInterface{
    public function getStoriesCategoryId();
    public function getAllStoriesCategoryLists();
    public function save(array $data);
    public function getArtistsListsData();
    public function getComposerListsData();
    public function all();
    public function edit($id);
    public function update(array $data, $id);
    public function delete($id);
}