<?php

namespace Modules\Authentication\Foundation;

use Illuminate\Support\MessageBag;
use Carbon\Carbon;
use Exception;
use Auth;

trait CharityAuthentication
{

  public static function authentication($credentials)
  {
      // LOGIN BY : Mobile & Password
      if(is_numeric($credentials->email)):

          $auth = Auth::attempt([
                'mobile'     => $credentials->email,
                'password'   => $credentials->password
            ],  $credentials->has('remember')
          );

        // LOGIN BY : Email & Password
      elseif(filter_var($credentials->email, FILTER_VALIDATE_EMAIL)):

          $auth = Auth::attempt([
              'email'     => $credentials->email,
              'password'  => $credentials->password
            ],
            $credentials->has('remember')
          );

      endif;

      return $auth;
  }

  public function login($credentials)
  {
      try {

          if (self::authentication($credentials))
          {
                if(self::checkCharity()){
                    return false;
                }
          }

          $errors = new MessageBag([
            'password' => __('authentication::dashboard.login.validations.failed')
          ]);

          return $errors;

      } catch (Exception $e) {

          return $e;

      }
  }

  static function checkCharity()
  {
      $user = auth()->user();

      if($user && $user->charity && $user->charity->status == 1){
          return true;
      }else{
          auth()->logout();
          return false;
      }
  }

  public function loginAfterRegister($credentials)
  {
      try {

          self::authentication($credentials);

      } catch (Exception $e) {

        return $e;

      }
  }

  public function generateToken($user)
  {
      $tokenResult = $user->createToken('Personal Access Token');

      $token = $tokenResult->token;

      $token->save();

      return $tokenResult;
  }

  public function tokenExpiresAt($token)
  {
      return Carbon::parse($token->token->expires_at)->toDateTimeString();
  }

}
