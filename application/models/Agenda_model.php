<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_model extends CI_Model {

    # Propriedades
    public $draw;
    public $orderBy;
    public $orderType;
    public $start;
    public $length;
    public $filter;
    public $columns;
    public $recordsTotal;
    public $recordsFiltered;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Método responsável por cadastrar / editar uma agenda
     *
     * @method setAgenda
     * @param obj $valores Dados para cadastro / edicao
     * @access public
     * @return obj Status de ação
     */
    public function setAgenda($valores)
    {
        # Atribuir vars
        $retorno = new stdClass();
        $dados   = array();
        $log     = array();

        # Data
        $dt_agend = isset($valores->dt_agenda) && $valores->dt_agenda != "" ? explode("/", $valores->dt_agenda) : NULL;

        $dados['agenda_url'] = convert_accented_characters(url_title($valores->titulo, "dash", TRUE));
        $dados['dt_agenda']  = is_array($dt_agend) ? $dt_agend[2].'-'.$dt_agend[1].'-'.$dt_agend[0] : NULL;
        $dados['horario']    = $valores->horario;
        $dados['titulo']     = $valores->titulo;
        $dados['descricao']  = $valores->descricao;

        if (isset($valores->id) && $valores->id != ""):
            # Atualiza agenda
            $this->db->where('id_agenda_pk', $valores->id);
            $this->db->update('tb_agenda', $dados);

            if ($this->db->affected_rows() >= 0) {
                $retorno->status = TRUE;
                $retorno->msg    = "Edi&ccedil;&atilde;o realizada com Sucesso!";
                # Gravar Log
                $log['id_acao_pk']    = 2;
                $log['id_usuario_fk'] = $this->session->userdata('id_user');
                $log['id_agenda_fk']  = $valores->id;
                $log['dt_hr_cad']     = date("Y-m-d H:i");
                $this->db->insert('tb_agenda_log', $log);
            } else {
                $retorno->status = FALSE;
                $retorno->msg    = "Houve um erro ao editar! Tente novamente...";
            }
        else:
            # Grava agenda
            $this->db->insert('tb_agenda', $dados);

            if ($this->db->affected_rows() > 0) {
                $retorno->status = TRUE;
                $retorno->msg    = "Cadastro realizado com Sucesso!";
                # Gravar Log
                $log['id_acao_pk']    = 1;
                $log['id_usuario_fk'] = $this->session->userdata('id_user');
                $log['id_agenda_fk']  = $this->db->insert_id();
                $log['dt_hr_cad']     = date("Y-m-d H:i");
                $this->db->insert('tb_agenda_log', $log);
            } else {
                $retorno->status = FALSE;
                $retorno->msg    = "Houve um erro ao cadastrar! Tente novamente...";
            }
        endif;

        # retornar
        return $retorno;
    }

    /**
     * Método responsável por pesquisar e buscar agendas
     *
     * @method getAgendas
     * @param obj $search Conjuntos de dados para realizar a pesquisa
     * @access public
     * @return obj Lista de agendas
     */
    public function getAgendas($search)
    {
        # Atribuir valores
        $this->draw      = $search->draw;
        $this->orderBy   = $search->orderBy;
        $this->orderType = $search->orderType;
        $this->start     = $search->start;
        $this->length    = $search->length;
        $this->filter    = $search->filter;
        $this->columns   = $search->columns;
        $filter          = array();
        $where           = array();

        # Se houver busca pela grid
        if ($this->filter != NULL):
            for($i=0; $i<count($this->columns); $i++):
                if ($this->columns[$i]['searchable'] === "true"):
                    $column = $this->columns[$i]['data'];
                    $filter[]= "$column LIKE '%{$this->filter}%'";
                endif;
            endfor;
        endif;

        # Contar total de registros
        $this->db->select('COUNT(id_agenda_pk) AS total');
        $this->db->from('tb_agenda');
        if (!empty($filter)):
            $where = implode(" OR ", $filter);
            $this->db->where($where);
        endif;
        $query            = $this->db->get();
        $respRecordsTotal = $query->result();
        if (!empty($respRecordsTotal)):
            $this->recordsTotal = $respRecordsTotal[0]->total;
        else:
            $this->recordsTotal = 0;
        endif;

        # Consultar agendas
        $this->db->select('id_agenda_pk, dt_agenda, horario, titulo');
        $this->db->from('tb_agenda');
        if (!empty($filter)):
            $where = implode(" OR ", $filter);
            $this->db->where($where);
        endif;
        $this->db->order_by($this->orderBy, $this->orderType);
        $this->db->limit($this->length, $this->start);
        $query_dados = $this->db->get();
        $resp_dados  = $query_dados->result();

        # Criar classe predefinida
        $agends = array();
        if (!empty($resp_dados)):

            foreach ($resp_dados as $value):
                # Botao
                $id_agenda = $value->id_agenda_pk;
                $url_edit  = base_url('./admin/agenda/editar/'.$id_agenda);
                $url_view  = base_url('./admin/agenda/ver/'.$id_agenda);
                $acao      = "<button type='button' class='btn btn-success btn-xs btn-acao' title='Editar Agenda' onclick='Agenda.redirect(\"$url_edit\")'><i class='glyphicon glyphicon-edit' aria-hidden='true'></i></button>";
                $acao     .= "<button type='button' class='btn btn-warning btn-xs btn-acao' title='Visualizar Agenda' onclick='Agenda.redirect(\"$url_view\")'><i class='glyphicon glyphicon-eye-open' aria-hidden='true'></i></button>";
                $acao     .= "<button type='button' class='btn btn-danger btn-xs btn-acao' title='Excluir Agenda' onclick='Agenda.del(\"$id_agenda\")'><i class='glyphicon glyphicon-remove' aria-hidden='true'></i></button>";

                # Data
                $dt_agenda = date("d/m/Y", strtotime($value->dt_agenda));

                $agend            = new stdClass();
                $agend->dt_agenda = $dt_agenda;
                $agend->horario   = isset($value->horario) && $value->horario != "" ? $value->horario : "N&atilde;o Informado";
                $agend->titulo    = $value->titulo;
                $agend->acao      = $acao;
                $agends[]         = $agend;
            endforeach;

        endif;

        $dados['draw']            = intval($this->draw);
        $dados['recordsTotal']    = $this->recordsTotal;
        $dados['recordsFiltered'] = $this->recordsTotal;
        $dados['data']            = $agends;

        return $dados;
    }

    /**
     * Método de exclusão de um Agenda
     *
     * @method delAgenda
     * @access public
     * @param integer $id Id do registro a ser excluído
     * @return obj Status da ação
     */
    public function delAgenda($id)
    {
        # Atribuir vars
        $retorno = new stdClass();
        $log     = array();

        # SQL
        $this->db->where('id_agenda_pk', $id);
        $this->db->delete('tb_agenda');

        if ($this->db->affected_rows() > 0) {
            $retorno->status = TRUE;
            $retorno->msg    = "Exclus&atilde;o realizada com Sucesso!";
            # Gravar Log
            $log['id_acao_pk']    = 3;
            $log['id_usuario_fk'] = $this->session->userdata('id_user');
            $log['id_agenda_fk']  = $id;
            $log['dt_hr_cad']     = date("Y-m-d H:i");
            $this->db->insert('tb_agenda_log', $log);
        } else {
            $retorno->status = FALSE;
            $retorno->msg    = "Houve um erro ao Excluir! Tente novamente...";
        }

        # retornar
        return $retorno;
    }
}

/* End of file agenda_model.php */
/* Location: ./application/models/agenda_model.php */