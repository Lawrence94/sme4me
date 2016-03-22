<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Parse\ParseObject;
use Parse\ParseUser;

function buildPage($view_string, $title = null){
    $CI =& get_instance();
    $title = ($title) ? $title : 'Default Title' ;
    $title_data = array('page_title' => $title);
    $menu_data = menu_header();
    $data = array(
        'header' => $CI->load->view('templates/header', $title_data, true),
        'menu_header' => $CI->load->view('templates/menu_header', $menu_data, true),
        'sidebar' => $CI->load->view('templates/sidebar', '', true),
        'content' => $view_string,
        'footer' => $CI->load->view('templates/footer', '', true)
    );
    
    $CI->load->view('templates/page', $data);
    
}

function menu_header(){
        //getting the currently logged in admin
        $CI =& get_instance();
        $currentUser = $CI->session->userdata('user_vars');
        $firstName = '';
        $lastName = '';

        if ($currentUser) {
            // do stuff with the user
            $firstName = $currentUser["firstname"];
            $lastName = $currentUser["lastname"];
            $accessid = $currentUser['accesslevel'];
            $roleCheck = $CI->db->get_where('accesslevel', ['id' => $accessid])->row();
            $role = $roleCheck->name;

            return array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'role' => $role,
            );

        } else {
            // show the signup or login page
            redirect('Admin/login','refresh');
        }
    }
