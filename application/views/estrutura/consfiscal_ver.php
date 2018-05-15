<?php
# Dados do Conselho
$id          = isset($conselho[0]->id_cons_fiscal_pk) ? $conselho[0]->id_cons_fiscal_pk : "";
$conselheiro = isset($conselho[0]->conselheiro) ? $conselho[0]->conselheiro : "";
$suplente    = isset($conselho[0]->suplente) && $conselho[0]->suplente == "s" ? "Sim" : "N&atilde;o";
?>

<style>
    .box-footer {
        background-color: transparent;
    }
</style>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Estrutura -->
    <link rel="stylesheet" href="<?= base_url('assets/css/estrutura.css') ?>">

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
                    Visualiza&ccedil;&atilde;o de Conselho Fiscal
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active"><i class="fa fa-building-o" aria-hidden="true"></i> Estrutura</li>
                    <li>
                        <a href="<?= base_url('./admin/estrutura/conselho') ?>">Conselho Fiscal</a>
                    </li>
                    <li class="active">Visualizar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-xs-12">

                        <div class="box box-wrapper-50">

                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Conselheiro</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$conselheiro?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Suplente</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$suplente?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center" style="padding: 0px;">
                                        <div class="box-footer">
                                            <button type="button" id="btn_back_conselho" name="btn_back_conselho" class="btn btn-primary">Voltar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>

                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

    </div>
