<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parceria extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        # Sessao
        if (!$this->session->userdata('user')) {
            redirect(base_url('./admin/'));
        }

        # Carregar modelo
        $this->load->model('Parceria_model');

    }

    /**
     * Método para carregar o gerenciamento de parcerias
     *
     * @method index
     * @access public
     * @return void
     */
    public function index()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Parcerias";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('parceria/parceria_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar o gerenciamento de parcerias
     *
     * @method gerenciar
     * @access public
     * @return void
     */
    public function gerenciar()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Parcerias";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('parceria/parceria_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar tela de cadastro de parceria
     *
     * @method cadastrar
     * @access public
     * @return void
     */
    public function cadastrar()
    {
        # Titulo da pagina
        $header['titulo'] = "Cadastro de Parceria";
        
        # Sql Categoria
        $this->db->order_by('categoria', 'ASC');
        $data['categorias'] = $this->db->get('tb_categoria')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('parceria/parceria_cadastrar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de cadastro de parceria
     *
     * @method create
     * @access public
     * @return obj Status da ação
     */
    public function create()
    {
        # Vars
        $parceria  = new stdClass();
        $retorno   = new stdClass();
        $resposta  = "";
        $path_proj = PATH_PROJ;

        # Verificar se há envio de arquivos
        if (isset($_FILES)) {
            # Imagem Principal
            # Diretorio
            if (isset($_FILES['img'])) {
                $output_dir = $path_proj."/assets/imgs/parcerias/";
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
                    $parceria->img = $fileName;
                }
            }
        }

        $parceria->categoria = $this->input->post('categoria');
        $parceria->nome      = $this->input->post('nome');
        $parceria->descricao = $this->input->post('descricao');
        $parceria->status    = $this->input->post('status');

        if ($parceria->categoria != NULL && $parceria->nome != NULL) {
            $resposta = $this->Parceria_model->setParceria($parceria);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para popular grid de gerenciamento de parceria
     *
     * @method buscarParceria
     * @access public
     * @return obj Lista de parceria cadastrados
     */
    public function buscarParceria()
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
        $resposta = $this->Parceria_model->getParcerias($search);

        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de edição de parceria
     *
     * @method editar
     * @access public
     * @return void
     */
    public function editar($id_parceria = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Edi&ccedil;&atilde;o de Parceria";

        # Sql Categoria
        $this->db->order_by('categoria', 'ASC');
        $data['categorias'] = $this->db->get('tb_categoria')->result();

        # Sql para busca
        $this->db->where('id_parceria_pk', $id_parceria);
        $data['parceria'] = $this->db->get('tb_parceria')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('parceria/parceria_editar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de edicao de parceria
     *
     * @method update
     * @access public
     * @return obj Status da ação
     */
    public function update()
    {
        $parceria  = new stdClass();
        $retorno   = new stdClass();
        $resposta  = "";
        $path_proj = PATH_PROJ;

        # Verificar se há envio de arquivos
        if (isset($_FILES['img']) && $_FILES['img']['name'] != "") {
            # Imagem Principal
            # Diretorio
            if (isset($_FILES['img'])) {
                $output_dir = $path_proj."/assets/imgs/parcerias/";
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
                    $parceria->img = $fileName;
                }
            }
        } else {
            $parceria->img = $this->input->post('img_anexo');
        }

        $parceria->id        = $this->input->post('id_parceria');
        $parceria->categoria = $this->input->post('categoria');
        $parceria->nome      = $this->input->post('nome');
        $parceria->descricao = $this->input->post('descricao');
        $parceria->status    = $this->input->post('status');

        if ($parceria->id != NULL && $parceria->categoria != NULL && $parceria->nome != NULL) {
            $resposta = $this->Parceria_model->setParceria($parceria);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de visualização de parceria
     *
     * @method ver
     * @access public
     * @return void
     */
    public function ver($id_parceria = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Visualiza&ccedil;&atilde;o de Parceria";

        # Sql para busca
        $this->db->select('p.id_parceria_pk, c.categoria, p.nome, p.descricao, p.img, s.status');
        $this->db->from('tb_parceria p');
        $this->db->join('tb_categoria c', 'c.id_categoria_pk = p.id_categoria_fk', 'inner');
        $this->db->join('tb_status s', 's.id_status_pk = p.id_status_fk', 'inner');
        $this->db->where('p.id_parceria_pk', $id_parceria);
        $data['parceria'] = $this->db->get()->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('parceria/parceria_ver', $data);
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
        $retorno     =  new stdClass();
        $resposta    = "";
        $id_parceria = $this->input->post('id');

        if ($id_parceria !== NULL) {
            $resposta = $this->Parceria_model->delParceria($id_parceria);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }
}

/* End of file Parceria.php */
/* Location: ./application/controllers/Parceria.php */