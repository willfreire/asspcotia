<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estrutura extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        # Sessao
        if (!$this->session->userdata('user')) {
            redirect(base_url('./admin/'));
        }

        # Carregar modelo
        $this->load->model('Estrutura_model');

    }

    /**
     * Método Index
     *
     * @method index
     * @access public
     * @return void
     */
    public function index()
    {
        redirect(base_url('./admin/'));
    }

    /**
     * Método para carregar tela de edição da Presidencia
     *
     * @method presidencia
     * @access public
     * @return void
     */
    public function presidencia()
    {
        # Titulo da pagina
        $header['titulo'] = "Edi&ccedil;&atilde;o da Presid&ecirc;ncia";

        # Sql para busca
        $this->db->where('id_presidencia_pk', 1);
        $data['presid'] = $this->db->get('tb_presidencia')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('estrutura/presidencia_editar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de edicao de Presidencia
     *
     * @method updatePresidencia
     * @access public
     * @return obj Status da ação
     */
    public function updatePresidencia()
    {
        $presid   = new stdClass();
        $retorno  = new stdClass();
        $resposta = "";

        $presid->id         = $this->input->post('id_presidencia');
        $presid->presidente = $this->input->post('presidente');
        $presid->vice       = $this->input->post('vice');

        if ($presid->id != NULL && $presid->presidente != NULL && $presid->vice != NULL) {
            $resposta = $this->Estrutura_model->setPresidencia($presid);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de edição da Secretaria
     *
     * @method secretaria
     * @access public
     * @return void
     */
    public function secretaria()
    {
        # Titulo da pagina
        $header['titulo'] = "Edi&ccedil;&atilde;o da Secretaria";

        # Sql para busca
        $this->db->where('id_secretaria_pk', 1);
        $data['secret'] = $this->db->get('tb_secretaria')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('estrutura/secretaria_editar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de edicao de Secretaria
     *
     * @method updateSecretaria
     * @access public
     * @return obj Status da ação
     */
    public function updateSecretaria()
    {
        $secreta  = new stdClass();
        $retorno  = new stdClass();
        $resposta = "";

        $secreta->id            = $this->input->post('id_secretaria');
        $secreta->st_secretario = $this->input->post('st_secretario');
        $secreta->rd_secretario = $this->input->post('rd_secretario');

        if ($secreta->id != NULL && $secreta->st_secretario != NULL && $secreta->rd_secretario != NULL) {
            $resposta = $this->Estrutura_model->setSecretaria($secreta);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar o gerenciamento de Conselho Fiscal
     *
     * @method conselho
     * @access public
     * @return void
     */
    public function conselho()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Conselho Fiscal";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('estrutura/consfiscal_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para popular grid de gerenciamento de Conselho Fiscal
     *
     * @method buscarConselho
     * @access public
     * @return obj Lista de conselheiros cadastrados
     */
    public function buscarConselho()
    {
        # Recebe dados
        $search                     = new stdClass();
        $search->draw               = $this->input->post('draw');
        $search->orderByColumnIndex = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $search->orderBy            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'][$search->orderByColumnIndex]['data'] : "conselheiro";
        $search->orderType          = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['dir'] : "ASC";
        $search->start              = $this->input->post('start');
        $search->length             = $this->input->post('length');
        $search->filter             = !empty($_POST['search']['value']) ? $_POST['search']['value'] : NULL;
        $search->columns            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'] : NULL;

        # Instanciar modelo
        $resposta = $this->Estrutura_model->getConselho($search);

        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de cadastro de Conselho Fiscal
     *
     * @method conselho_cadastrar
     * @access public
     * @return void
     */
    public function conselho_cadastrar()
    {
        # Titulo da pagina
        $header['titulo'] = "Cadastro de Conselho Fiscal";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('estrutura/consfiscal_cadastrar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de cadastro de Conselho Fiscal
     *
     * @method createConselho
     * @access public
     * @return obj Status da ação
     */
    public function createConselho()
    {
        $conselho = new stdClass();
        $retorno  = new stdClass();
        $resposta = "";

        $conselho->conselheiro = $this->input->post('conselheiro');
        $conselho->suplente    = $this->input->post('suplente');

        if ($conselho->conselheiro != NULL && $conselho->suplente != NULL) {
            $resposta = $this->Estrutura_model->setConselho($conselho);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de edição de Conselho Fiscal
     *
     * @method conselho_editar
     * @access public
     * @return void
     */
    public function conselho_editar($id_conselho = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Edi&ccedil;&atilde;o de Conselho Fiscal";

        # Sql para busca
        $this->db->where('id_cons_fiscal_pk', $id_conselho);
        $data['conselho'] = $this->db->get('tb_cons_fiscal')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('estrutura/consfiscal_editar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de edicao de Conselho Fiscal
     *
     * @method updateConselho
     * @access public
     * @return obj Status da ação
     */
    public function updateConselho()
    {
        $conselho = new stdClass();
        $retorno  = new stdClass();
        $resposta = "";

        $conselho->id          = $this->input->post('id_conselho');
        $conselho->conselheiro = $this->input->post('conselheiro');
        $conselho->suplente    = $this->input->post('suplente');

        if ($conselho->id != NULL && $conselho->conselheiro != NULL && $conselho->suplente != NULL) {
            $resposta = $this->Estrutura_model->setConselho($conselho);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de visualização de Conselho Fiscal
     *
     * @method conselho_ver
     * @access public
     * @return void
     */
    public function conselho_ver($id_conselho = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Visualiza&ccedil;&atilde;o de Conselho Fiscal";

        # Sql para busca
        $this->db->where('id_cons_fiscal_pk', $id_conselho);
        $data['conselho'] = $this->db->get('tb_cons_fiscal')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('estrutura/consfiscal_ver', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método responsável pela exclusão de um registro do Conselho Fiscal
     *
     * @method deleteConselho
     * @access public
     * @return obj Status da ação
     */
    public function deleteConselho()
    {
        $retorno     =  new stdClass();
        $resposta    = "";
        $id_conselho = $this->input->post('id');

        if ($id_conselho !== NULL) {
            $resposta = $this->Estrutura_model->delConselho($id_conselho);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar o gerenciamento de Socios
     *
     * @method socio
     * @access public
     * @return void
     */
    public function socio()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de S&oacute;cios";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('estrutura/socio_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para popular grid de gerenciamento de Socios
     *
     * @method buscarSocio
     * @access public
     * @return obj Lista de socios cadastrados
     */
    public function buscarSocio()
    {
        # Recebe dados
        $search                     = new stdClass();
        $search->draw               = $this->input->post('draw');
        $search->orderByColumnIndex = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $search->orderBy            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'][$search->orderByColumnIndex]['data'] : "socio";
        $search->orderType          = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['dir'] : "ASC";
        $search->start              = $this->input->post('start');
        $search->length             = $this->input->post('length');
        $search->filter             = !empty($_POST['search']['value']) ? $_POST['search']['value'] : NULL;
        $search->columns            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'] : NULL;

        # Instanciar modelo
        $resposta = $this->Estrutura_model->getSocio($search);

        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de cadastro de Socio
     *
     * @method socio_cadastrar
     * @access public
     * @return void
     */
    public function socio_cadastrar()
    {
        # Titulo da pagina
        $header['titulo'] = "Cadastro de S&oacute;cio";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('estrutura/socio_cadastrar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de cadastro de Socio
     *
     * @method createSocio
     * @access public
     * @return obj Status da ação
     */
    public function createSocio()
    {
        $retorno      = new stdClass();
        $resposta     = "";
        $socio        = new stdClass();
        $socio->socio = $this->input->post('socio');

        if ($socio->socio != NULL) {
            $resposta = $this->Estrutura_model->setSocio($socio);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de edição de Socio
     *
     * @method socio_editar
     * @access public
     * @return void
     */
    public function socio_editar($id_socio = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Edi&ccedil;&atilde;o de S&oacute;cio";

        # Sql para busca
        $this->db->where('id_socio_pk', $id_socio);
        $data['socio'] = $this->db->get('tb_socio')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('estrutura/socio_editar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de edicao de Socio
     *
     * @method updateSocio
     * @access public
     * @return obj Status da ação
     */
    public function updateSocio()
    {
        $socio    = new stdClass();
        $retorno  = new stdClass();
        $resposta = "";

        $socio->id    = $this->input->post('id_socio');
        $socio->socio = $this->input->post('socio');

        if ($socio->id != NULL && $socio->socio != NULL) {
            $resposta = $this->Estrutura_model->setSocio($socio);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de visualização de Socio
     *
     * @method socio_ver
     * @access public
     * @return void
     */
    public function socio_ver($id_socio = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Visualiza&ccedil;&atilde;o de S&oacute;cio";

        # Sql para busca
        $this->db->where('id_socio_pk', $id_socio);
        $data['socio'] = $this->db->get('tb_socio')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('estrutura/socio_ver', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método responsável pela exclusão de um registro do Socio
     *
     * @method deleteSocio
     * @access public
     * @return obj Status da ação
     */
    public function deleteSocio()
    {
        $retorno  =  new stdClass();
        $resposta = "";
        $id_socio = $this->input->post('id');

        if ($id_socio !== NULL) {
            $resposta = $this->Estrutura_model->delSocio($id_socio);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }
}

/* End of file Estrutura.php */
/* Location: ./application/controllers/Estrutura.php */