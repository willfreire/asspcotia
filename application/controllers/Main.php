<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        # Carregar modelo
        $this->load->model('Contador_model', 'Contador');
    }

    /**
     * Método principal para carregar a tela home
     *
     * @method index
     * @access public
     * @return void
     */
    public function index()
    {
        # Busca Banner
        $this->db->select("b.id_banner_pk, b.img, b.title, b.subtitle, b.description, b.btn_text, b.btn_link, b.pos_elem, b.id_status_fk, s.status");
        $this->db->from('tb_banner b');
        $this->db->join('tb_status s', 's.id_status_pk = b.id_status_fk', 'inner');
        $data['banner'] = $this->db->get()->result();
        
        # Contador
        $data['contador'] = $this->Contador->visitas();

        $this->load->view('header');
        $this->load->view('header_menu');
        $this->load->view('home', $data);
        $this->load->view('main_footer');
        $this->load->view('footer');
    }

    /**
     * Método para buscar dados da Agenda
     *
     * @method buscarAgenda
     * @access public
     * @return obj Dias de agenda
     */
    public function buscarAgenda()
    {
        # Vars
        $ano     = $this->input->get('year');
        $mes     = str_pad($this->input->get('month'), 2, "0", STR_PAD_LEFT);
        $retorno = array();

        if ($ano != "" && $mes != ""):
            $this->db->select("id_agenda_pk, agenda_url, dt_agenda, horario, titulo, descricao");
            $this->db->from("tb_agenda");
            $this->db->where("DATE_FORMAT(dt_agenda, '%Y-%m') = '$ano-$mes'");
            $rows = $this->db->get()->result();

            if (!empty($rows)):
                foreach ($rows as $value):
                    $data              = date("d/m/Y", strtotime($value->dt_agenda));
                    $horario           = $value->horario;
                    $agenda            = new stdClass();
                    $agenda->date      = $value->dt_agenda;
                    $agenda->badge     = TRUE;
                    $agenda->title     = $value->titulo;
                    $agenda->body      = "<span class='text-bold'>Data / Hor&aacute;rio:</span> {$data} {$horario}<br><span class='text-bold'>Descri&ccedil;&atilde;o:</span> {$value->descricao}";
                    $agenda->footer    = "<button type='button' class='btn btn-primary' data-dismiss='modal'>Fechar</button>";
                    $agenda->classname = "purple-event";
                    $retorno[]         = $agenda;
                endforeach;
            endif;

        endif;

        print json_encode($retorno);
    }

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
