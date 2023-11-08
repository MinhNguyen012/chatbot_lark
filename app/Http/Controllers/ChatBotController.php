<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as RequestGuzz;
use GuzzleHttp\Psr7\Stream;
use GuzzleHttp\Psr7\stream_for;


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
                'Authorization' => 'Bearer t-g205b82UX4CG6QIS3UGXCUFCY45XLR3CWWJZLUIL',
                
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function sendmessageToGroup(Request $request) {
        $client = new Client();
        switch($request->msg_type){
            case("text"): 
                $data =  '{"text":' . '"' . $request->content . '"' .'}';
        
                $response = $client->request('POST', 'https://open.larksuite.com/open-apis/im/v1/messages', [
                    'headers' => [
                        //dạng của author : "Bearer token_tenant" đổi nó bằng tenant token được lấy ở function getTenantAccessToken
                        'Authorization' => 'Bearer t-g205b88bYB4453JF4ZYCTET6ZLRZNFQEZCWG4CAC',
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
                        "content" => stripslashes($data),
                    ]
                ]);
        
                return json_decode($response->getBody(), true);
                break;
            case("interactive"): 
                    // data test for postman:  {\"config\":{\"wide_screen_mode\":true},\"header\":{\"title\":{\"tag\":\"plain_text\",\"content\":\"A leave request requires your approval\"}},\"elements\":[{\"tag\":\"div\",\"fields\":[{\"is_short\":true,\"text\":{\"tag\":\"lark_md\",\"content\":\"**Applicant**\\nWang Xiaolei\"}},{\"is_short\":true,\"text\":{\"tag\":\"lark_md\",\"content\":\"**Leave type:**\\nAnnual leave\"}},{\"is_short\":false,\"text\":{\"tag\":\"lark_md\",\"content\":\"\"}},{\"is_short\":false,\"text\":{\"tag\":\"lark_md\",\"content\":\"**Time:**\\nApril 8, 2020 to April 10, 2020 (3 days)\"}},{\"is_short\":false,\"text\":{\"tag\":\"lark_md\",\"content\":\"\"}},{\"is_short\":true,\"text\":{\"tag\":\"lark_md\",\"content\":\"**Notes**\\nReturn to hometown for a family emergency\"}}]},{\"tag\":\"hr\"},{\"tag\":\"action\",\"layout\":\"bisected\",\"actions\":[{\"tag\":\"button\",\"text\":{\"tag\":\"plain_text\",\"content\":\"Approve\"},\"type\":\"primary\",\"value\":{\"chosen\":\"approve\"}},{\"tag\":\"button\",\"text\":{\"tag\":\"plain_text\",\"content\":\"Reject\"},\"type\":\"primary\",\"value\":{\"chosen\":\"decline\"}}]}]}
                    $data =  $request->content;
                    $response = $client->request('POST', 'https://open.larksuite.com/open-apis/im/v1/messages', [
                        'headers' => [
                            //dạng của author : "Bearer token_tenant" đổi nó bằng tenant token được lấy ở function getTenantAccessToken
                            'Authorization' => 'Bearer t-g205b88bYB4453JF4ZYCTET6ZLRZNFQEZCWG4CAC',
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
                            "content" => stripslashes($data),
                        ]
                    ]);
            
                    return json_decode($response->getBody(), true);
                    break;

            default: 
                return json_encode(["messenger" => "Khong co case phu hop"]);
                break;
        }
    }

    public function getView() {
        return view('chatbot');
    }
}
