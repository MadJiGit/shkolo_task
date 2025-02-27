<?php
namespace App\Controllers;

use App\Interfaces\ButtonRepositoryInterface;
use Exception;

class ButtonController
{
    private ButtonRepositoryInterface $model;

    public function __construct(ButtonRepositoryInterface $model)
    {
        $this->model = $model;
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $buttons = $this->model->findAll();
        require dirname(__DIR__, 2) . '/views/button/index.php';
    }

    /**
     * @throws \Exception
     */
    public function edit(int $id): void
    {
        $button = $this->model->findById($id);
        if (!$button) {
            throw new \Exception("Button not found");
        }
        require dirname(__DIR__, 2) . '/views/button/edit.php';
    }

    /**
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function save(array $data): void
    {
        $id = urlencode($data['id']);
        $title = urlencode($data['title']);
        $color = urlencode($data['color']);

        // Validate title
        if (strlen($title) < 3) {
            throw new Exception("Title must be at least 3 characters.");
        }

        // Validate URL format
        if (!filter_var($data['link'], FILTER_VALIDATE_URL)) {
            throw new Exception("Invalid URL format.");
        }else {
            $link = urlencode($data['link']);
        }

        // Validate color
        if(empty($color)){
            throw new Exception("Color must be selected.");
        }

        if (isset($data['id'])) {
            try {
                $this->model->save($data);
                header("Location: index.php");
                exit();
            } catch (\Exception $e) {
                // Redirect back to the form with an error message
                $errorMessage = urlencode($e->getMessage());
                header("Location: index.php?action=edit&id={$id}&error={$errorMessage}&title={$title}&link={$link}&color={$color}");
                exit();
            }
        } else {
            try {
                $this->model->update($data);
                header("Location: index.php");
                exit();
            } catch (\Exception $e) {
                // Redirect back to the form with an error message
                $errorMessage = urlencode($e->getMessage());
                header("Location: index.php?action=edit&id={$id}&error={$errorMessage}&title={$title}&link={$link}&color={$color}");
                exit();
            }
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function clear(int $id): void
    {
        $this->model->clearById($id);
        header("Location: index.php");
    }
}