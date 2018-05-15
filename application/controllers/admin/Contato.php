<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        # Sessao
        if (!$this->session->userdata('user')) {
            redirect(base_url('./admin/'));
        }

        # Carregar modelo
        $this->load->model('Contato_model');

    }

    /**
     * Método para carregar o gerenciamento de contatos
     *
     * @method index
     * @access public
     * @return void
     */
    public function index()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Contatos";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('contato/contato_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar o requerimento de contatos
     *
     * @method contato
     * @access public
     * @return void
     */
    public function contato()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Contatos";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('contato/contato_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para popular grid de gerenciamento de contato
     *
     * @method buscarContato
     * @access public
     * @return obj Lista de contato cadastrados
     */
    public function buscarContato()
    {
        # Recebe dados
        $search                     = new stdClass();
        $search->draw               = $this->input->post('draw');
        $search->orderByColumnIndex = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $search->orderBy            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'][$search->orderByColumnIndex]['data'] : "dt_hr";
        $search->orderType          = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['dir'] : "ASC";
        $search->start              = $this->input->post('start');
        $search->length             = $this->input->post('length');
        $search->filter             = !empty($_POST['search']['value']) ? $_POST['search']['value'] : NULL;
        $search->columns            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'] : NULL;

        # Instanciar modelo
        $resposta = $this->Contato_model->getContatos($search);

        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de visualização de contato
     *
     * @method ver
     * @access public
     * @return void
     */
    public function ver($id_contato = NULL)
    {
        # Titulo da pagina
        $header['titulo'] = "Visualiza&ccedil;&atilde;o de Contato";

        # Sql para busca
        $this->db->select("c.id_contato_pk, c.nome, c.email, c.telefone, a.area_interesse, c.mensagem, DATE_FORMAT(dt_hr, '%d/%m/%Y %H:%i') AS dt_hr, 
                           CASE viewed WHEN 's' THEN 'Sim' WHEN 'n' THEN 'Não' END AS viewed", FALSE);
        $this->db->from('tb_contato c');
        $this->db->join('tb_area_interesse a', 'a.id_area_interesse_pk = c.id_area_interesse_fk', 'inner');
        $this->db->where('c.id_contato_pk', $id_contato);
        $data['contato'] = $this->db->get()->result();
        
        # Alterar Status
        if (!empty($data['contato']) && $data['contato'][0]->viewed == "Não"):
            $this->db->where('id_contato_pk', $id_contato);
            $this->db->update('tb_contato', array('viewed' => 's'));
        endif;

        $this->load->view('admin/header_admin', $header);
        $this->load->view('contato/contato_ver', $data);
        $this->load->view('admin/footer_admin');
    }

}

/* End of file Contato.php */
/* Location: ./application/controllers/Contato.php */