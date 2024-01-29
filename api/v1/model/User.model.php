<?php

class User
{
    protected function users()
    {
        return json_encode(
            array(
                "Name" => "Negawhut???",
                "Age" => "68",
                "Gender" => "Non-ternary"
            )
        );
    }
}
