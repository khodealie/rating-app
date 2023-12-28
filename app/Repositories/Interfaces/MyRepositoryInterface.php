<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface MyRepositoryInterface
{
    public function index();

    public function store(array $data): Model;

    public function show($id): Model;

    public function update($id, array $data): Model;

    public function destroy($id): void;
}
