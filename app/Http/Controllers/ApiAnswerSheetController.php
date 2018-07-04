<?php
/**
 * Created by IntelliJ IDEA.
 * User: keittirats
 * Date: 4/3/2018 AD
 * Time: 16:40
 */

namespace App\Http\Controllers;

class ApiAnswerSheetController extends Controller
{
  public function getAnswerSheet() {
    $answerId = request('answerID');
    $response = $this->NdsAPI->get("/rest/answer?answerID={$answerId}");
    if (!$response) {
      return ['Error'];
    }

    return $response;
  }

  public function postCreateAnswerSheet() {
    $answerSheet = request('answerSheet', []);

    $response = $this->NdsAPI->post("/rest/answer/create", $answerSheet);
    if (!$response) {
      return ['Error'];
    }

    return array_merge(
      $answerSheet,
      [
        '_id' => $response['id'],
        'ref_id' => $response['ref_id'],
        'full_ref_id' => $response['full_ref_id'],
        'updated_at' => date('Y-m-d H:i:s'),
      ]
    );
  }

  public function putUpdateAnswerSheet() {
    $answerSheet = request('answerSheet', []);

    $response = $this->NdsAPI->put("/rest/answer/update", $answerSheet);
    if (!$response) {
      return ['Error'];
    }

    return array_merge(
      $answerSheet,
      [
        '_id' => $response['id'],
        'updated_at' => date('Y-m-d H:i:s'),
      ]
    );
  }
}
