<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Report_model extends CI_Model
{
    public $Table;
    public function __construct()
    {
        parent::__construct();
        $this->session = (object)get_userdata(USER);

        // if(is_empty_object($this->session)){
        // 	redirect(base_url().'login/authentication', 'refresh');
        // }

        $model_list = [];
        $this->load->model($model_list);
        $this->Table = json_decode(TABLE);
    }

    public function get_sales()
    {
        $this->db->select(
            'p.*,' .
                'o.*'
        );
        $this->db->from($this->Table->payment . ' p');
        $this->db->join($this->Table->order . ' o', 'o.ID=p.Order_ID', 'left');
        $this->db->join($this->Table->customer . ' c', 'c.ID=o.Cust_ID', 'left');
       

        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }

        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
        return $Amount;
        //  echo json_encode($query);
    }

    public function get_cash()
    {
        $this->db->select(
            'p.*,' .
                'o.*'
        );
        $this->db->from($this->Table->payment . ' p');
        $this->db->join($this->Table->order . ' o', 'o.ID=p.Order_ID', 'left');
        $this->db->join($this->Table->customer . ' c', 'c.ID=o.Cust_ID', 'left');
       

        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }
        
        $this->db->where('Payment_mode', 49);


        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
        return $Amount;

        // echo json_encode($Amount);

    }

    public function get_online()
    {
        $this->db->select(
            'p.*,' .
                'o.*'
        );
        $this->db->from($this->Table->payment . ' p');
        $this->db->join($this->Table->order . ' o', 'o.ID=p.Order_ID', 'left');
        $this->db->join($this->Table->customer . ' c', 'c.ID=o.Cust_ID', 'left');
       

        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }
        $this->db->where('Payment_mode', 50);

        $query = $this->db->get()->result();
        $Amount = 0;

        foreach ($query as $key => $value) {
            $Amount += $value->Amount_paid;
        }
        return $Amount;

        // echo json_encode($Amount);

    }

    public function get_monthly()
    {
        $this->db->select(
            'p.Date_paid,' .
                'SUM(p.Amount_paid) AS total,' .
                'o.*'
        );
        $this->db->from($this->Table->payment . ' p');
        $this->db->join($this->Table->order . ' o', 'o.ID=p.Order_ID', 'left');
        $this->db->join($this->Table->customer . ' c', 'c.ID=o.Cust_ID', 'left');
       

        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }
        // if(@$this->report_year!=null){
        //     // where $this->report_year == date_paid but year
        $this->db->where('YEAR(p.date_paid)', date("Y"));
        // }
        $this->db->group_by('Month(p.Date_paid)');
        $this->db->group_by('Year(p.Date_paid)');

        $query = $this->db->get()->result();
        return $query;
    }

    public function get_itemlist()
    {
        $this->db->select(
            'i.Item_id,' .
            'SUM(i.Item_qty) as Quantity,' .
            ' l.List_name as item_name');
        $this->db->from($this->Table->item . ' i');
        $this->db->join($this->Table->list . ' l', 'l.ID=i.Item_id', 'left');
        $this->db->join($this->Table->customer. ' c', 'c.ID=i.Customer_ID', 'left');
        
        if(!empty($this->session->Branch)){
            $this->db->where('c.Branch', $this->session->Branch);
        }

        $this->db->group_by('i.Item_id');
        $this->db->order_by('Quantity','DESC');
        $this->db->limit(10);
        $query = $this->db->get()->result();
        return $query;
    }
}