<?php
/**
 * Created by PhpStorm.
 * User: keittirat
 * Date: 2/3/2561
 * Time: 22:42 น.
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Library\NdsAPI as NdsInstanceAPI;
use App\Http\Library\NdsAuth;

class RduController extends Controller
{
  public function loginPage() {
    return view('login');
  }

  public function doLogin(Request $req) {
    $input = $req->only(['email', 'password']);
    $response = $this->NdsAPI->post('/api/login', $input);

    if (!$response) {
      return redirect()->action('RduController@loginPage')->with('error', 'ไม่สามารถล๊อคอินเข้าระบบ กรุณาตรวจสอบข้อมูล');
    }

    NdsAuth::setCookie($response);
    return redirect('dashboard');
  }

  public function doLogout()
  {
    NdsAuth::revokeCookie();
    return redirect('/')->with('success', 'ออกจากการใช้งานแล้ว');
  }

  // React Page with Hash Version
  public function reactPage() {
    $hash = trim(exec('git log --pretty="%h" -n1 HEAD'));
    return view('react', [ 'hash' => $hash ]);
  }
}
