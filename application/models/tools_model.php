<?php

class Tools_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function check_json()
    {
        $this->load->model("items_model");
        $items_array = $this->items_model->get_items();
        echo "The following errors have been found: </br>";
        foreach ($items_array as $key => $item)
        {
            if (json_decode($item['attrs']) === null)
            {
                echo "Item " . $item["name"] . " with ID " . $item["id"] . " has a invalid attrs field </br>";
            }
            elseif ($this->input->post("show_correct") == "true")
            {
                echo "Item " . $item["name"] . " with ID " . $item["id"] . " has a valid attrs field </br>";
            }
			
			if ($item['attrs'] == null || trim($item['attrs']) == "" )
			{
				echo "Item " . $item["name"] . " with ID " . $item["id"] . " does not have a filled out attrs field </br>";
			}
        }
    }

    function get_stable_version() //Get current stable version
    {
        $version = json_decode(file_get_contents("http://sourcedonates.com/store-webpanel/webpanel_version.json"));
        return $version->webpanel->stable->version_number;
    }

    function get_beta_version() //Get current beta version
    {
        $version = json_decode(file_get_contents("http://sourcedonates.com/store-webpanel/webpanel_version.json"));
        return $version->webpanel->beta->version_number;
    }

    function get_nightly_version() //Get current nightly version
    {
        $version = json_decode(file_get_contents("http://sourcedonates.com/store-webpanel/webpanel_version.json"));
        return $version->webpanel->nightly->version_number;
    }

    function get_installed_version() //Get the installed version
    {
        $version = json_decode(file_get_contents("./application/config/webpanel_version.json"));
        return $version->version_number ." - ". $version->version_details->type;
    }

    function check_version() //Check if the version is up2date and return a code that indicates the status
    {
        //return code:
        //
        //First Digit:
        //  0: Version is up2date
        //  1XX: Running outdated Stable
        //  2XX: Running outdated Beta
        //  4XX: Running outdated Nightly
        //  9XX: Error
        //
        //Second Digit:
        //  X1X: A newer stable version is available
        //  X2X: A newer beta version is available
        //  X4X: A newer nightly version is available
        //  X8X: Unknown Version
        //  X9X: Internal Version-Check-Error
        //
        //Thrid Digit:
        //  XX0: The requirements havnt changed
        //  XX1: A newer database version is required
        //  XX2: A newer plugin version is required
        //  XX3: A newer plugin and database version is required
        //
        $installed_version = json_decode(file_get_contents("./application/config/webpanel_version.json"));
        $available_version = json_decode(file_get_contents("http://sourcedonates.com/store-webpanel/webpanel_version.json"));

        $version_data = array(); //data returned to the view
        $return_code = 900;
        $update_commit = "";

        //get the running version type
        $installed_version_type = $installed_version->version_details->type;

        //check if there is a newer version type available
        switch($installed_version_type){
            case 'stable': //if a stable version is available only 
                if ($installed_version->version_number == $available_version->webpanel->stable->version_number) // check if the stable version is up2date with the available stable version
                {
                   $return_code = 0; //version is up2date
                }
                else
                {
                    $return_code = 110; //version is outdated
                    $update_commit = $available_version->webpanel->stable->version_details->commit;
                }
                break;
            case 'beta':
                if ($installed_version->version_number == $available_version->webpanel->beta->version_number) // check if the stable version is up2date with the available stable version
                {
                   $return_code = 0; //beta version is up2date, but check if there is a newer stable

                   if ($installed_version->version_details->major < $available_version->webpanel->stable->version_details->major ||
                        $installed_version->version_details->minor < $available_version->webpanel->stable->version_details->minor ||
                        $installed_version->version_details->patch < $available_version->webpanel->stable->version_details->patch)
                   {
                        $return_code = 210;
                        $update_commit = $available_version->webpanel->stable->version_details->commit;
                   }
                }
                else
                {
                    $return_code = $return_code = 220;
                    $update_commit = $available_version->webpanel->beta->version_details->commit;
                }
                break;
            case 'nightly':
                if ($installed_version->version_number == $available_version->webpanel->nightly->version_number) // check if the stable version is up2date with the available stable version
                {
                   $return_code = 0; // nightly version is up2date, but check if there is a newer beta

                   //check if a newer nightly version is available
                   if ($installed_version->version_details->major < $available_version->webpanel->beta->version_details->major ||
                        $installed_version->version_details->minor < $available_version->webpanel->beta->version_details->minor ||
                        $installed_version->version_details->patch < $available_version->webpanel->beta->version_details->patch)
                   {
                        $return_code = 420;
                        $update_commit = $available_version->webpanel->beta->version_details->commit;
                   }
                }
                else
                {
                    $return_code = $return_code = 440;
                    $update_commit = $available_version->webpanel->nightly->version_details->commit;
                }
                break;
            default:
                $return_code = 980;

        }

        $version_data["return_code"] = $return_code; // return code
        $version_data["update_commit"] = $update_commit; // commit
        return $version_data;    }

    function shrink_json($json)
    {
        $tokenizer = "/\"|(\/\*)|(\*\/)|(\/\/)|\n|\r/";
        $in_string = false;
        $in_multiline_comment = false;
        $in_singleline_comment = false;
        $tmp;
        $tmp2;
        $new_str = array();
        $ns = 0;
        $from = 0;
        $lc;
        $rc;
        $lastIndex = 0;

        while (preg_match($tokenizer, $json, $tmp, PREG_OFFSET_CAPTURE, $lastIndex))
        {
            $tmp = $tmp[0];
            $lastIndex = $tmp[1] + strlen($tmp[0]);
            $lc = substr($json, 0, $lastIndex - strlen($tmp[0]));
            $rc = substr($json, $lastIndex);
            if (!$in_multiline_comment && !$in_singleline_comment)
            {
                $tmp2 = substr($lc, $from);
                if (!$in_string)
                {
                    $tmp2 = preg_replace("/(\n|\r|\s)*/", "", $tmp2);
                }
                $new_str[] = $tmp2;
            }
            $from = $lastIndex;

            if ($tmp[0] == "\"" && !$in_multiline_comment && !$in_singleline_comment)
            {
                preg_match("/(\\\\)*$/", $lc, $tmp2);
                if (!$in_string || !$tmp2 || (strlen($tmp2[0]) % 2) == 0)
                {        // start of string with ", or unescaped " character found to end string
                    $in_string = !$in_string;
                }
                $from--; // include " character in next catch
                $rc = substr($json, $from);
            }
            else if ($tmp[0] == "/*" && !$in_string && !$in_multiline_comment && !$in_singleline_comment)
            {
                $in_multiline_comment = true;
            }
            else if ($tmp[0] == "*/" && !$in_string && $in_multiline_comment && !$in_singleline_comment)
            {
                $in_multiline_comment = false;
            }
            else if ($tmp[0] == "//" && !$in_string && !$in_multiline_comment && !$in_singleline_comment)
            {
                $in_singleline_comment = true;
            }
            else if (($tmp[0] == "\n" || $tmp[0] == "\r") && !$in_string && !$in_multiline_comment && $in_singleline_comment)
            {
                $in_singleline_comment = false;
            }
            else if (!$in_multiline_comment && !$in_singleline_comment && !(preg_match("/\n|\r|\s/", $tmp[0])))
            {
                $new_str[] = $tmp[0];
            }
        }
        $new_str[] = $rc;
        return implode("", $new_str);
    }

}

?>
