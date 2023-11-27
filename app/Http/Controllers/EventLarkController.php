<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\Request;

class EventLarkController extends Controller
{
    //

    public function callback_lark(Request $request)
{
    $jsonData = $request->getContent();
    $random = rand(1,1000);
    $dataCreate = [
        'username' => "MinhNguyen".$random,
        'active' => 1,
        'force_pass_reset' => 0,
        'phone' => $random,
        'id_lark' => $random.$random,
        'owner' => 1,
        'custom_fields' => $jsonData,
        'email' => "minh".$random . "@gmail.com",
        'created_by' =>  1
    ];
    $user = new User();

    $user->create($dataCreate);
    return true;

    // $data = json_decode($jsonData, true);

    // if (!isset($data['encrypt'])) {
    //     return response()->json(['error' => 'Encrypt data not found.'], 400);
    // }

    // $encrypt_data = $data['encrypt'];
    // $encrypt_key = "spOTxHmwweZEqCj4lrvqEdn0PRsjE5tY"; 

    // $base64_decode_message = base64_decode($encrypt_data);

    // if ($base64_decode_message === false) {
    //     return response()->json(['error' => 'Error decoding base64.'], 400);
    // }

    // $iv = substr($base64_decode_message, 0, 16);
    // $encrypted_event = substr($base64_decode_message, 16);
    // dd([
    //     'iv' => base64_encode($iv),
    //     'encrypted_event' => base64_encode($encrypted_event),
    //     'encrypt_key' => $encrypt_key,
    // ]);

    // try {
    //     $decrypt = openssl_decrypt(base64_encode($encrypted_event), 'AES-256-CBC', hash('sha256', base64_encode($encrypt_key), true), OPENSSL_RAW_DATA, $iv);
    // }catch(Error $er) {
    //     return $er;
    // }

    // if ($decrypt === false) {
    //     return response()->json(['error' => 'Error decrypting data.'], 400);
    // }

    // return response()->json([
    //     'challenge' => $decrypt
    // ]);
}

}
