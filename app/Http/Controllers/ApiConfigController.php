<?php
/**
 * Created by PhpStorm.
 * User: keitt
 * Date: 3/11/2018
 * Time: 2:08 AM
 */

namespace App\Http\Controllers;


class ApiConfigController extends Controller
{
  public function getConfig() {
    $hash = trim(exec('git log --pretty="%h" -n1 HEAD'));
    // $response = $this->NdsAPI->get('/rest/address/province');
    // if (!$response) {
    //   return response()->json('Error', 503);
    // }

    return [
      'version' => $hash,
      'user' => $this->getCurrentUser(),
      // 'province' => $response
    ];
  }

  public function getCurrentUser() {
    $response = $this->NdsAPI->get('/rest/profile/me');
    if (!$response) {
      return response()->json('Error', 503);
    }

    return $response;
  }
}
