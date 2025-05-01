<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiauthController extends Controller
{
    // Verifies user and provides access token for API authorization
    public function login( Request $request ) {

        $validated_login_data = $this->validate_user($request);

        //Authentication check
        if ( auth()->attempt( $validated_login_data ) ) {
            $accessToken = auth()->user()->createToken( 'authToken' )->accessToken;
            return response( ['accessToken'=>$accessToken] );
        }

        //Upon authentication failure
        return response( ['message'=>'Invalid Credentials'],401);
    }

    //Validate obtained information
    private function validate_user($request){
        $validated=$request->validate( [
            'email'=>'required|email',
            'password'=>'required'
        ] );
        return $validated;
    }
}
