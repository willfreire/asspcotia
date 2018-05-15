<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contato_model extends CI_Model {

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
     * Método responsável por pesquisar e buscar contatos
     *
     * @method getContatos
     * @param obj $search Conjuntos de dados para realizar a pesquisa
     * @access public
     * @return obj Lista de contatos
     */
    public function getContatos($search)
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
                    if ($column == "viewed" && strtolower($this->filter) == "sim") {
                        $this->filter = "s";
                    } elseif ($column == "viewed" && strtolower($this->filter) == "não") {
                        $this->filter = "n";
                    }
                    $filter[]= "$column LIKE '%{$this->filter}%'";
                endif;
            endfor;
        endif;

        # Contar total de registros
        $this->db->select('COUNT(c.id_contato_pk) AS total');
        $this->db->from('tb_contato c');
        $this->db->join('tb_area_interesse a', 'a.id_area_interesse_pk = c.id_area_interesse_fk', 'inner');
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

        # Consultar contatos
        $this->db->select("c.id_contato_pk, c.nome, c.email, c.telefone, a.area_interesse, c.mensagem, DATE_FORMAT(dt_hr, '%d/%m/%Y %H:%i') AS dt_hr, 
                           CASE viewed WHEN 's' THEN 'Sim' WHEN 'n' THEN 'Não' END AS viewed", FALSE);
        $this->db->from('tb_contato c');
        $this->db->join('tb_area_interesse a', 'a.id_area_interesse_pk = c.id_area_interesse_fk', 'inner');
        if (!empty($filter)):
            $where = implode(" OR ", $filter);
            $this->db->where($where);
        endif;
        $this->db->order_by($this->orderBy, $this->orderType);
        $this->db->limit($this->length, $this->start);
        $query_dados = $this->db->get();
        $resp_dados  = $query_dados->result();

        # Criar classe predefinida
        $contacts = array();
        if (!empty($resp_dados)):

            foreach ($resp_dados as $value):
                # Botao
                $id_contato = $value->id_contato_pk;
                # $url_edit = base_url('./admin/contato/editar/'.$id_contato);
                $url_view   = base_url('./admin/contato/ver/'.$id_contato);
                # $acao     = "<button type='button' class='btn btn-success btn-xs btn-acao' title='Editar Contato' onclick='Contato.redirect(\"$url_edit\")'><i class='glyphicon glyphicon-edit' aria-hidden='true'></i></button>";
                $acao       = "<button type='button' class='btn btn-warning btn-xs btn-acao' title='Visualizar Contato' onclick='Contato.redirect(\"$url_view\")'><i class='glyphicon glyphicon-eye-open' aria-hidden='true'></i></button>";
                # $acao    .= "<button type='button' class='btn btn-danger btn-xs btn-acao' title='Excluir Contato' onclick='Contato.del(\"$id_contato\")'><i class='glyphicon glyphicon-remove' aria-hidden='true'></i></button>";

                $contact                 = new stdClass();
                $contact->dt_hr          = $value->dt_hr;
                $contact->nome           = $value->nome;
                $contact->email          = $value->email;
                $contact->telefone       = $value->telefone;
                $contact->area_interesse = $value->area_interesse;
                $contact->viewed         = $value->viewed;
                $contact->acao           = $acao;
                $contacts[]              = $contact;
            endforeach;

        endif;

        $dados['draw']            = intval($this->draw);
        $dados['recordsTotal']    = $this->recordsTotal;
        $dados['recordsFiltered'] = $this->recordsTotal;
        $dados['data']            = $contacts;

        return $dados;
    }
}

/* End of file contato_model.php */
/* Location: ./application/models/contato_model.php */