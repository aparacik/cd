<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Games extends MY_controller {

    function __construct(){
            parent::__construct();
            $this->load->library('session');
            $this->load->library('form_validation');
            $this->load->model('Game_model', 'game_model', TRUE);
        } 
 


 public function add()
    {   
        // Ustalamy reguły walidacji
        $this->form_validation->set_rules('title', 'Tytuł', 'required|trim');
        $this->form_validation->set_rules('describe', 'Opis', 'required|trim');
        $this->form_validation->set_rules('premiere', 'Data premiery', 'required|trim');
 
        // Sprawdzamy, czy formularz został wysłany i czy wystąpiły błędy walidacji
        if ($this->form_validation->run() == FALSE)
        {
            // Wyświetlamy widoki - ewentualne błędy walidacji zostaną przekazane automatycznie
            $this->template->load('base_templates/base', 'game/add_game');

        }
        else
        {
            // Przypisujemy zmienne POST z formularza do tablicy $data
            $data['title'] = $this->input->post('title');
            $data['describe'] = $this->input->post('describe');
            // Ustawiamy zmienną $data['user_id'] na identyfikator zalogowanego użytkownika, 
            // który przechowujemy w sesji (ustawiany jest w momencie logowania). 
            
            // Wysyłamy tablicę $data do modelu i w zależności od zwróconego wyniku wykonujemy poniższe czynności
            if ($this->game_model->add($data))
            {
                // Ustawiamy zmienną flashadata o nazwie success i przypisujemy do niej komunikat o powodzeniu dodania wpisu.
                $this->session->set_flashdata('success', 'Wpis został dodany.');                
            }
            else
            {
                // Ustawiamy zmienną flashadata o nazwie error i przypisujemy do niej komunikat o błędzie.
                $this->session->set_flashdata('error', 'Wystąpił błąd i wpis nie mógł zostać dodany.');
            }
            // Przekierowujemy użytkownika pod adres http://localhost/blogtutorial/index.php/posts
            redirect('');
        }
    }
}