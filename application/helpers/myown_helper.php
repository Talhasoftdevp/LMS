<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function mysql_date(){
    //$CI->load->helper('date');
    $datestring = '%Y-%m-%d %h:%i:%s';
    $time = time();
    return mdate($datestring, $time);
    
}

function count_product_brand_wise($id){
    $CI=& get_instance();
       $CI->db->from('products');
       $CI->db->where('is_del',0);
        $CI->db->where('manufacturer_id',$id);
        $CI->db->where('status',1);
        return $CI->db->count_all_results();
}


function product_detail($id){
    $CI=& get_instance();
       $CI->db->from('products');
       $CI->db->where('is_del',0);
        $CI->db->where('products_id',$id);
        $CI->db->where('status',1);
       // return $CI->db->count_all_results();
        $query=$CI->db->get();
       return  $query->result_array();
}