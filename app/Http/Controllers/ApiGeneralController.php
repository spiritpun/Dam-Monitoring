<?php
/**
 * Created by IntelliJ IDEA.
 * User: keittirats
 * Date: 4/3/2018 AD
 * Time: 16:40
 */

namespace App\Http\Controllers;

class ApiGeneralController extends Controller
{
  public function getStat() {
    return [
      'systemStat' => $this->getSystemStat(),
      'surveyStat' => $this->getSurveyStat()
    ];
  }

  public function getAnswerSheetList() {
    $page = request('page', 1);
    $templateID = request('templateID', '');
    $provinceID = request('provinceID', -1);

    $response = $this->NdsAPI->get("/rest/answer/list?page={$page}&templateID={$templateID}&provinceID={$provinceID}");
    if (!$response) {
      return ['Error'];
    }

    $response['template_id'] = $templateID;
    $response['province_id'] = $provinceID;
    return $response;
  }

  // ---- Private Method

  private function getSystemStat() {
    $response = $this->NdsAPI->get('/rest/info/stat');
    if (!$response) {
      return ['Error'];
    }

    return $response;
  }

  private function getSurveyStat() {
    $page = request('page', 1);
    $limit = request('limit', 20);
    $response = $this->NdsAPI->get("/rest/survey/list?page={$page}&limit={$limit}");
    if (!$response) {
      return ['Error'];
    }

    return $response;
  }
}
