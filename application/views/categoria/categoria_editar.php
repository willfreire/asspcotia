<?php
# Dados do Categoria
$id        = isset($categoria[0]->id_categoria_pk) ? $categoria[0]->id_categoria_pk : "";
$categoria = isset($categoria[0]->categoria) ? $categoria[0]->categoria : "";
?>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Categoria -->
    <link rel="stylesheet" href="<?=base_url('assets/css/categoria.css')?>">

    <!-- JS Categoria -->
    <script src="<?= base_url('scripts/js/categoria.js?cache=').time() ?>"></script>

    <div class="wrapper">

        <!-- Menu -->
        <?php require_once(APPPATH.'views/admin/menu.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edi&ccedil;&atilde;o de Categoria
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= base_url('./admin/categoria') ?>"><i class="fa fa-tags" aria-hidden="true"></i> Categorias</a>
                    </li>
                    <li class="active">Editar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-xs-12">

                        <div class="container-fluid box box-primary" id="box-frm-categoria">

                            <div class="box-header with-border">
                                <span class="text-danger">*</span> Campo com preenchimento obrigat&oacute;rio
                            </div>
                            
                            <form role="form" name="frm_edit_categoria" id="frm_edit_categoria">

                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="categoria">Categoria<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria" maxlength="50" required="true" value="<?=$categoria?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <input type="hidden" id="id_categoria" name="id_categoria" value="<?=$id?>">
                                    <button type="submit" id="btn_edit_categoria" name="btn_edit_categoria" class="btn btn-success">Alterar</button>
                                    <button type="button" id="btn_back" name="btn_back" class="btn btn-primary">Voltar</button>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

    </div>
