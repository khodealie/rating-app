<?php

namespace App\Services\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface MyServiceInterface
{
    public function index(): Collection;

    public function store(array $data): Model;

    public function show($id): Model;

    public function update($id, array $data): Model;

    public function destroy($id): bool;
}
