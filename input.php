<?php

class input
{
    function post(string $name){
        $_POST = json_decode(file_get_contents('php://input'), true);
        return $_POST[$name]??null;
    }
    function get_attribute(string $name)
    {
        $lines = file('php://input');
        $keyLinePrefix = 'Content-Disposition: form-data; name="';

        $PUT = [];
        $findLineNum = null;

        foreach ($lines as $num => $line) {
            if (strpos($line, $keyLinePrefix) !== false) {
                if ($findLineNum)
                    break;
                if ($name !== substr($line, 38, -3))
                    continue;
                $findLineNum = $num;
            } else if ($findLineNum)
                $PUT[] = $line;
        }

        array_shift($PUT);
        array_pop($PUT);

        $data = mb_substr(implode('', $PUT), 0, -2, 'UTF-8');
        return $data !== '' ? $data : ($_POST[$name]??null);
    }
    public function put($parameter){
        parse_str(file_get_contents("php://input"),$post_vars);
        return $post_vars[$parameter]??null;
    }
}
