<?php
# Dados do Conselho
$id          = isset($conselho[0]->id_cons_fiscal_pk) ? $conselho[0]->id_cons_fiscal_pk : "";
$conselheiro = isset($conselho[0]->conselheiro) ? $conselho[0]->conselheiro : "";
$suplente    = isset($conselho[0]->suplente) ? $conselho[0]->suplente : "";
?>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Estrutura -->
    <link rel="stylesheet" href="<?=base_url('assets/css/estrutura.css')?>">

    <!-- JS Estrutura -->
    <script src="<?= base_url('scripts/js/estrutura.js?cache=').time() ?>"></script>

    <div class="wrapper">

        <!-- Menu -->
        <?php require_once(APPPATH.'views/admin/menu.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edi&ccedil;&atilde;o da Conselho Fiscal
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active"><i class="fa fa-building-o" aria-hidden="true"></i> Estrutura</li>
                    <li>
                        <a href="<?= base_url('./admin/estrutura/conselho') ?>">Conselho Fiscal</a>
                    </li>
                    <li class="active">Editar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-xs-12">

                        <div class="container-fluid box box-primary" id="box-frm-estrutura">

                            <div class="box-header with-border">
                                <span class="text-danger">*</span> Campo com preenchimento obrigat&oacute;rio
                            </div>
                            
                            <form role="form" name="frm_edit_conselho" id="frm_edit_conselho">

                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="conselheiro">Conselheiro<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="conselheiro" name="conselheiro" placeholder="Conselheiro" maxlength="150" required="true" value="<?=$conselheiro?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5">
                                                <label for="suplente">Suplente<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="suplente" id="suplente" value="s" <?=$suplente == "s" ? "checked" : ""?>> <div class="radio-position">Sim</div>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="suplente" id="suplente" value="n" <?=$suplente == "n" ? "checked" : ""?>> <div class="radio-position">N&atilde;o</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <input type="hidden" id="id_conselho" name="id_conselho" value="<?=$id?>">
                                    <button type="submit" id="btn_edit_conselho" name="btn_edit_conselho" class="btn btn-success">Alterar</button>
                                    <button type="button" id="btn_back_conselho" name="btn_back_conselho" class="btn btn-primary">Voltar</button>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

    </div>
