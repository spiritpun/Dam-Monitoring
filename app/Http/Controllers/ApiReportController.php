<?php
/**
 * Created by IntelliJ IDEA.
 * User: keittirats
 * Date: 4/3/2018 AD
 * Time: 16:40
 */

namespace App\Http\Controllers;

class ApiReportController extends Controller
{

  public function getPercent() {
    $surveyId = request('surveyId');
    $province = request('province', -1);
    $amphur = request('amphur', -1);
    $district = request('district', -1);

    $response = $this->NdsAPI->get("/rest/report/percent/{$surveyId}?province={$province}&amphur={$amphur}&district={$district}");
    if (!$response) {
      return ['Error'];
    }

    unset($response['reportPercent']);
    if (!empty($response['percentage'])) {
      $response['percentage'] = config('endpoint.report_service') . '/percentage/' . $response['percentage'];
    }

    if (!empty($response['report'])) {
      $response['report'] = config('endpoint.report_service') . '/raws/' . $response['report'];
    }

    return $response;
  }

  public function getRaws() {
    $surveyId = request('template_id');
    $response = $this->NdsAPI->get("/rest/report/generated/raws?template_id={$surveyId}");
    if (!$response) {
      return ['Error'];
    }

    return [
      'surveyId' => $surveyId,
      'report' => array_map(function($item) use ($response) {
        return [
          'province' => (int) $item['province'],
          'report' => $item['report'],
          'link' => $response['baseUrl'] . 'raws/' . $item['report']
        ];
      }, $response['rawsList'])
    ];
  }
}
