<?php
/**
 * Created by IntelliJ IDEA.
 * User: keittirats
 * Date: 4/3/2018 AD
 * Time: 16:40
 */

namespace App\Http\Controllers;

class ApiSurveyController extends Controller
{
  public function getSurvey() {
    $templateId = request('templateID');
    $response = $this->NdsAPI->get("/rest/survey?templateID={$templateId}");
    if (!$response) {
      return ['Error'];
    }

    return $response;
  }
}
