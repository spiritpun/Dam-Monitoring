<?php
/**
 * Created by IntelliJ IDEA.
 * User: keittirats
 * Date: 4/3/2018 AD
 * Time: 16:40
 */

namespace App\Http\Controllers;

class ApiAddressController extends Controller
{
  public function getAmphur() {
    $provinceId = request('provinceID');
    $response = $this->NdsAPI->get("/rest/address/amphur?provinceID={$provinceId}");
    if (!$response) {
      return ['Error'];
    }

    return [
      'province_id' => (int) $provinceId,
      'data' => $response
    ];
  }

  public function getDistrict() {
    $amphurId = request('amphurID');
    $response = $this->NdsAPI->get("/rest/address/district?amphurID={$amphurId}");
    if (!$response) {
      return ['Error'];
    }

    return [
      'amphur_id' => (int) $amphurId,
      'data' => $response
    ];
  }
}
