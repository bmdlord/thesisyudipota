<?php
use backend\core\Database;

class Chat {
    function __construct() {
        session();

        if(@!get_session('isLogin')) {
            address('login');
        }
    }

    function get() {
        return panel_view('chat');
    }

    function thread() {
        $condition = 'patient=' . get('patient') . ' AND doctor=' . get('doctor');
        $get_chat_session = (new Database())->select('chat_id', $condition);

        if(sizeof($get_chat_session) <= 0) {
            $create_id = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
            $concat = '';

            for($i = 0; $i <= 50; $i++) {
                $concat .= $create_id[array_rand($create_id)]; 
            }

            $chat_id = $concat;

            $data = array(
                'conversation_id' => $chat_id,
                'patient' => get('patient'),
                'doctor' => get('doctor')
            );

            (new Database())->insert('chat_id', $data);

            set_data(array(
                'conversation_id' => $chat_id
            ));
        } else {
            set_data(array(
                'conversation_id' => $get_chat_session['0']['conversation_id']
            ));
        }

        return panel_view('thread');
    }

    function send() {
        $chat_id = post('chat_id');
        $user = post('user');
        $chat = post('chat');

        $data = array(
            'chat_id' => $chat_id,
            'conversation' => $chat,
            'user' => $user
        );

        (new Database())->insert('conversation', $data);

        address('chat/thread?doctor=' . get('doctor') . '&patient=' . get('patient'));
    }

    function read() {
        $chat_id = get('chat_id');
        $get_convo = (new Database())->select('conversation', 'chat_id="' . $chat_id . '"');
    
        if(sizeof($get_convo) > 0) {
            foreach($get_convo as $key) {
                if($key['user'] == get_session('level')) {
                    $show = <<<EOF
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>{$key['conversation']}</p>
                        </div>
                    </div>
EOF;
                    print($show);
                } else {
                    $show = <<<EOF
                    <div class="incoming_msg">
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>{$key['conversation']}</p>
                            </div>
                        </div>
                    </div>
EOF;
                    print($show);
                }
            }
        }
    }
}