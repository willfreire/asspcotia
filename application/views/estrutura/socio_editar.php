<?php
# Dados do Socio
$id  = isset($socio[0]->id_socio_pk) ? $socio[0]->id_socio_pk : "";
$soc = isset($socio[0]->socio) ? $socio[0]->socio : "";
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
                    Edi&ccedil;&atilde;o da S&oacute;cio
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active"><i class="fa fa-building-o" aria-hidden="true"></i> Estrutura</li>
                    <li>
                        <a href="<?= base_url('./admin/estrutura/socio') ?>">S&oacute;cio</a>
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
                            
                            <form role="form" name="frm_edit_socio" id="frm_edit_socio">

                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="socio">S&oacute;cio<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="socio" name="socio" placeholder="S&oacute;cio" maxlength="150" required="true" value="<?=$soc?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <input type="hidden" id="id_socio" name="id_socio" value="<?=$id?>">
                                    <button type="submit" id="btn_edit_socio" name="btn_edit_socio" class="btn btn-success">Alterar</button>
                                    <button type="button" id="btn_back_socio" name="btn_back_socio" class="btn btn-primary">Voltar</button>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

    </div>
