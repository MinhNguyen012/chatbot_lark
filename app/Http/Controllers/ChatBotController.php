<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{

    public function getTenantAccessToken(Request $request) {
        $client = new Client();
        $response = $client->request('POST', 'https://open.larksuite.com/open-apis/auth/v3/tenant_access_token/internal', [
            'json' => [
                'app_id' => $request->app_id,
                'app_secret' => $request->app_secret,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getAllChats() {
        $client = new Client();
        $response = $client->request('GET', 'https://open.larksuite.com/open-apis/im/v1/chats', [
            'headers' => [
                 //dạng của author : "Bearer token_tenant" đổi nó bằng tenant token được lấy ở function getTenantAccessToken
                'Authorization' => 'Bearer t-g205b7aaUVDAQBXQLCJ5L4A7QVOO5ZHO27AD5HXT',
                
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function sendmessageToGroup(Request $request) {
        $client = new Client();
        
        $response = $client->request('POST', 'https://open.larksuite.com/open-apis/im/v1/messages', [
            'headers' => [
                 //dạng của author : "Bearer token_tenant" đổi nó bằng tenant token được lấy ở function getTenantAccessToken
                'Authorization' => 'Bearer t-g205b7aaUVDAQBXQLCJ5L4A7QVOO5ZHO27AD5HXT',
                'Content-Type' => 'application/json; charset=utf-8',
            ],
            'query' => [
                // receive_id_type có thể là user_id, chat_id, open_id thay đổi tùy theo yêu cầu
                'receive_id_type' => 'chat_id',
            ],
            "json" => [
                // receive_id là token chat_id được lấy trong function getAllChats
                // msg_type có nhiều dạng như text, post, file 
                //content là nội dung của messenger truyền dưới dạng json
                "receive_id" => $request->receive_id,
                "msg_type" => $request->msg_type,
                "content" => $request->content,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }


}
