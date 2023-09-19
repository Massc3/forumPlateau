<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class CategoryManager extends Manager
{

    protected $className = "Model\Entities\Category";
    protected $tableName = "category";


    public function __construct()
    {
        parent::connect();
    }

    public function updateCategory()
    {
        $dao = new DAO();

        $sql = "UPDATE category
        SET nameCateogry = :newNameCateogry
        WHERE id_category = :id_category";
        // "newnameCateogry" doit être identique à :newnameCateogry

    }

    // // fonction qui permet de supprimer uune category
    // public function deleteCategory($id)
    // {
    //     $sql = "DELETE *
    //     FROM $this->tableName c 
    //     WHERE c.id_category $this->tableName c  = :id";

    //     return DAO::delete($sql, ['id' => $id]);
    // }
}
