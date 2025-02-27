<?php

namespace App\Interfaces;

interface ButtonRepositoryInterface {
    public function findAll(): array;
    public function findById(int $id): ?array;
    public function save(array $data): bool;
    public function update(array $data): bool;
    public function clearById(int $id): void;
}