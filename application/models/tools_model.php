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
        }
    }

    function get_current_version()
    {
        return file_get_contents("http://sourcedonates.com/version.html");
    }

    function get_installed_version()
    {
        return "1.2.1-dev";
    }

    function check_version($webpanel_version_current, $webpanel_version_installed)
    {
        if (strpos($webpanel_version_installed, "-dev") !== false)
        {
            return "dev-version";
        }
        elseif ($webpanel_version_current == $webpanel_version_installed)
        {
            return "up2date";
        }
        else
        {
            return "outofdate";
        }
    }

}

?>
