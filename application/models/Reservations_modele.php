<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reservations_modele
 *
 * @author julien
 */
class Reservations_modele extends CI_Model {
        public function __construct()
        {
                $this->load->database();
                $prefs= array('show_next_prev' => TRUE);
                $this->load->library('calendar',$prefs);
        }
        public function get_reservations($idReserv = FALSE)
{
        if ($idReserv === FALSE)
        {
                $query = $this->db->get('reservations');
                return $query->result_array();
        }

        $query = $this->db->get_where('reservations', array('idReserv' => $idReserv));
        return $query->row_array();
}
        public function get_utilisateur($idUtil = FALSE) {
            
            if($idUtil === False)
            {
                $query=$this->db->get('utilisateur');
                return $query->result_array();
                
                
            }
            
           $query = $this->db->get_where('utilisateur', array('idUtil' => $idUtil));
           return $query->row_array();
           
        }
        public function get_calendrier($année,$mois,$info = null){
            if ($info === null) {
            return $this->calendar->generate($année, $mois);
        } else {
            return $this->calendar->generate($année, $mois, $info);
        }
        }
        public function calendrier(){
            /* $data = array();
            array_push */
            
            
            $data=array(
               2    => 'http://localhost/codeigniter/index.php/reservations/afficher/41',3     => 'http://localhost/codeigniter/index.php/reservations/afficher/41',
               4    => 'http://localhost/codeigniter/index.php/reservations/afficher/41',5     => 'http://localhost/codeigniter/index.php/reservations/afficher/41',
               6    => 'http://localhost/codeigniter/index.php/reservations/afficher/41',7     => 'http://localhost/codeigniter/index.php/reservations/afficher/41',
               8    => 'http://localhost/codeigniter/index.php/reservations/afficher/41',9     => 'http://localhost/codeigniter/index.php/reservations/afficher/41',
               10   => 'http://localhost/codeigniter/index.php/reservations/afficher/41',11    => 'http://localhost/codeigniter/index.php/reservations/afficher/41',
               17   => 'http://localhost/codeigniter/index.php/reservations/afficher/27',18    => 'http://localhost/codeigniter/index.php/reservations/afficher/27',
               19   => 'http://localhost/codeigniter/index.php/reservations/afficher/27',20    => 'http://localhost/codeigniter/index.php/reservations/afficher/27',
               21   => 'http://localhost/codeigniter/index.php/reservations/afficher/27',24    => 'http://localhost/codeigniter/index.php/reservations/afficher/27',
               25   => 'http://localhost/codeigniter/index.php/reservations/afficher/27',26    => 'http://localhost/codeigniter/index.php/reservations/afficher/27',
                
                   );
            return $this->calendar->generate($this->uri->segment(3),$this->uri->segment(4),$data);
        }
         public function get_reservation($numclient = 0) {
        if ($numclient === 0) {
            $query = $this->db->get('reservations');
            return $query->result_array();
        }
        else {
        $query = $this->db->get_where('reservations', array('idUtil' => $numclient));
        return $query->result_array();
        }
        
    }

    public function get_all_reservation() {

        $query = $this->db->get('reservations');
        return $query->result_array();
    }

    public function set_form() {
        $this->load->helper('url');

        $slug = url_titre($this->input->post('titre'), 'dash', TRUE);

        $data = array(
            'titre' => $this->input->post('titre'),
            'slug' => $slug,
            'texte' => $this->input->post('texte')
        );

        return $this->db->insert('form', $data);
    }

    public function set_myform() {

        $data = array(
            'Date_Arrivee' => $this->input->post('Date_Arrivee'),
            'Date_Depart' => $this->input->post('Date_Depart'),
            'Nb_Personnes' => $this->input->post('Nb_Personnes'),
            'Menage' => $this->input->post('Menage'),
            'idClient' => $this->input->post('idUtil')
        );

        return $this->db->insert('reservations', $data);
    }
    public function checkAuthentification($Login,$mdp){
        $query= $this->db->query("SELECT Login,MdP FROM utilisateur WHERE Login LIKE '".$Login."' AND MdP LIKE '".$mdp."';");
        $row = $query->row();
        if($row->Login === $Login && $row->MdP === $mdp){
            return TRUE;
        }
        else {
            return FALSE;
        }
                
    }
    public function checkUser($Login){
        $query = $this->db->query("SELECT Admin FROM utilisateur WHERE Login Like '".$Login."';");
        return $query->row(); 
        
    }
    public function getIdUtilByLogin($Login){
        $query = $this->db->query("SELECT idUtil FROM utilisateur WHERE Login LIKE '".$Login."';");
        $row=$query->row();
        return $row->idUtil;
        
    }
    public function makeReservation($idUtil,$dateArriver,$dateDepart,$nombrePersonne,$menage){
        $query = $this->db->query("INSERT INTO reservations(Date_arrivee,Date_Depart,Nb_Personnes,Menage,"
                . "EtatReservation,idUtil) VALUES('".$dateArriver."','".$dateDepart."',".$nombrePersonne.",".$menage.",'En cours',".$idUtil.");");
    
        return $query;
    }
    public function inscription($nom,$prenom,$login,$mdp){
        $query = $this->db->query("INSERT INTO utilisateur(Nom,Prenom,Login,MdP,Admin) VALUES
            ('".$nom."','".$prenom."','".$login."','".$mdp."',0);");
        return $query;
            
    }
  
      
}
