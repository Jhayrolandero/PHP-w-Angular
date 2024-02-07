<?php

require_once __DIR__ . "/../model/User.model.php";

/**
 * 
 * User Controller Class
 * 
 * Used for communicating with model
 */
class UserController extends User
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
    public function getRecords($tableName, $condition = null)
    {
        return parent::getRecords($tableName, $condition);
    }

    /**
     * @param array $data
     *  Accept json data for POST  
     * 
     * @return array
     *  return payload object containing information about response
     */
    public function addRecord($tableName, $data)
    {
        return 
    }
}
