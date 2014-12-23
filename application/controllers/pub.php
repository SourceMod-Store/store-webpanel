<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pub extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //$this->load->model('redeem_model');
        $this->load->helper('url');
    }

    function redeem()
    {
        $data[''] = '';
        $this->load->view('pages/redeem/redeem_code', $data);
    }

    function redeem_process()
    {
        $this->load->model('users_model');
        $this->load->model('redeem_model');
        $data[''] = '';
        $error_num = 0;
        $error_string = array();
        $data['credits'] = 0;
        $data['items'] = 0;

        $post = $this->input->post();
        $code = $post['code'];
        $code_data = $this->redeem_model->get_code($code);
        $auth = $this->users_model->steamid_to_auth($post['steamid']);

        //Check for errors & generate the error string
        //Check if the user exists in the DB
        $store_userid = $this->users_model->get_storeuserid($auth);

        if ($store_userid == NULL)
        {
            $error_num += 1;
            $error_string[] = 'The user doesnt exist in the DB';
        }

        //Check if code is valid
        if ($code_data != NULL && $error_num == 0)
        {
            //Check if the code is expired
            if ($code_data['expire_time'] > time())
            {
                $error_num += 1;
                $error_string[] = 'The code you want to use is expired';
            }

            //Check if the number of redeem times is limited; Only run if no errors are detected
            if ($code_data['redeem_times_total'] != 0 && $code_data['redeem_times_total'] != NULL && $error_num == 0)
            {
                $times_total = $this->redeem_model->get_redeemed_times_total($code);
                //echo "times_total:".$times_total.";";
                if ($times_total >= $code_data['redeem_times_total'])
                {
                    $error_num += 1;
                    $error_string[] = 'The code you want to use has been used to often';
                }
            }

            //Check if the number of times a single user can redeem a code is limited
            if ($code_data['redeem_times_user'] != 0 && $code_data['redeem_times_user'] != NULL && $error_num == 0)
            {
                $times_user = $this->redeem_model->get_redeemed_times_user($code, $auth);
                //echo "times_user:".$times_user.";";
                if ($times_user >= $code_data['redeem_times_user'])
                {
                    $error_num += 1;
                    $error_string[] = 'You have used this code too often';
                }
            }

            $credits = $code_data['credits'];
            $item_array = explode(',', $code_data['itemids']);
        }
        else
        {
            if ($code_data == NULL)
            {
                $error_num += 1; //Add error count;
                $error_string[] = 'This code doesnt exist';
            }
        }

        //Check if no errors have been found
        if ($error_num == 0)
        {
            $this->redeem_model->add_log($code, $auth);

            if ($credits != 0 && $credits != NULL)
            {
                $this->users_model->add_credits($store_userid, $credits);
                $data["credits"] = $credits;
            }

            if ($item_array != 0 && $item_array != NULL)
            {
                $itemnames = array();
                $this->load->model('items_model');
                foreach ($item_array as $item)
                {
                    $item_info = NULL;
                    $item_info = $this->items_model->get_item_info($item);

                    if ($item_info != NULL)
                    {
                        $this->items_model->add_useritem($store_userid, $item);
                        $itemnames[] = $item_info['display_name'];
                    }
                    else
                    {
                        $error_string[] = "Item with id ".$item." could not be redeemed because it doesnt exist";
                    }
                }
                $data["items"] = $itemnames;
            }
            $data['status'] = "success";
            $data['errors'] = $error_string;
            $this->load->view('pages/redeem/redeem_code_process', $data);
        }
        else
        {
            $data['status'] = "error";
            $data['errors'] = $error_string;
            $this->load->view('pages/redeem/redeem_code_process', $data);
        }
    }

    function refresh_img()
    {
        $path_to_cache = BASEPATH . "../assets/img/id_cache/";
        $error_image = base_url("/assets/img/id_cache/avatar.jpg");
        $steam_id = $_POST["sendValue"];
        $friend_id = $this->GetFriendID($steam_id);
        if ($friend_id != 0)
        {
            $url = "http://steamcommunity.com/profiles/" . $friend_id . "?xml=1";
            $xml = @simplexml_load_string(file_get_contents($url));
            $avatar_url = $xml->avatarMedium;
            $player_name = $xml->steamID;
            file_put_contents($path_to_cache . $friend_id . ".jpg", file_get_contents($avatar_url));
            file_put_contents($path_to_cache . $friend_id . ".txt", $player_name);
        }
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
        if (!isset($friend_id) || $friend_id == 0)
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

    function bot_process()
    {
        //Status:
        //0: New Item
        //10: Item being processed
        //20: No Itemvalue associated
        //30: User doesnt exist
        //99: Credits awarded
        $this->load->model('users_model');
        $this->load->model('bot_model');

        //Get all outstanding donations from the db
        $DB_Main = $this->load->database('default', TRUE);
        $query_botdonations = $DB_Main->get('bot_donations');

        //*LOOP*
        foreach ($query_botdonations->result() as $botdonation)
        {
            //Check if the donation has the status 1 with a new query
            $item_status = $this->bot_model->get_donationstatus($botdonation->id);
            if ($item_status == 0)
            {
                //Set the donation status to 10
                $this->bot_model->set_donationstatus($botdonation->id, 10);

                //Check if the use who donated the item exists --> If not set status to 30    
                $auth = $this->users_model->steamid_to_auth(communityid_to_steam($botdonation->steamId));
                $user_id = $this->users_model->get_userid_by_auth($auth);
                if ($user_id != false)
                {
                    //Get the itemvalue for the donation
                    $itemvalue = $this->bot_model->get_itemvalue($botdonation->itemId);

                    if ($itemvalue != false)
                    {
                        //Award the credits to the user
                        $this->users_model->add_credits($user_id, $itemvalue);

                        //Set the status to 99
                        $this->bot_model->set_donationstatus($botdonation->id, 99);
                    }
                    else
                    {
                        //No Value associated with the item
                        $this->bot_model->set_donationstatus($botdonation->id, 20);
                    }
                }
                else
                {
                    //User doesnt exit
                    $this->bot_model->set_donationstatus($botdonation->id, 30);
                }
            }
        }
        //*END LOOP*
    }

}

/* End of file pub.php */
/* Location: ./application/controllers/pub.php */