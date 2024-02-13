<?php

require_once __DIR__ . "/../../../config/Database.php";

class Model extends Database
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

    protected function findAll($tableName, $condition)
    {

        $sql = "SELECT * FROM $tableName";

        if ($condition != null) {
            $sql .= " WHERE " . $condition;
        }

        $result = $this->execSQL($sql);

        if ($result["code"] == 200) {
            return $this->sendPayload($result['data'], 'success', "Successfully retrieve data", $result['code']);
        }

        return $this->sendPayload(null, 'failed', $result['message'], $result['code']);
    }

    protected function addRecord($tableName, $column) {

        
    }


    /**
     * @param string $sqlSTMT
     * 
     * Query string for fetch
     * 
     * @return array<string, mixed>
     *  return ["code", "errmsg"] || return ["code", "data"]
     */

    private function execSQL($sqlSTMT)
    {
        $data = [];
        $errmsg = "";
        $code = 0;

        try {
            $stmt = $this->connect()->prepare($sqlSTMT);

            if ($stmt->execute()) {
                $results = $stmt->fetchAll();

                foreach ($results as $result) {
                    array_push($data, $result);
                }

                $code = 200;
                $results = null;
                return ["code" => $code, "data" => $data];
            } else {
                $errmsg = "No data found";
                $code = 404;
            }
        } catch (PDOException $e) {
            $errmsg = $e->getMessage();
            $code = 404;
        }

        return ["code" => $code, "message" => $errmsg];
    }

    /**
     * 
     * @param string $data
     *  queried Data
     * @param string $remarks
     *  Either success or not
     * @param string $message
     *  status message
     * @param string $code
     *  http_response code
     * @return [
     * "status" => $status,
     * "payload" => $data,
     * "timestamp => date_created()
     * ]
     * 
     *  return a payload object consisting of status object, payload data, and timestamp
     */
    private function sendPayload($data, $remarks, $message, $code)
    {
        $status = ["remarks" => $remarks, "message" => $message];
        http_response_code($code);
        return [
            "status" => $status,
            "payload" => $data,
            "timestamp" => date_create()
        ];
    }
}
