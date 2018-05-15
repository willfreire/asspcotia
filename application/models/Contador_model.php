<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contador_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Método responsável salvar contador de visitas
     *
     * @method visitas
     * @access public
     * @return obj Quantidade de Visitas
     */
    public function visitas()
    {
        # Verificar se Cookie existe
        if (!filter_input(INPUT_COOKIE, 'count_asspcotia', FILTER_SANITIZE_NUMBER_INT)) {
            # Dados
            $contador          = array();
            $contador['dt_hr'] = date("Y-m-d H:i:s");
            $contador['ip']    = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_URL);
            $contador['ip4']   = ip2long(filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_URL));
            $this->db->insert('tb_visita', $contador);
        }

        setcookie('count_asspcotia', 1, time()+60*60*24);

        # Consultar
        $consulta = $this->db->query('SELECT COUNT(*) as visitas FROM tb_visita');
        $res      = $consulta->row();

        return $res;
    }

}
/* End of file Contador_model.php */
/* Location: ./application/models/Contador_model.php */