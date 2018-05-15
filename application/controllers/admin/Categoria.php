<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        # Sessao
        if (!$this->session->userdata('user')) {
            redirect(base_url('./admin/'));
        }

        # Carregar modelo
        $this->load->model('Categoria_model');

    }

    /**
     * Método para carregar o gerenciamento de categorias
     *
     * @method index
     * @access public
     * @return void
     */
    public function index()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Categorias";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('categoria/categoria_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar o gerenciamento de categorias
     *
     * @method gerenciar
     * @access public
     * @return void
     */
    public function gerenciar()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Categorias";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('categoria/categoria_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar tela de cadastro de categoria
     *
     * @method cadastrar
     * @access public
     * @return void
     */
    public function cadastrar()
    {
        # Titulo da pagina
        $header['titulo'] = "Cadastro de Categoria";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('categoria/categoria_cadastrar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de cadastro de categoria
     *
     * @method create
     * @access public
     * @return obj Status da ação
     */
    public function create()
    {
        $categoria = new stdClass();
        $retorno   = new stdClass();
        $resposta  = "";

        $categoria->categoria = $this->input->post('categoria');

        if ($categoria->categoria != NULL) {
            $resposta = $this->Categoria_model->setCategoria($categoria);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para popular grid de gerenciamento de categoria
     *
     * @method buscarCategoria
     * @access public
     * @return obj Lista de categoria cadastrados
     */
    public function buscarCategoria()
    {
        # Recebe dados
        $search                     = new stdClass();
        $search->draw               = $this->input->post('draw');
        $search->orderByColumnIndex = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $search->orderBy            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'][$search->orderByColumnIndex]['data'] : "categoria";
        $search->orderType          = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['dir'] : "ASC";
        $search->start              = $this->input->post('start');
        $search->length             = $this->input->post('length');
        $search->filter             = !empty($_POST['search']['value']) ? $_POST['search']['value'] : NULL;
        $search->columns            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'] : NULL;

        # Instanciar modelo
        $resposta = $this->Categoria_model->getCategorias($search);

        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de edição de categoria
     *
     * @method editar
     * @access public
     * @return void
     */
    public function editar($id_categoria = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Edi&ccedil;&atilde;o de Categoria";

        # Sql para busca
        $this->db->where('id_categoria_pk', $id_categoria);
        $data['categoria'] = $this->db->get('tb_categoria')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('categoria/categoria_editar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de edicao de categoria
     *
     * @method update
     * @access public
     * @return obj Status da ação
     */
    public function update()
    {
        $categoria = new stdClass();
        $retorno   = new stdClass();
        $resposta  = "";

        $categoria->id        = $this->input->post('id_categoria');
        $categoria->categoria = $this->input->post('categoria');

        if ($categoria->id != NULL && $categoria->categoria != NULL) {
            $resposta = $this->Categoria_model->setCategoria($categoria);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de visualização de categoria
     *
     * @method ver
     * @access public
     * @return void
     */
    public function ver($id_categoria = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Visualiza&ccedil;&atilde;o de Categoria";

        # Sql para busca
        $this->db->where('id_categoria_pk', $id_categoria);
        $data['categoria'] = $this->db->get('tb_categoria')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('categoria/categoria_ver', $data);
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
        $retorno  =  new stdClass();
        $resposta = "";
        $id_categ = $this->input->post('id');

        if ($id_categ !== NULL) {
            $resposta = $this->Categoria_model->delCategoria($id_categ);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }
}

/* End of file Categoria.php */
/* Location: ./application/controllers/Categoria.php */