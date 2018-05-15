<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Método principal para carregar a tela de login
     *
     * @method index
     * @access public
     * @return void
     */
    public function index()
    {
        $this->load->view('admin/header_admin');
        if ($this->session->userdata('user')):
            redirect(base_url("admin/main/dashboard"));
            $this->load->view('admin/footer_admin');
        else:
            $this->load->view('admin/login');
            $this->load->view('footer');
        endif;
    }

    /**
     * Método para autenticação de usuário
     *
     * @method login
     * @access public
     * @return void
     */
    public function login()
    {
        # Vars
        $retorno = new stdClass();
        $email   = $this->input->post('email');
        $senha   = sha1($this->input->post('pwd_empresa'));

        $this->db->select('u.id_usuario_pk, u.nome, u.email, u.id_perfil_fk, u.id_status_fk, p.perfil, DATE_FORMAT(u.dt_hr_cad, \'%d/%m/%Y\') AS dt_cad');
        $this->db->from('tb_usuario u');
        $this->db->join('tb_perfil p', 'u.id_perfil_fk = p.id_perfil_pk', 'inner');
        $this->db->where('u.email', $email);
        $this->db->where('u.senha', $senha);
        $this->db->where('u.id_status_fk', 1);
        $user = $this->db->get()->result();

        if (count($user) === 1) {
            $first_name = explode(" ", $user[0]->nome);

            $dados = array(
                'id_user'   => $user[0]->id_usuario_pk,
                'user'      => $user[0]->nome,
                'user_st'   => is_array($first_name) ? $first_name[0] : $user[0]->nome,
                'email'     => $user[0]->email,
                'id_perfil' => $user[0]->id_perfil_fk,
                'perfil'    => $user[0]->perfil,
                'dt_cad'    => $user[0]->dt_cad
            );
            $this->session->set_userdata($dados);

            $retorno->status = TRUE;
            $retorno->msg    = "OK";
            $retorno->url    = base_url("admin/main/dashboard");
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "E-mail e/ou Senha Inv&aacute;lida!";
            $retorno->url    = "";
        }

        print json_encode($retorno);
    }

    /**
     * Método load Dashboard
     *
     * @method dashboard
     * @access public
     * @return void
     */
    public function dashboard()
    {
        $data           = array();
        $data['titulo'] = "Dashboard";

        $this->load->view('admin/header_admin', $data);
        
        # Validar acesso
        if (!empty($this->session->userdata('user'))):
            $this->load->view('admin/dashboard');
        else:
            redirect(base_url("/"));
        endif;
        $this->load->view('admin/footer_admin');
    }

    /**
     * Método para efetuar o logout do gerenciador
     *
     * @method logoff
     * @access public
     * @return void
     */
    public function logoff()
    {
        $this->session->sess_destroy();
        redirect(base_url("/"));
    }
}

/* End of file Main.php */
/* Location: ./application/controllers/admin/Main.php */