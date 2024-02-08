<?php

require_once __DIR__ . "/../model/Model.php";

/**
 * 
 * User Controller Class
 * 
 * Used for communicating with user model
 */
class Controller extends Model
{
    /**
     * @param string $tablename
     *  name of table to be queried
     *  
     * @param string $condition
     *  condition for query
     * 
     * @return array
     *  return payload object containing information about response
     */
    public function findAll($tableName, $condition = null)
    {
        return parent::findAll($tableName, $condition);
    }

    /**
     * @param array $data
     *  Accept json data for POST  
     * 
     * @return array
     *  return payload object containing information about response
     */
    //     public function addRecord($tableName, $data)
    //     {
    //         return 
    //     }
    // }
    public function save($request)
    {
        return;
    }
}
