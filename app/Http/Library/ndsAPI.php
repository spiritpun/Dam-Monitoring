<?php

namespace App\Http\Library;
use App\Http\Library\NdsAuth;

class NdsAPI {
  private $credential = [];
  private $baseUrl = '';

  function __construct() {
    $this->credential = NdsAuth::getAPIToken();
    $this->baseUrl = config('endpoint.api_service');
  }

  public function get($url) {
    return $this->createGet($this->baseUrl . $url);
  }

  public function post($url, $param) {
    return $this->createRequest($this->baseUrl . $url, $param);
  }

  public function put($url, $param) {
    return $this->createRequest($this->baseUrl . $url, $param, 'PUT');
  }

  public function delete($url, $param) {
    return $this->createRequest($this->baseUrl . $url, $param, 'DELETE');
  }

  private function encodeToken() {
    return $this->credential ? $this->credential : 'NDSTryCatch';
  }

  private function createGet($url) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer " . $this->encodeToken(),
        "cache-control: no-cache"
      ),
    ));

    $response = curl_exec($curl);
    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err || $status_code !== 200) {
      return false;
    }

    return json_decode($response, true);
  }

  private function createRequest($url, $param, $method = 'POST') {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POSTFIELDS => json_encode($param),
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer " . $this->encodeToken(),
        "cache-control: no-cache",
        "content-type: application/json"
      ),
    ));

    $response = curl_exec($curl);
    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err || $status_code !== 200) {
      return false;
    }

    return json_decode($response, true);
  }
}
