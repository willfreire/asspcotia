<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        # Sessao
        if (!$this->session->userdata('user')) {
            redirect(base_url('./admin/'));
        }

        # Carregar modelo
        $this->load->model('Noticia_model');

    }

    /**
     * Método para carregar o gerenciamento de noticias
     *
     * @method index
     * @access public
     * @return void
     */
    public function index()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Noticias";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('noticia/noticia_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar o gerenciamento de noticias
     *
     * @method gerenciar
     * @access public
     * @return void
     */
    public function gerenciar()
    {
        # Titulo da pagina
        $header['titulo'] = "Gerenciamento de Not&iacute;cias";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('noticia/noticia_gerenciar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para carregar tela de cadastro de noticia
     *
     * @method cadastrar
     * @access public
     * @return void
     */
    public function cadastrar()
    {
        # Titulo da pagina
        $header['titulo'] = "Cadastro de Not&iacute;cia";

        $this->load->view('admin/header_admin', $header);
        $this->load->view('noticia/noticia_cadastrar');
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de cadastro de noticia
     *
     * @method create
     * @access public
     * @return obj Status da ação
     */
    public function create()
    {
        # Vars
        $noticia   = new stdClass();
        $retorno   = new stdClass();
        $resposta  = "";
        $path_proj = PATH_PROJ;

        # Verificar se há envio de arquivos
        if (isset($_FILES)) {
            # Imagem Principal
            # Diretorio
            if (isset($_FILES['img'])) {
                $output_dir = $path_proj."/assets/imgs/noticias/";
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
                    $noticia->img = $fileName;
                }
            }
        }

        $noticia->titulo  = $this->input->post('titulo');
        $noticia->noticia = $this->input->post('noticia');
        $noticia->status  = $this->input->post('status');

        if ($noticia->titulo != NULL && $noticia->status != NULL) {
            $resposta = $this->Noticia_model->setNoticia($noticia);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para realizar upload do editor
     *
     * @method saveFile
     * @access public
     * @return obj Status da ação
     */
    public function saveFile()
    {
        # Vars
        $upload    = new stdClass();
        $path_proj = PATH_PROJ;

        if (isset($_FILES)) {
            # Diretorio
            if (isset($_FILES['file'])) {
                $output_dir = $path_proj."/assets/imgs/noticias/";
            }

            # Msg Error
            if (isset($_FILES['file']["error"])) {
                $error = $_FILES["file"]["error"];
            }

            # File Temp
            if (isset($_FILES['file']["tmp_name"])) {
                $file_tmp = $_FILES["file"]["tmp_name"];
            }

            # File name
            if (isset($_FILES['file']["name"])) {
                $file_name = $_FILES["file"]["name"];
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
                    chmod($output_dir.$fileName, 0777);
                    $upload->url = base_url('assets/imgs/noticias/'.$fileName);
                    $upload->img = $fileName;
                }
            }
        }
        print json_encode($upload);
    }

    /**
     * Método para popular grid de gerenciamento de noticia
     *
     * @method buscarNoticia
     * @access public
     * @return obj Lista de noticia cadastrados
     */
    public function buscarNoticia()
    {
        # Recebe dados
        $search                     = new stdClass();
        $search->draw               = $this->input->post('draw');
        $search->orderByColumnIndex = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['column'] : 0;
        $search->orderBy            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'][$search->orderByColumnIndex]['data'] : "dt_cadastro";
        $search->orderType          = !empty($_POST['order']) && is_array($_POST['order']) ? $_POST['order'][0]['dir'] : "ASC";
        $search->start              = $this->input->post('start');
        $search->length             = $this->input->post('length');
        $search->filter             = !empty($_POST['search']['value']) ? $_POST['search']['value'] : NULL;
        $search->columns            = !empty($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'] : NULL;

        # Instanciar modelo
        $resposta = $this->Noticia_model->getNoticias($search);

        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de edição de noticia
     *
     * @method editar
     * @access public
     * @return void
     */
    public function editar($id_noticia = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Edi&ccedil;&atilde;o de Not&iacute;cia";

        # Sql para busca
        $this->db->where('id_noticia_pk', $id_noticia);
        $data['noticia'] = $this->db->get('tb_noticia')->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('noticia/noticia_editar', $data);
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método de edicao de noticia
     *
     * @method update
     * @access public
     * @return obj Status da ação
     */
    public function update()
    {
        $noticia   = new stdClass();
        $retorno   = new stdClass();
        $resposta  = "";
        $path_proj = PATH_PROJ;

        # Verificar se há envio de arquivos
        if (isset($_FILES['img']) && $_FILES['img']['name'] != "") {
            # Imagem Principal
            # Diretorio
            if (isset($_FILES['img'])) {
                $output_dir = $path_proj."/assets/imgs/noticias/";
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
                    $noticia->img = $fileName;
                }
            }
        } else {
            $noticia->img = $this->input->post('img_anexo');
        }

        $noticia->id      = $this->input->post('id_noticia');
        $noticia->titulo  = $this->input->post('titulo');
        $noticia->noticia = $this->input->post('noticia');
        $noticia->status  = $this->input->post('status');

        if ($noticia->id != NULL && $noticia->titulo != NULL && $noticia->status != NULL) {
            $resposta = $this->Noticia_model->setNoticia($noticia);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }

    /**
     * Método para carregar tela de visualização de noticia
     *
     * @method ver
     * @access public
     * @return void
     */
    public function ver($id_noticia = null)
    {
        # Titulo da pagina
        $header['titulo'] = "Visualiza&ccedil;&atilde;o de Not&iacute;cia";

        # Sql para busca
        $this->db->select('n.id_noticia_pk, n.noticia_url, n.titulo, n.img, n.noticia, n.id_status_fk, n.dt_cadastro, s.status');
        $this->db->from('tb_noticia n');
        $this->db->join('tb_status s', 's.id_status_pk = n.id_status_fk', 'inner');
        $this->db->where('n.id_noticia_pk', $id_noticia);
        $data['noticia'] = $this->db->get()->result();

        $this->load->view('admin/header_admin', $header);
        $this->load->view('noticia/noticia_ver', $data);
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
        $retorno    =  new stdClass();
        $resposta   = "";
        $id_noticia = $this->input->post('id');

        if ($id_noticia !== NULL) {
            $resposta = $this->Noticia_model->delNoticia($id_noticia);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
            $resposta        = $retorno;
        }

        # retornar resultado
        print json_encode($resposta);
    }
}

/* End of file Noticia.php */
/* Location: ./application/controllers/Noticia.php */