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
                    Cadastro de Despesa
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= base_url('./admin/main/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active"><i class="fa fa-money" aria-hidden="true"></i> Financeiros</li>
                    <li>
                        <a href="<?= base_url('./admin/financeiro/despesa') ?>">Despesas</a>
                    </li>
                    <li class="active">Cadastrar</li>
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
                            
                            <form role="form" name="frm_cad_despesa" id="frm_cad_despesa">

                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5 col-sm-5 col-md-4 col-lg-3">
                                                <label for="ano">Ano<span class="text-danger">*</span></label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="ano" name="ano" placeholder="ano" maxlength="4" required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                                <label for="vl_fixado">Valor Fixado</label>
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><strong>R$</strong></span>
                                                        <input type="text" class="form-control" id="vl_fixado" name="vl_fixado" placeholder="0,00" maxlength="10" value="0,00">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-6 col-md-5 col-lg-4">
                                                <label for="vl_gasto">Valor Gasto</label>
                                                <div class="controls">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><strong>R$</strong></span>
                                                        <input type="text" class="form-control" id="vl_gasto" name="vl_gasto" placeholder="0,00" maxlength="10" value="0,00">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button type="submit" id="btn_cad_despesa" name="btn_cad_despesa" class="btn btn-success">Cadastrar</button>
                                    <button type="reset" id="limpar" name="limpar" class="btn btn-primary">Limpar</button>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </section>

        </div>
        <!-- /.content-wrapper -->

    </div>
