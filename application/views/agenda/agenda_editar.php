<?php
# Dados do Agenda
$id        = isset($agenda[0]->id_agenda_pk) ? $agenda[0]->id_agenda_pk : "";
$dt_agenda = isset($agenda[0]->dt_agenda) ? explode("-", $agenda[0]->dt_agenda) : "";
$data      = is_array($dt_agenda) ? $dt_agenda[2]."/".$dt_agenda[1]."/".$dt_agenda[0] : "";
$horario   = isset($agenda[0]->horario) ? $agenda[0]->horario : "";
$titulo    = isset($agenda[0]->titulo) ? $agenda[0]->titulo : "";
$descricao = isset($agenda[0]->descricao) ? $agenda[0]->descricao : "";
?>

<body class="hold-transition skin-green-light sidebar-mini">

    <!-- CSS Agenda -->
    <link rel="stylesheet" href="<?=base_url('assets/css/agenda.css')?>">

    <!-- JS Agenda -->
    <script src="<?= base_url('scripts/js/agenda.js?cache=').time() ?>"></script>

    <div class="wrapper">

        <!-- Menu -->
        <?php require_once(APPPATH.'views/admin/menu.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Edi&ccedil;&atilde;o de Agenda
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= base_url('./admin/agenda') ?>"><i class="fa fa-calendar" aria-hidden="true"></i> Agendas</a>
                    </li>
                    <li class="active">Editar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-xs-12">

                        <div class="container-fluid box box-primary" id="box-frm-agenda">

                            <div class="box-header with-border">
                                <span class="text-danger">*</span> Campo com preenchimento obrigat&oacute;rio
                            </div>
                            
                            <form role="form" name="frm_edit_agenda" id="frm_edit_agenda">

                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-9 col-sm-5 col-md-5 col-lg-4">
                                                <label for="dt_agenda">Data<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="datepicker form-control" data-date-format="dd/mm/yyyy" name="dt_agenda" id="dt_agenda" placeholder="dd/mm/aaaa" value="<?=$data?>" maxlength="10" readonly required="true" autofocus="true">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-9 col-sm-5 col-md-5 col-lg-4">
                                                <label for="horario">Hor&aacute;rio</label>
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="glyphicon glyphicon-time"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="horario" name="horario" placeholder="00:00" maxlength="20" value="<?=$horario?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="titulo">T&iacute;tulo<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="T&iacute;tulo" maxlength="200" required="true" value="<?=$titulo?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <label for="descricao">Descri&ccedil;&atilde;o</label>
                                                <div class="controls">
                                                    <textarea class="form-control" id="descricao" name="descricao" placeholder="Descri&ccedil;&atilde;o" maxlength="1000" rows="5"><?=$descricao?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <input type="hidden" id="id_agenda" name="id_agenda" value="<?=$id?>">
                                    <button type="submit" id="btn_edit_agenda" name="btn_edit_agenda" class="btn btn-success">Alterar</button>
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
