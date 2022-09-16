<?php
    class Response{
        function Response_data($code, $resp)
        {
            http_response_code($code);
            return json_encode($resp, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        }
    }
?>