<?php
/*
 *@name Fetch()
 *@desc this is a class to make pagination easy
 *@param $texta => text to be translated
 *@param $sprache => language to be tranalated into
 *@autor Anchora Technologies
 */
class Fetch
{
    private $output;
    private $headers;

    public function __construct($headers = [], $output = 'json')
    {
        $this->output = $output;
        $this->headers = $headers;
    }

    public function get($url, $params = [])
    {
        $ch = curl_init();
        $params = http_build_query($params);
        curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $result = curl_exec($ch);
        curl_close($ch);
        return $this->result($result);
    }

    public function post($url, $params = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $this->result($result);
    }

    public function put($url, $params = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        $result = curl_exec($ch);
        curl_close($ch);
        return $this->result($result);
    }

    public function delete($url, $params = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $result = curl_exec($ch);
        curl_close($ch);
        return $this->result($result);
    }

    private function result($result)
    {
        switch ($this->output) {
            default:
                return $result;
                break;

            case 'json':
                return json_decode($result, 1);
                break;
        }
    }

}
