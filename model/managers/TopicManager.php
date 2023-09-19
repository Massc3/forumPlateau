<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager
{

    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";


    public function __construct()
    {
        parent::connect();
    }

    public function findTopicByCategoryId($id)
    {

        $sql = "SELECT *
                    FROM " . $this->tableName . " t
                    WHERE t.category_id = :id
                    ";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function update($data)
    {
        $sql = " UPDATE " .  $this->tableName . "
        SET title = :newTitle
        WHERE id_" . $this->tableName . " = :id;";

        try {
            return DAO::update($sql, $data);
        } catch (\Throwable $th) {
        }

        // "topic" doit être identique à :topic
    }
}
