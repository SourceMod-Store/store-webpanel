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

}

?>
