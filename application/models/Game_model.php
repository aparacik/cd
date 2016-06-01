<?php
class Game_model extends CI_Model {
  
	public $table = 'games';

    function __construct(){
        // Call the Model constructor
        parent::__construct();        
    }

     public function add($data)
    {
        return $this->db->insert('games', $data);
    }

	public function insertGame($d)
	    {  
	            $string = array(
	                'game_title'=>$d['title'],
	                // 'game_premiere'=>$d['premiere'],
	                'game_describe'=>$d['describe'],
	                // 'game_author'=>$d['author'],
	            );
	            $q = $this->db->insert_string('games',$string);             
	            $this->db->query($q);
	            return $this->db->insert_id();
	    }

   public function isDuplicate($title)
    {     
        $this->db->get_where('games', array('game_title' => $title), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;         
    }

}