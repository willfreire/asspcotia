<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        # Sessao
        if (!$this->session->userdata('user')) {
            redirect(base_url('./admin/'));
        }

        # Carregar modelo
        $this->load->model('Agenda_model');

    }

    /**
     * Método para carregar o gerenciamento de agendas
     *
     * @method index
     * @access public
     * @return void
     */
    public function index()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Agendas";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('agenda/agenda_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar o gerenciamento de agendas
     *
     * @method gerenciar
     * @access public
     * @return void
     */
    public function gerenciar()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Agendas";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('agenda/agenda_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar tela de cadastro de agenda
     *
     * @method cadastrar
     * @access public
     * @return void
     */
    public function cadastrar()
    {
        # Titulo da pagina
        $header['titulo'] = "Cadastro de Agenda";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('agenda/agenda_cadastrar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de cadastro de agenda
     *
     * @method create
     * @access public
     * @return obj Status da ação
     */
    public function create()
    {
        $agenda   = new stdClass();
        $retorno  = new stdClass();
        $resposta = "";

        $agenda->dt_agenda = $this->input->post('dt_agenda');
        $agenda->horario   = $this->input->post('horario');
        $agenda->titulo    = $this->input->post('titulo');
        $agenda->descricao = $this->input->post('descricao');

        if ($agenda->dt_agenda != NULL && $agenda->titulo != NULL) {
            $resposta = $this->Agenda_model->setAgenda($agenda);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para popular grid de gerenciamento de agenda
     *
     * @method buscarAgenda
     * @access public
     * @return obj Lista de agenda cadastrados
     */
    public function buscarAgenda()
    {
        # Recebe dados
        $search                     = new stdClass();
        $search->draw               = $this->input->post('draw');
        $search->orderByColumnIndex = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $search->orderBy            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'][$search->orderByColumnIndex]['data'] : "dt_agenda";
        $search->orderType          = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['dir'] : "ASC";
        $search->start              = $this->input->post('start');
        $search->length             = $this->input->post('length');
        $search->filter             = !empty($_POST['search']['value']) ? $_POST['search']['value'] : NULL;
        $search->columns            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'] : NULL;

        # Instanciar modelo
        $resposta = $this->Agenda_model->getAgendas($search);

        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de edição de agenda
     *
     * @method editar
     * @access public
     * @return void
     */
    public function editar($id_agenda = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Edi&ccedil;&atilde;o de Agenda";

        # Sql para busca
        $this->db->where('id_agenda_pk', $id_agenda);
        $data['agenda'] = $this->db->get('tb_agenda')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('agenda/agenda_editar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de edicao de agenda
     *
     * @method update
     * @access public
     * @return obj Status da ação
     */
    public function update()
    {
        $agenda   = new stdClass();
        $retorno  = new stdClass();
        $resposta = "";

        $agenda->id        = $this->input->post('id_agenda');
        $agenda->dt_agenda = $this->input->post('dt_agenda');
        $agenda->horario   = $this->input->post('horario');
        $agenda->titulo    = $this->input->post('titulo');
        $agenda->descricao = $this->input->post('descricao');

        if ($agenda->id != NULL && $agenda->dt_agenda != NULL && $agenda->titulo != NULL) {
            $resposta = $this->Agenda_model->setAgenda($agenda);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de visualização de agenda
     *
     * @method ver
     * @access public
     * @return void
     */
    public function ver($id_agenda = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Visualiza&ccedil;&atilde;o de Agenda";

        # Sql para busca
        $this->db->where('id_agenda_pk', $id_agenda);
        $data['agenda'] = $this->db->get('tb_agenda')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('agenda/agenda_ver', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método responsável pela exclusão de um registro
     *
     * @method delete
     * @access public
     * @return obj Status da ação
     */
    public function delete()
    {
        $retorno   =  new stdClass();
        $resposta  = "";
        $id_agenda = $this->input->post('id');

        if ($id_agenda !== NULL) {
            $resposta = $this->Agenda_model->delAgenda($id_agenda);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }
}

/* End of file Agenda.php */
/* Location: ./application/controllers/Agenda.php */