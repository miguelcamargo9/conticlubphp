<?php

namespace App\Http\Controllers\API;

use App\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;
use Response;
use \Laravel\Passport\Http\Controllers\AccessTokenController as
ATC;

class AccessTokenController extends ATC {

  public function issueToken(ServerRequestInterface $request) {
    try {
      
      //dd($request->getParsedBody());
      $username = $request->getParsedBody()['username'];
      $password = ($request->getParsedBody()['password']);
      //get user
      //change to 'email' if you want
      $user = User::where([['identification_number', $username],["state","1"]])->with("profile.profilesMenus.menu")->with("subsidiary.city")->first();
      if ($user!=null && !empty($user)){
        if(!password_verify($password, $user['password'])){
          return ["message" => "Credenciales incorrectas"];
        }
      }else{
        return ["message" => "Usuario no registrado o inactivo"];
      }
      //generate token
      $tokenResponse = parent::issueToken($request);

      //convert response to json string
      $content = $tokenResponse->getContent();

      //convert json to array
      $data = json_decode($content, true);
      
      if (isset($data["error"]))
        return ["message" => "Credenciales incorrectas"];

      //add access token to user
      $user = collect($user);
      $user->put('access_token', $data['access_token']);
      //if you need to send out token_type, expires_in and refresh_token in the response body uncomment following lines
       $user->put('token_type', $data['token_type']);
       $user->put('expires_in', $data['expires_in']);
      // $user->put('refresh_token', $data['refresh_token']);

      return Response::json(array($user));
    } catch (ModelNotFoundException $e) { // email not found
      //return error message
      return response(["message" => "User not found"], 500);
    } catch (OAuthServerException $e) { //password not correct..token not granted
      //return error message
      return response(["message" => "The user credentials were incorrect.', 6, 'invalid_credentials"], 500);
    } catch (Exception $e) {
      ////return error message
      return response(["message" => "Internal server error ->$e"], 500);
    }
  }

}
