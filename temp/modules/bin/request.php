<?php


class HttpRequest
{
    private array $post;
    private array $get;

    public function __construct()
    {
        $this->post = array();
        $this->get = array();
        $this->post = array_merge($this->post, $_POST);
        $this->get = array_merge($this->get, $_GET);
    }

    public function getParam($key): string
    {
        $param = $this->controlRequest();
        if (!array_key_exists($key, $param)) {
            return 'UNDEFINED KEY ERROR';
        }
        return $param[$key];
    }

    private function controlRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->formatageGet();
            return $this->get;
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->post;
        }
    }

    private function formatageGet()
    {
        if (gettype($_GET['url']) === 'array') {
            $content = $_GET['url'];
            $param = $content[1];
            if (strpos($param, '&')) {
                $param = explode('&', $param);
                foreach ($param as $value) {
                    $element = $this->create_array($value, '=');
                    $this->get[$element[0]] = $element[1];
                }
            } else {

                $param = $this->create_array($param, '=');
                $this->get[$param[0]] = $param[1];
            }
        }
    }

    private function create_array($str, $element)
    {
        $i_index = strpos($str, $element);
        $result = array(substr($str, 0, $i_index));
        if ($i_index + 1 < strlen($str)) {
            array_push($result, substr($str, $i_index + 1));
        }
        return $result;
    }
}
