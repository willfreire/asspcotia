<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        # Sessao
        if (!$this->session->userdata('user')) {
            redirect(base_url('./admin/'));
        }

        # Carregar modelo
        $this->load->model('Banner_model');

    }

    /**
     * Método para carregar o gerenciamento de banners
     *
     * @method index
     * @access public
     * @return void
     */
    public function index()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Banners";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('banner/banner_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar o gerenciamento de banners
     *
     * @method gerenciar
     * @access public
     * @return void
     */
    public function gerenciar()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Banners";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('banner/banner_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar tela de cadastro de banner
     *
     * @method cadastrar
     * @access public
     * @return void
     */
    public function cadastrar()
    {
        # Titulo da pagina
        $header['titulo'] = "Cadastro de Banner";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('banner/banner_cadastrar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de cadastro de banner
     *
     * @method create
     * @access public
     * @return obj Status da ação
     */
    public function create()
    {
        # Vars
        $banner    = new stdClass();
        $retorno   = new stdClass();
        $resposta  = "";
        $path_proj = PATH_PROJ;

        # Verificar se há envio de arquivos
        if (isset($_FILES)) {
            # Diretorio
            if (isset($_FILES['img'])) {
                $output_dir = $path_proj."/assets/imgs/banners/";
            }

            # Msg Error
            if (isset($_FILES['img']["error"])) {
                $error = $_FILES["img"]["error"];
            }

            # File Temp
            if (isset($_FILES['img']["tmp_name"])) {
                $file_tmp = $_FILES["img"]["tmp_name"];
            }

            # File name
            if (isset($_FILES['img']["name"])) {
                $file_name = $_FILES["img"]["name"];
            }

            # Verificar Sistema Operacional
            $so = filter_input(INPUT_SERVER, 'SERVER_SIGNATURE');

            if (!is_array($file_name)) {
                if (strpos($so, "Win")):
                    $fileName = iconv("UTF-8", "CP1252", $file_name);
                else:
                    $fileName = $file_name;
                endif;

                if (move_uploaded_file($file_tmp, $output_dir.$fileName)) {
                    $banner->img = $fileName;
                }
            }
        }

        $banner->titulo    = $this->input->post('titulo');
        $banner->subtitulo = $this->input->post('subtitulo');
        $banner->descricao = $this->input->post('descricao');
        $banner->btn_link  = $this->input->post('btn_link');
        $banner->btn_text  = $this->input->post('btn_text');
        $banner->pos_elem  = $this->input->post('pos_elem');
        $banner->status    = $this->input->post('status');

        if ($banner->img != NULL && $banner->titulo != NULL && $banner->pos_elem != NULL) {
            $resposta = $this->Banner_model->setBanner($banner);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para popular grid de gerenciamento de banner
     *
     * @method buscarBanner
     * @access public
     * @return obj Lista de banner cadastrados
     */
    public function buscarBanner()
    {
        # Recebe dados
        $search                     = new stdClass();
        $search->draw               = $this->input->post('draw');
        $search->orderByColumnIndex = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $search->orderBy            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'][$search->orderByColumnIndex]['data'] : "title";
        $search->orderType          = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['dir'] : "ASC";
        $search->start              = $this->input->post('start');
        $search->length             = $this->input->post('length');
        $search->filter             = !empty($_POST['search']['value']) ? $_POST['search']['value'] : NULL;
        $search->columns            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'] : NULL;

        # Instanciar modelo
        $resposta = $this->Banner_model->getBanners($search);

        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de edição de banner
     *
     * @method editar
     * @access public
     * @return void
     */
    public function editar($id_banner = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Edi&ccedil;&atilde;o de Banner";

        # Sql para busca
        $this->db->where('id_banner_pk', $id_banner);
        $data['banner'] = $this->db->get('tb_banner')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('banner/banner_editar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de edicao de banner
     *
     * @method update
     * @access public
     * @return obj Status da ação
     */
    public function update()
    {
        $banner  = new stdClass();
        $retorno   = new stdClass();
        $resposta  = "";
        $path_proj = PATH_PROJ;

        # Verificar se há envio de arquivos
        if (isset($_FILES['img']) && $_FILES['img']['name'] != "") {
            # Imagem Principal
            # Diretorio
            if (isset($_FILES['img'])) {
                $output_dir = $path_proj."/assets/imgs/banners/";
            }

            # Msg Error
            if (isset($_FILES['img']["error"])) {
                $error = $_FILES["img"]["error"];
            }

            # File Temp
            if (isset($_FILES['img']["tmp_name"])) {
                $file_tmp = $_FILES["img"]["tmp_name"];
            }

            # File name
            if (isset($_FILES['img']["name"])) {
                $file_name = $_FILES["img"]["name"];
            }

            # Verificar Sistema Operacional
            $so = filter_input(INPUT_SERVER, 'SERVER_SIGNATURE');

            if (!is_array($file_name)) {
                if (strpos($so, "Win")):
                    $fileName = iconv("UTF-8", "CP1252", $file_name);
                else:
                    $fileName = $file_name;
                endif;

                if (move_uploaded_file($file_tmp, $output_dir.$fileName)) {
                    $banner->img = $fileName;
                }
            }
        } else {
            $banner->img = $this->input->post('img_anexo');
        }

        $banner->id        = $this->input->post('id_banner');
        $banner->titulo    = $this->input->post('titulo');
        $banner->subtitulo = $this->input->post('subtitulo');
        $banner->descricao = $this->input->post('descricao');
        $banner->btn_link  = $this->input->post('btn_link');
        $banner->btn_text  = $this->input->post('btn_text');
        $banner->pos_elem  = $this->input->post('pos_elem');
        $banner->status    = $this->input->post('status');

        if ($banner->id != NULL && $banner->img != NULL && $banner->titulo != NULL && $banner->pos_elem != NULL) {
            $resposta = $this->Banner_model->setBanner($banner);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de visualização de banner
     *
     * @method ver
     * @access public
     * @return void
     */
    public function ver($id_banner = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Visualiza&ccedil;&atilde;o de Banner";

        # Sql para busca
        $this->db->select("b.id_banner_pk, b.img, b.title, b.subtitle, b.description, b.btn_text, b.btn_link, 
                           CASE b.pos_elem
                                WHEN 'text-left' THEN 'À Esquerda'
                                WHEN 'text-center' THEN 'Centralizado'
                                WHEN 'text-right' THEN 'À Direita'
                           END AS pos_elem, b.id_status_fk, s.status", FALSE);
        $this->db->from('tb_banner b');
        $this->db->join('tb_status s', 's.id_status_pk = b.id_status_fk', 'inner');
        $this->db->where('b.id_banner_pk', $id_banner);
        $data['banner'] = $this->db->get()->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('banner/banner_ver', $data);
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
        $id_banner = $this->input->post('id');

        if ($id_banner !== NULL) {
            $resposta = $this->Banner_model->delBanner($id_banner);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }
}

/* End of file Banner.php */
/* Location: ./application/controllers/Banner.php */