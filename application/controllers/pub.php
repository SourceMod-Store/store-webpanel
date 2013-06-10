<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pub extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('redeem_model');
        $this->load->helper('url');
    }

    function redeem()
    {
        $data[''] = '';
        $this->load->view('pages/redeem/redeem_code', $data);
    }

    function redeem_process()
    {
        $data[''] = '';
        $error_num = 0;
        $error_string = 'Error String: \n';
        $post = $this->input->post();
        $code = $post['code'];
        print_r($post);
        $this->load->model('users_model');
        $auth = $this->users_model->steamid_to_auth($post['steamid']);

        $code_data = $this->redeem_model->get_code($code);
        //Check for errors & generate the error string
        //Check if a valid code
        if ($code_data != 0)
        {
            //Check if the code is expired
            if ($code_data['expire_time'] > time())
            {
                $error_num += 1;
                $error_string += 'The code you want to use is expired\n';
                echo 1;
            }

            //Check if the number of redeem times is limited; Only run if no errors are detected
            if ($code_data['redeem_times_total'] != 0 && $error_num == 0)
            {
                if ($this->redeem_model->get_redeemed_times_total($code) >= $code_data['redeem_times_total'])
                {
                    $error_num += 1;
                    $error_string += 'The code you want to use has been used to often\n';
                    echo 2;
                }
            }

            //Check if the number of times a single user can redeem a code is limited
            if ($code_data['redeem_times_user'] != 0 && $error_num == 0)
            {
                if ($this->redeem_model->get_redeemed_times_user($code, $auth) >= $code_data['redeem_times_user'])
                {
                    $error_num += 1;
                    $error_string += 'You have used this code to often\n';
                    echo 3;
                }
            }

            $credits = $code_data['credits'];
            $item_array = explode(',', $code_data['itemids']);
            echo 4;
        }
        else
        {
            $error_num += 1; //Add error count;
            $error_string += 'This code doesnt exist\n';
            echo 5;
        }

        //Check if no errors have been found
        if ($error_num != 0)
        {
            echo 6;
            $user_id = $this->users_model->get_storeuserid($auth);

            if ($credits != 0)
            {
                $this->users_model->add_credits($user_id, $credits);
                echo 7;
            }

            if ($item_array != 0)
            {
                $this->load->model('items_model');
                foreach ($item_array as $item)
                {
                    $this->items_model->add_useritem($user_id, $item);
                    echo 8;
                }
            }
            $data['status'] = "Successfully processed the code";
        }
        else
        {
            echo 9;
            $data['status'] = nl2br($error_string);
        }
        
        echo $error_string;

        $this->load->view('pages/redeem/redeem_code_process', $data);
    }

    function refresh_img()
    {
        $path_to_cache = BASEPATH . "../assets/img/id_cache/";
        $error_image = base_url("/assets/img/id_cache/avatar.jpg");
        $steam_id = $_POST["sendValue"];
        $friend_id = $this->GetFriendID($steam_id);


        $url = "http://steamcommunity.com/profiles/" . $friend_id . "?xml=1";
        $xml = @simplexml_load_string(file_get_contents($url));
        $avatar_url = $xml->avatarMedium;
        $player_name = $xml->steamID;
        file_put_contents($path_to_cache . $friend_id . ".jpg", file_get_contents($avatar_url));
        file_put_contents($path_to_cache . $friend_id . ".txt", $player_name);
    }

    function get_img()
    {
        $path_to_cache = BASEPATH . "../assets/img/id_cache/";
        $error_image = base_url("/assets/img/id_cache/avatar.jpg");
        $steam_id = $_POST["sendValue"];
        $friend_id = $this->GetFriendID($steam_id);
        $pos = strpos($friend_id, ".");
        if ($pos !== false)
        {
            $friend_id = substr($friend_id, 0, $pos);
        }
        //echo $friend_id;
        $player_url = "http://steamcommunity.com/profiles/" . $friend_id . "";
        if (!isset($friend_id))
        {
            echo json_encode(array("returnValue" => '' . $error_image . ''));
            exit;
        }

        if (file_exists($path_to_cache . $friend_id . ".jpg"))
        {
            $avatar_url = base_url("/assets/img/id_cache/" . $friend_id . ".jpg");
            $player_name = file_get_contents($path_to_cache . $friend_id . ".txt");
        }
        else
        {
            $url = "http://steamcommunity.com/profiles/" . $friend_id . "?xml=1";
            //echo $url;
            $xml = simplexml_load_string(file_get_contents($url));
            $avatar_url = $xml->avatarMedium;
            //echo $avatar_url;
            $player_name = $xml->steamID;
            //echo $avatar_url;
            //echo $player_name;
            file_put_contents($path_to_cache . $friend_id . ".jpg", file_get_contents($avatar_url));
            file_put_contents($path_to_cache . $friend_id . ".txt", $player_name);
        }

        echo json_encode(array(
            "returnValue" => '' . $avatar_url . '',
            "player_url" => '' . $player_url . '',
            "playerName" => '' . $player_name . ''
        ));
    }

    function GetFriendID($pszAuthID)
    {

        $iServer = "0";
        $iAuthID = "0";

        $szAuthID = $pszAuthID;

        $szTmp = strtok($szAuthID, ":");

        while (($szTmp = strtok(":")) !== false)
        {
            $szTmp2 = strtok(":");

            if ($szTmp2 !== false)
            {
                $iServer = $szTmp;
                $iAuthID = $szTmp2;
            }
        }
        if ($iAuthID == "0")
            return "0";

        $i64friendID = bcmul($iAuthID, "2");

        //Friend ID's with even numbers are the 0 auth server.
        //Friend ID's with odd numbers are the 1 auth server.
        $i64friendID = bcadd($i64friendID, bcadd("76561197960265728", $iServer));

        return $i64friendID;
    }

    function test_redeem()
    {
        //$this->load->view('pages/redeem/test_code');
    }

}

/* End of file pub.php */
/* Location: ./application/controllers/pub.php */