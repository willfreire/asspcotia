<?php
# Dados da Despesa
$id        = isset($despesa[0]->id_despesa_pk) ? $despesa[0]->id_despesa_pk : "";
$ano       = isset($despesa[0]->ano) ? $despesa[0]->ano : "";
$vl_fixado = isset($despesa[0]->vl_fix_final) ? number_format($despesa[0]->vl_fix_final, 2, ',', '.') : "0,00";
$vl_gasto  = isset($despesa[0]->vl_gasto) ? number_format($despesa[0]->vl_gasto, 2, ',', '.') : "0,00";
?>

<style>
    .box-footer {
        background-color: transparent;
    }
</style>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Financeiro -->
    <link rel="stylesheet" href="<?= base_url('assets/css/financeiro.css') ?>">

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
                    Visualiza&ccedil;&atilde;o de Despesa
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active"><i class="fa fa-money" aria-hidden="true"></i> Financeiros</li>
                    <li>
                        <a href="<?= base_url('./admin/financeiro/despesa') ?>">Despesas</a>
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
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Ano</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10"><?=$ano?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Valor Fixado</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">R$ <?=$vl_fixado?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2"><strong>Valor Gasto</strong></div>
                                    <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">R$ <?=$vl_gasto?></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center" style="padding: 0px;">
                                        <div class="box-footer">
                                            <button type="button" id="btn_back_despesa" name="btn_back_despesa" class="btn btn-primary">Voltar</button>
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
