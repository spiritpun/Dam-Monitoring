<?php
/**
 * Created by IntelliJ IDEA.
 * User: keittirats
 * Date: 4/3/2018 AD
 * Time: 16:40
 */

namespace App\Http\Controllers;

class ApiUserController extends Controller
{

  public function getUserList() {
    $page = request('page', 1);
    $limit = request('limit', 20);

    $response = $this->NdsAPI->get("/rest/user/list?page={$page}&limit={$limit}");
    if (!$response) {
      return ['Error'];
    }

    return $response;
  }

  public function putUserStatus() {
    $userId = request('userId', '');
    $status = request('status', true);

    $response = $this->NdsAPI->put('/rest/user/status', [
        'userId' => $userId,
        'status' => $status,
    ]);

    if (!$response) {
      return ['Error'];
    }

    $response['userId'] = $userId;
    $response['status'] = $status;

    return $response;
  }

  public function postCreateUser() {
    $name = request('name', '');
    $surname = request('surname', '');
    $email = request('email', '');
    $password = request('password', '');
    $level = request('level', 'user_office');

    $response = $this->NdsAPI->post('/rest/user/create', [
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
        'password' => $password,
        'level' => $level,
    ]);

    if (!$response) {
      return ['Error'];
    }

    return $response;
  }

  public function putChangePassword() {
    $currentPassword = request('currentPassword', '');
    $newPassword = request('newPassword', '');
    $repeatPassword = request('repeatPassword', '');
    if ((empty($currentPassword) || empty($newPassword) || empty($repeatPassword)) || ($newPassword !== $repeatPassword)) {
      return response(array(
        'code'       => 500,
        'statusText' => 'error',
        'message'    => 'ข้อมูลไม่ถูกต้อง กรุณาทำใหม่อีกครั้ง'
      ), 500);
    }

    $response = $this->NdsAPI->post('/rest/profile/changepassword', [
      'currentPassword' => $currentPassword,
      'newPassword' => $newPassword,
      'repeatPassword' => $repeatPassword
    ]);

    if (!$response) {
      return response(['Error'], 500);
    }

    return response($response, $response['code']);
  }
}
