<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('items_model');
        $this->load->model('tools_model');

        if (!$this->ion_auth->logged_in() && $this->config->item('storewebpanel_enable_loginsystem') == 1) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['page'] = 'users';
        $data['version'] = $this->tools_model->get_installed_version();
        $search = $this->input->get('s');

        //$data['users'] = $this->users_model->get_users($search);
        $data['search'] = $search;

        $this->load->view('parts/header', $data);
        $this->load->view('pages/users/manage', $data);
        $this->load->view('parts/footer');
    }

    public function edit($slug) {
        $data['page'] = 'users';
        $data['version'] = $this->tools_model->get_installed_version();

        $data['user'] = $this->users_model->get_user($slug);
        $data['user_items'] = $this->users_model->get_user_items($slug);
        $data['items'] = $this->items_model->get_items();
        $this->load->view('parts/header', $data);
        $this->load->view('pages/users/edit', $data);
        $this->load->view('parts/footer');
    }

    public function server_process() { //TODO: Rework the Script
        /*
         * Script:    DataTables server-side script for PHP and MySQL
         * Adapted by: Werner Maisl (2014)
         * Copyright: 2010 - Allan Jardine
         * License:   GPL v2 or BSD (3-point)
         */

        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('id', 'auth', 'name', 'credits');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "store_users";

        /* Database connection information */
        $gaSql['user'] = $this->db->username;
        $gaSql['password'] = $this->db->password;
        $gaSql['db'] = $this->db->database;
        $gaSql['server'] = $this->db->hostname;


        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP server-side, there is
         * no need to edit below this line
         */

        /*
         * MySQL connection
         */
        $gaSql['link'] = mysql_pconnect($gaSql['server'], $gaSql['user'], $gaSql['password']) or
                die('Could not open connection to server');

        mysql_select_db($gaSql['db'], $gaSql['link']) or
                die('Could not select database ' . $gaSql['db']);


        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . mysql_real_escape_string($_GET['iDisplayStart']) . ", " .
                    mysql_real_escape_string($_GET['iDisplayLength']);
        }


        /*
         * Ordering
         */
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . "
				 	" . mysql_real_escape_string($_GET['sSortDir_' . $i]) . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }


        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if ($_GET['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        /* Individual column filtering */
        for ($i = 0; $i < count($aColumns); $i++) {
            if ($_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
            }
        }


        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
        $rResult = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());

        /* Data set length after filtering */
        $sQuery = "
		SELECT FOUND_ROWS()
	";
        $rResultFilterTotal = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());
        $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0];

        /* Total data set length */
        $sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable
	";
        $rResultTotal = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());
        $aResultTotal = mysql_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];


        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        while ($aRow = mysql_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "id") {
                    /* Link id column to user edit page */
                    $row[] = "<a href=\"".base_url("/index.php/users/edit/").$aRow[$aColumns[$i]]."\">".$aRow[$aColumns[$i]]."</a>";
                } else if ($aColumns[$i] != ' ') {
                    /* General output */
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            //get the user item count
            $row[] = $this->users_model->get_user_items_count($aRow[$aColumns[0]]);
            $output['aaData'][] = $row;
        }

        echo json_encode($output);
    }

    public function process() {
        $data['page'] = 'users';
        $data['version'] = $this->tools_model->get_installed_version();
        $post = $this->input->post();
        $data['post'] = $post;

        if ($post['action'] == 'edit') {
            $this->users_model->edit_user($post);
        } elseif ($post['action'] == 'remove_item') {
            $this->items_model->remove_useritem(NULL, NULL, $post['useritem_id']);
        } elseif ($post['action'] == 'remove_refund_item') {
            $this->items_model->remove_refund_useritem($post["user_id"], $post["item_id"], $post["item_price"], $post['useritem_id']);
        } elseif ($post['action'] == 'remove_user') {
            $this->users_model->remove_user($post);
        } elseif ($post['action'] == 'add_item') {
            $this->items_model->add_useritem($post["user_id"], $post["item_id"]);
        }
        redirect('/users/', 'refresh');
    }

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */