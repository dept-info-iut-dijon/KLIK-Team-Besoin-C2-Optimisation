<?php

require_once '../data/interface/categoryDAOInterface.php';
require_once '../model/category.php';
require_once '../database.php';

class CategoryDAO implements CategoryDAOInterface {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * @throws Exception
     */
    public function create(Category $category): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $category->getCatName(),
                $category->getCatDescription()
            ];
            $sql = "INSERT INTO Categories (cat_name, cat_description) VALUES (?, ?)";

            $this->db->execute($sql, $params);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function read(int $catId): Category {
        $result = $this->db->query("SELECT * FROM Categories WHERE cat_id = :cat_id", [":cat_id" => $catId]);

        if(count($result) === 0)
            throw new Exception("Category not found");

        return Category::createFromDb($result[0]);
    }

    /**
     * @throws Exception
     */
    public function update(Category $category): bool {
        $this->db->beginTransaction();

        try
        {
            $params = [
                $category->getCatName(),
                $category->getCatDescription(),
                $category->getCatId()
            ];
            $sql = "UPDATE Categories SET cat_name = ?, cat_description = ? WHERE cat_id = ?";

            $this->db->execute($sql, $params);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function delete(int $catId): bool {
        $this->db->beginTransaction();
        try
        {
            $this->db->query("DELETE FROM Categories WHERE cat_id = :cat_id", [":cat_id" => $catId]);
            $this->db->commit();
        }
        catch (Exception $e)
        {
            $this->db->rollBack();
            throw $e;
        }

        return true;
    }

    public function getAll(): array {
        $categories = $this->db->query("SELECT * FROM Categories");

        return array_map(function($item) { return Category::createFromDb($item); }, $categories);
    }
}