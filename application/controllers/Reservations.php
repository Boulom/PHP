<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reservation
 *
 * @author julien
 */
class Reservations extends CI_Controller {
       public function __construct()
        {
                parent::__construct();
                
                $this->load->model('Reservations_modele');               
                $this->load->helper('url_helper');
                $prefs= array('show_next_prev' => TRUE);
                $this->load->library('calendar',$prefs);
                $this->load->library('session');
        }
        public function index(){
            $this->load->view('templates/header');
            $this->load->view('form/connexion');
            $this->load->view('templates/footer');
        }
        public function sucessConnexion(){
            $_SESSION['login']=$_POST['Identifiant'];
            $_SESSION['mdp']=$_POST['mdp'];
            $_SESSION['id']=$this->Reservations_modele->getIdUtilByLogin($_POST['Identifiant']);
            $data['checkAuthentification']=$this->Reservations_modele->checkAuthentification($_POST['Identifiant'],$_POST['mdp']);
            $this->load->view('templates/header',$data);
            $this->load->view('form/sucessConnexion',$data);
            $this->load->view('templates/footer',$data);
        }
        public function afficher_all() {
        $data['titre'] = "Les réservations";

        $this->load->model('Reservations_modele');
        $data['reserv'] = $this->Reservations_modele->getReserv_all();

        $this->load->view('templates/header', $data);
        $this->load->view('reservations/afficher', $data);
        $this->load->view('templates/footer', $data);
        }
       
        public function liste(){
            $data['reservation']= $this->Reservations_modele->get_reservation($this->session->id);
            $data['utilisateur']= $this->Reservations_modele->get_utilisateur();
            $data['calendrier']=$this->calendar->generate($this->uri->segment(3),$this->uri->segment(4));
            $data['calend']=$this->Reservations_modele->calendrier();
            $data['checkUser']=$this->Reservations_modele->checkUser($this->session->login);
            $this->load->view('templates/header', $data);
            $this->load->view('reservations/liste', $data);
            $this->load->view('templates/footer',$data);
            
        }
        
         
         public function reservation_item($idReserv = NULL)
        {
                $data['reservation_item'] = $this->Reservations_modele->get_reservations($idReserv);
               
                
                
                if (empty($data['idReserv']))
                {
                    show_404();
                }
                
                 $data['idReserv'] = $data['reservations_item']['idReserv'];

            $this->load->view('templates/header', $data);
            $this->load->view('reservations/afficher', $data);
            $this->load->view('templates/footer');
        
        }
    public function afficher($numclient = 0) {
        
        /*Condition pour vérifier que le client a bien été indiqué dans l'URL*/
      if ($numclient ==0)
        {
                show_404(); //Erreur 404
        }
/* Données à transmettre à la vue */ 
$data['titre'] = "Mes réservations";
$data['num'] = $numclient;
$data['reservation'] =  $this->Reservations_modele->get_reservation($numclient);
$data['id']=$numclient;
$data['utilisateur']= $this->Reservations_modele->get_utilisateur();
$data['reservations'] = $this->Reservations_modele->get_reservations();
$data['calendrier']=$this->calendar->generate($this->uri->segment(3),$this->uri->segment(4));

     /*Chargement de la vue */
$this->load->view('templates/header',$data);
$this->load->view('reservations/afficher',$data);
$this->load->view('templates/footer',$data);

}

public function connexion_reservation() {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('form/myform');
        } else {
            $this->load->view('form/formsuccess');
        }
        $this->load->view('templates/header',$data);
        $this->load->view('reservations/connexion_reservation',$data);
        $this->load->view('templates/footer',$data);
    
    }
 
public function form() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['titre'] = 'Réservation séjour !';

        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('form/form');
            $this->load->view('templates/footer');
        } else {
            $this->load->view('form/formsuccess');
        }
    }

    public function reserver() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['titre'] = 'Réservation séjour !';

        $this->form_validation->set_rules('idUtil', 'idUtil', 'required');
        $this->form_validation->set_rules('Date_Arrivee', 'Date_Arrivee', 'required');
        $this->form_validation->set_rules('Date_Depart', 'Date_Depart', 'required');
        $this->form_validation->set_rules('Nb_Personnes', 'Nb_Personnes', 'required');
        $this->form_validation->set_rules('Menage', 'Menage', 'required');


        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('form/reserver');
            $this->load->view('templates/footer');
        } else {
            $this->Reservations_modele->set_formul();
            $this->load->view('form/formsuccess');
        }
        
    }
    public function sucessReservation(){
        
        $data['makeReservation']=$this->Reservations_modele->makeReservation($this->session->id,$_POST['Date_Arrivee'],$_POST['Date_Depart'],$_POST['Nb_Personnes'],$_POST['Menage']);
        $this->load->view('templates/header',$data);
        $this->load->view("form/sucessReservation",$data);
        $this->load->view('templates/footer',$data);
    }
    public function inscription(){
        $this->load->view('templates/header');
        $this->load->view('form/inscription');
        $this->load->view('templates/footer');
    }
    public function sucessInscription(){
        $data['inscription']=$this->Reservations_modele->inscription($_POST['nom'],$_POST['prenom'],$_POST['identifiant'],$_POST['mdp']);
        $this->load->view('templates/header',$data);
        $this->load->view("form/sucessInscription",$data);
        $this->load->view('templates/footer',$data);
    }
    public function deconnexion(){
        $this->load->view('templates/header');
        $this->load->view('reservations/deconnexion');
        $this->load->view('templates/footer');
    }
    public function suppressionReservation(){
        $this->load->view('templates/header');
        $this->load->view('form/suppressionReservation');
        $this->load->view('templates/footer');
    }
    public function modificationReservation(){
        $this->load->view('templates/header');
        $this->load->view('form/modificationReservation');
        $this->load->view('templates/footer');
    }
}
