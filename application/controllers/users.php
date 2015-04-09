<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('items_model');
        $this->load->model('tools_model');

        if (!$this->ion_auth->logged_in() && $this->config->item('storewebpanel_enable_loginsystem') == 1)
        {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['page'] = 'users';
        $data['version'] = $this->tools_model->get_installed_version();
        $search = $this->input->get('s');

        $data['search'] = $search;

        $this->load->view('parts/header', $data);
        $this->load->view('pages/users/manage', $data);
        $this->load->view('parts/footer');
    }

    public function edit($slug)
    {
        $data['page'] = 'users';
        $data['version'] = $this->tools_model->get_installed_version();

        $data['user'] = $this->users_model->get_user($slug);
        $data['user_items'] = $this->users_model->get_user_items($slug);
        $data['items'] = $this->items_model->get_items();
        $this->load->view('parts/header', $data);
        $this->load->view('pages/users/edit', $data);
        $this->load->view('parts/footer');
    }

    public function server_process()
    {
        /**
         * Script:    DataTables server-side script for PHP 5.2+ and MySQL 4.1+
         * Notes:     Based on a script by Allan Jardine that used the old PHP mysql_* functions.
         *            Rewritten to use the newer object oriented mysqli extension.
         * Copyright: 2010 - Allan Jardine (original script)
         *            2012 - Kari Söderholm, aka Haprog (updates)
         *            2014 - Werner Maisl (updates, adaption for the store webpanel)
         * License:   GPL v2 or BSD (3-point)
         */
        mb_internal_encoding('UTF-8');

        /**
         * Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('id', 'auth', 'name', 'credits');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = 'id';

        /* DB table to use */
        $sTable = 'store_users';

        /* Database connection information */
        $gaSql['user'] = $this->db->username;
        $gaSql['password'] = $this->db->password;
        $gaSql['db'] = $this->db->database;
        $gaSql['server'] = $this->db->hostname;
        $gaSql['port'] = 3306; // 3306 is the default MySQL port
        /* Input method (use $_GET, $_POST or $_REQUEST) */
        $input = & $_GET;

        /**         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP server-side, there is
         * no need to edit below this line
         */
        /**
         * Character set to use for the MySQL connection.
         * MySQL will return all strings in this charset to PHP (if the data is stored correctly in the database).
         */
        $gaSql['charset'] = 'utf8';

        /**
         * MySQL connection
         */
        $db = new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'], $gaSql['port']);
        if (mysqli_connect_error())
        {
            die('Error connecting to MySQL server (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }

        if (!$db->set_charset($gaSql['charset']))
        {
            die('Error loading character set "' . $gaSql['charset'] . '": ' . $db->error);
        }


        /**
         * Paging
         */
        $sLimit = "";
        if (isset($input['iDisplayStart']) && $input['iDisplayLength'] != '-1')
        {
            $sLimit = " LIMIT " . intval($input['iDisplayStart']) . ", " . intval($input['iDisplayLength']);
        }


        /**
         * Ordering
         */
        $aOrderingRules = array();
        if (isset($input['iSortCol_0']))
        {
            $iSortingCols = intval($input['iSortingCols']);
            for ($i = 0; $i < $iSortingCols; $i++)
            {
                if ($input['bSortable_' . intval($input['iSortCol_' . $i])] == 'true')
                {
                    $aOrderingRules[] = "`" . $aColumns[intval($input['iSortCol_' . $i])] . "` "
                            . ($input['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc');
                }
            }
        }

        if (!empty($aOrderingRules))
        {
            $sOrder = " ORDER BY " . implode(", ", $aOrderingRules);
        }
        else
        {
            $sOrder = "";
        }


        /**
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $iColumnCount = count($aColumns);

        if (isset($input['sSearch']) && $input['sSearch'] != "")
        {
            $aFilteringRules = array();
            for ($i = 0; $i < $iColumnCount; $i++)
            {
                if (isset($input['bSearchable_' . $i]) && $input['bSearchable_' . $i] == 'true')
                {
                    log_message('debug', 'INPUT: sSearch - ' . $input['sSearch']);
                    log_message('debug', 'INPUT: STRPOS  - ' . strpos($input['sSearch'], "STEAM_"));
                    // Check if the Search String contains STEAM_
                    if (strpos($input['sSearch'], "STEAM_") !== false)
                    {
                        //If yes, then then convert the steamid to the auth string
                        log_message('debug', 'INPUT STEAMID - '.$input['sSearch']);
                        log_message('debug', 'INPUT AUTH - '.$this->users_model->steamid_to_auth($input['sSearch']));
                        $sSearch = $input['sSearch'];
                        $sSearch = $this->users_model->steamid_to_auth($sSearch);
                        $aFilteringRules[] = "`" . $aColumns[$i] . "` LIKE '%" . $db->real_escape_string($sSearch) . "%'";
                    }
                    else
                    {
                        $aFilteringRules[] = "`" . $aColumns[$i] . "` LIKE '%" . $db->real_escape_string($input['sSearch']) . "%'";
                    }
                }
            }
            if (!empty($aFilteringRules))
            {
                $aFilteringRules = array('(' . implode(" OR ", $aFilteringRules) . ')');
            }
        }

        /* Individual column filtering */
        for ($i = 0; $i < $iColumnCount; $i++)
        {
            if (isset($input['bSearchable_' . $i]) && $input['bSearchable_' . $i] == 'true' && $input['sSearch_' . $i] != '')
            {
                $aFilteringRules[] = "`" . $aColumns[$i] . "` LIKE '%" . $db->real_escape_string($input['sSearch_' . $i]) . "%'";
            }
        }

        if (!empty($aFilteringRules))
        {
            $sWhere = " WHERE " . implode(" AND ", $aFilteringRules);
        }
        else
        {
            $sWhere = "";
        }


        /**
         * SQL queries
         * Get data to display
         */
        $aQueryColumns = array();
        foreach ($aColumns as $col)
        {
            if ($col != ' ')
            {
                $aQueryColumns[] = $col;
            }
        }

        $sQuery = "
    SELECT SQL_CALC_FOUND_ROWS `" . implode("`, `", $aQueryColumns) . "`
    FROM `" . $sTable . "`" . $sWhere . $sOrder . $sLimit;

        $rResult = $db->query($sQuery) or die($db->error);

        /* Data set length after filtering */
        $sQuery = "SELECT FOUND_ROWS()";
        $rResultFilterTotal = $db->query($sQuery) or die($db->error);
        list($iFilteredTotal) = $rResultFilterTotal->fetch_row();

        /* Total data set length */
        $sQuery = "SELECT COUNT(`" . $sIndexColumn . "`) FROM `" . $sTable . "`";
        $rResultTotal = $db->query($sQuery) or die($db->error);
        list($iTotal) = $rResultTotal->fetch_row();


        /**
         * Output
         */
        $output = array(
            "sEcho" => intval($input['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array(),
        );

        while ($aRow = $rResult->fetch_assoc())
        {
            $row = array();
            for ($i = 0; $i < $iColumnCount; $i++)
            {
                if ($aColumns[$i] == 'id')
                {
                    /* Link id column to user edit page */
                    $row[] = "<a href=\"" . base_url("/index.php/users/edit") . "/" . $aRow[$aColumns[$i]] . "\">" . $aRow[$aColumns[$i]] . "</a>";
                }
                elseif ($aColumns[$i] != ' ')
                {
                    // General output
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            //Get the user item count
            $row[] = $this->users_model->get_user_items_count($aRow[$aColumns[0]]);
            $output['aaData'][] = $row;
        }

        echo json_encode($output);
    }

    public function process()
    {
        $data['page'] = 'users';
        $data['version'] = $this->tools_model->get_installed_version();
        $post = $this->input->post();
        $data['post'] = $post;

        if ($post['action'] == 'edit')
        {
            $this->users_model->edit_user($post);
        }
        elseif ($post['action'] == 'remove_item')
        {
            $this->items_model->remove_useritem(NULL, NULL, $post['useritem_id']);
        }
        elseif ($post['action'] == 'remove_refund_item')
        {
            $this->items_model->remove_refund_useritem($post["user_id"], $post["item_id"], $post["item_price"], $post['useritem_id']);
        }
        elseif ($post['action'] == 'remove_user')
        {
            $this->users_model->remove_user($post);
        }
        elseif ($post['action'] == 'add_item')
        {
            $this->items_model->add_useritem($post["user_id"], $post["item_id"]);
        }
        redirect('/users/', 'refresh');
    }

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */