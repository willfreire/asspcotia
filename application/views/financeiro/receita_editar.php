<?php
# Dados da Receita
$id            = isset($receita[0]->id_receita_pk) ? $receita[0]->id_receita_pk : "";
$ano           = isset($receita[0]->ano) ? $receita[0]->ano : "";
$vl_previsto   = isset($receita[0]->vl_previsto) ? number_format($receita[0]->vl_previsto, 2, ',', '.') : "0,00";
$vl_arrecadado = isset($receita[0]->vl_arrecadado) ? number_format($receita[0]->vl_arrecadado, 2, ',', '.') : "0,00";
?>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Financeiro -->
    <link rel="stylesheet" href="<?=base_url('assets/css/financeiro.css')?>">

    <!-- JS Financeiro -->
    <script src="<?= base_url('scripts/js/financeiro.js?cache=').time() ?>"></script>

    <div class="wrapper">

        <!-- Menu -->
        <?php require_once(APPPATH.'views/admin/menu.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edi&ccedil;&atilde;o de Receita
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active"><i class="fa fa-money" aria-hidden="true"></i> Financeiros</li>
                    <li>
                        <a href="<?= base_url('./admin/financeiro/receita') ?>">Receitas</a>
                    </li>
                    <li class="active">Editar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-xs-12">

                        <div class="container-fluid box box-primary" id="box-frm-financeiro">

                            <div class="box-header with-border">
                                <span class="text-danger">*</span> Campo com preenchimento obrigat&oacute;rio
                            </div>
                            
                            <form role="form" name="frm_edit_receita" id="frm_edit_receita">

                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3">
                                                <label for="ano">Ano<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="ano" name="ano" placeholder="ano" maxlength="4" required="true" value="<?=$ano?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                                <label for="vl_previsto">Valor Previsto</label>
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><strong>R$</strong></span>
                                                        <input type="text" class="form-control" id="vl_previsto" name="vl_previsto" placeholder="0,00" maxlength="10" value="<?=$vl_previsto?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                                <label for="vl_arrecadado">Valor Arrecadado</label>
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><strong>R$</strong></span>
                                                        <input type="text" class="form-control" id="vl_arrecadado" name="vl_arrecadado" placeholder="0,00" maxlength="10" value="<?=$vl_arrecadado?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <input type="hidden" id="id_receita" name="id_receita" value="<?=$id?>">
                                    <button type="submit" id="btn_edit_receita" name="btn_edit_receita" class="btn btn-success">Alterar</button>
                                    <button type="button" id="btn_back_receita" name="btn_back_receita" class="btn btn-primary">Voltar</button>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

    </div>
