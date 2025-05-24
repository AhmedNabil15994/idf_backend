<?php

namespace Modules\Authentication\Foundation;

use Illuminate\Support\MessageBag;
use Carbon\Carbon;
use Exception;
use Auth;

trait DonorAuthentication
{
  public static function authentication($credentials)
  {
      // LOGIN BY : Mobile & Password
      if($credentials->email){
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
      }elseif($credentials->mobile || $credentials->phone || $credentials->register_phone){


        $auth = Auth::attempt([
                'mobile'     => ($credentials->mobile ?? $credentials->phone) ?? $credentials->register_phone,
                'password'   => $credentials->password
            ],  $credentials->has('remember')
        );
      }
     

      return $auth;
  }

  public function login($credentials)
  {
      try {
          if (self::authentication($credentials))
          {
                if(self::checkDonor()){
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

  static function checkDonor()
  {
      $user = auth()->user();

      if($user && $user->donor && $user->donor->status == 1){
          return true;
      }else{
          auth()->logout();
          return false;
      }
  }

  static function checkGuest()
  {
      if(auth()->check()){
          $user = auth()->user();
          if($user && $user->donor){
              return false;
          }
      }

      return true;
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
