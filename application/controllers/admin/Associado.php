<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Associado extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        # Sessao
        if (!$this->session->userdata('user')) {
            redirect(base_url('./admin/'));
        }

        # Carregar modelo
        $this->load->model('Associado_model');

    }

    /**
     * Método para carregar o requerimento de associados
     *
     * @method index
     * @access public
     * @return void
     */
    public function index()
    {
        # Titulo da pagina
        $header['titulo'] = "Requerimentos de Associados";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('associado/associado_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar o requerimento de associados
     *
     * @method requerimento
     * @access public
     * @return void
     */
    public function requerimento()
    {
        # Titulo da pagina
        $header['titulo'] = "Requerimentos de Associados";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('associado/associado_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para popular grid de gerenciamento de associado
     *
     * @method buscarAssociado
     * @access public
     * @return obj Lista de associado cadastrados
     */
    public function buscarAssociado()
    {
        # Recebe dados
        $search                     = new stdClass();
        $search->draw               = $this->input->post('draw');
        $search->orderByColumnIndex = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $search->orderBy            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'][$search->orderByColumnIndex]['data'] : "dt_solicitacao";
        $search->orderType          = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['dir'] : "ASC";
        $search->start              = $this->input->post('start');
        $search->length             = $this->input->post('length');
        $search->filter             = !empty($_POST['search']['value']) ? $_POST['search']['value'] : NULL;
        $search->columns            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'] : NULL;

        # Instanciar modelo
        $resposta = $this->Associado_model->getAssociados($search);

        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de visualização de associado
     *
     * @method ver
     * @access public
     * @return void
     */
    public function ver($id_associado = NULL)
    {
        # Titulo da pagina
        $header['titulo'] = "Visualiza&ccedil;&atilde;o de Associado";

        # Sql para busca
        $this->db->select('a.id_associado_req_pk, a.nome, a.cpf, a.email, a.telefone, a.endereco, a.num_endereco, a.bairro,
                           a.cep, a.id_cidade_fk, a.id_estado_fk, a.dt_solicitacao, e.estado, e.sigla, c.cidade');
        $this->db->from('tb_associado_req a');
        $this->db->join('tb_cidade c', 'c.id_cidade_pk = a.id_cidade_fk', 'inner');
        $this->db->join('tb_estado e', 'e.id_estado_pk = a.id_estado_fk', 'inner');
        $this->db->where('a.id_associado_req_pk', $id_associado);
        $data['associado'] = $this->db->get()->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('associado/associado_ver', $data);
        $this->load->view('admin/footer_admin');
    }

}

/* End of file Associado.php */
/* Location: ./application/controllers/Associado.php */