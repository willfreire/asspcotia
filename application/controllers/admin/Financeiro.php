<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Financeiro extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        # Sessao
        if (!$this->session->userdata('user')) {
            redirect(base_url('./admin/'));
        }

        # Carregar modelo
        $this->load->model('Financeiro_model');

    }

    /**
     * Método para carregar o gerenciamento de Despesas
     *
     * @method index
     * @access public
     * @return void
     */
    public function index()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Despesas";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('financeiro/despesa_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar o gerenciamento das Despesas
     *
     * @method despesa
     * @access public
     * @return void
     */
    public function despesa()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Despesas";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('financeiro/despesa_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar o gerenciamento das Receitas
     *
     * @method receita
     * @access public
     * @return void
     */
    public function receita()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Receitas";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('financeiro/receita_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar tela de cadastro de despesa
     *
     * @method despesa_cadastrar
     * @access public
     * @return void
     */
    public function despesa_cadastrar()
    {
        # Titulo da pagina
        $header['titulo'] = "Cadastro de Despesa";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('financeiro/despesa_cadastrar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar tela de cadastro de receita
     *
     * @method receita_cadastrar
     * @access public
     * @return void
     */
    public function receita_cadastrar()
    {
        # Titulo da pagina
        $header['titulo'] = "Cadastro de Receita";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('financeiro/receita_cadastrar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de cadastro de Despesa
     *
     * @method createDespesa
     * @access public
     * @return obj Status da ação
     */
    public function createDespesa()
    {
        $despesa  = new stdClass();
        $retorno  = new stdClass();
        $resposta = "";

        $despesa->ano       = $this->input->post('ano');
        $despesa->vl_fixado = $this->input->post('vl_fixado');
        $despesa->vl_gasto  = $this->input->post('vl_gasto');

        if ($despesa->ano != NULL) {
            $resposta = $this->Financeiro_model->setDespesa($despesa);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método de cadastro de Receita
     *
     * @method createReceita
     * @access public
     * @return obj Status da ação
     */
    public function createReceita()
    {
        $receita  = new stdClass();
        $retorno  = new stdClass();
        $resposta = "";

        $receita->ano           = $this->input->post('ano');
        $receita->vl_previsto   = $this->input->post('vl_previsto');
        $receita->vl_arrecadado = $this->input->post('vl_arrecadado');

        if ($receita->ano != NULL) {
            $resposta = $this->Financeiro_model->setReceita($receita);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para popular grid de gerenciamento de despesas
     *
     * @method buscarDespesa
     * @access public
     * @return obj Lista de despesas cadastrados
     */
    public function buscarDespesa()
    {
        # Recebe dados
        $search                     = new stdClass();
        $search->draw               = $this->input->post('draw');
        $search->orderByColumnIndex = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $search->orderBy            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'][$search->orderByColumnIndex]['data'] : "ano";
        $search->orderType          = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['dir'] : "ASC";
        $search->start              = $this->input->post('start');
        $search->length             = $this->input->post('length');
        $search->filter             = !empty($_POST['search']['value']) ? $_POST['search']['value'] : NULL;
        $search->columns            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'] : NULL;

        # Instanciar modelo
        $resposta = $this->Financeiro_model->getDespesas($search);

        print json_encode($resposta);
    }

    /**
     * Método para popular grid de gerenciamento de Receitas
     *
     * @method buscarReceita
     * @access public
     * @return obj Lista de receitas cadastrados
     */
    public function buscarReceita()
    {
        # Recebe dados
        $search                     = new stdClass();
        $search->draw               = $this->input->post('draw');
        $search->orderByColumnIndex = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $search->orderBy            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'][$search->orderByColumnIndex]['data'] : "ano";
        $search->orderType          = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['dir'] : "ASC";
        $search->start              = $this->input->post('start');
        $search->length             = $this->input->post('length');
        $search->filter             = !empty($_POST['search']['value']) ? $_POST['search']['value'] : NULL;
        $search->columns            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'] : NULL;

        # Instanciar modelo
        $resposta = $this->Financeiro_model->getReceitas($search);

        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de edição de Despesa
     *
     * @method despesa_editar
     * @access public
     * @return void
     */
    public function despesa_editar($id_despesa = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Edi&ccedil;&atilde;o de Despesa";

        # Sql para busca
        $this->db->where('id_despesa_pk', $id_despesa);
        $data['despesa'] = $this->db->get('tb_despesa')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('financeiro/despesa_editar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar tela de edição de Receita
     *
     * @method receita_editar
     * @access public
     * @return void
     */
    public function receita_editar($id_despesa = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Edi&ccedil;&atilde;o de Receita";

        # Sql para busca
        $this->db->where('id_receita_pk', $id_despesa);
        $data['receita'] = $this->db->get('tb_receita')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('financeiro/receita_editar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de edicao de Despesa
     *
     * @method updateDespesa
     * @access public
     * @return obj Status da ação
     */
    public function updateDespesa()
    {
        $despesa  = new stdClass();
        $retorno  = new stdClass();
        $resposta = "";

        $despesa->id        = $this->input->post('id_despesa');
        $despesa->ano       = $this->input->post('ano');
        $despesa->vl_fixado = $this->input->post('vl_fixado');
        $despesa->vl_gasto  = $this->input->post('vl_gasto');

        if ($despesa->id != NULL && $despesa->ano != NULL) {
            $resposta = $this->Financeiro_model->setDespesa($despesa);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método de edicao de Receita
     *
     * @method updateReceita
     * @access public
     * @return obj Status da ação
     */
    public function updateReceita()
    {
        $receita  = new stdClass();
        $retorno  = new stdClass();
        $resposta = "";

        $receita->id            = $this->input->post('id_receita');
        $receita->ano           = $this->input->post('ano');
        $receita->vl_previsto   = $this->input->post('vl_previsto');
        $receita->vl_arrecadado = $this->input->post('vl_arrecadado');

        if ($receita->id != NULL && $receita->ano != NULL) {
            $resposta = $this->Financeiro_model->setReceita($receita);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de visualização de Despesa
     *
     * @method despesa_ver
     * @access public
     * @return void
     */
    public function despesa_ver($id_despesa = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Visualiza&ccedil;&atilde;o de Despesa";

        # Sql para busca
        $this->db->where('id_despesa_pk', $id_despesa);
        $data['despesa'] = $this->db->get('tb_despesa')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('financeiro/despesa_ver', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método responsável pela exclusão de um registro da Despesa
     *
     * @method deleteDespesa
     * @access public
     * @return obj Status da ação
     */
    public function deleteDespesa()
    {
        $retorno    =  new stdClass();
        $resposta   = "";
        $id_despesa = $this->input->post('id');

        if ($id_despesa !== NULL) {
            $resposta = $this->Financeiro_model->delDespesa($id_despesa);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método responsável pela exclusão de um registro da Receita
     *
     * @method deleteReceita
     * @access public
     * @return obj Status da ação
     */
    public function deleteReceita()
    {
        $retorno    =  new stdClass();
        $resposta   = "";
        $id_receita = $this->input->post('id');

        if ($id_receita !== NULL) {
            $resposta = $this->Financeiro_model->delReceita($id_receita);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }
}

/* End of file Financeiro.php */
/* Location: ./application/controllers/Financeiro.php */