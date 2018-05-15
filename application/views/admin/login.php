<body class="hold-transition login-page">

    <!-- CSS Login -->
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

    <!-- JS Login -->
    <script src="<?= base_url('scripts/js/login.js') ?>"></script>

    <div class="login-box container-fluid">

        <div class="login-logo">
            <a href="<?= base_url('/') ?>">
                <img src="<?= base_url('assets/imgs/logotipo_asspcotia.jpg') ?>" alt="Logo ASSPCOTIA">
            </a>
        </div>

        <div class="login-box-body break_block">
            <h3 class="login-box-msg">&Aacute;rea Administrativa</h3>
            <form role="form" name="frm_login_empresa" id="frm_login_empresa">
                <div class="form-group has-feedback">
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" maxlength="250">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="pwd_empresa" id="pwd_empresa" class="form-control" placeholder="Senha" maxlength="50">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-7 col-lg-7">&nbsp;</div>
                    <div class="col-xs-4 col-sm-4 col-md-5 col-lg-5">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" id="btn_access"><strong>Acessar</strong></button>
                    </div>
                </div>
            </form>
        </div>

    </div>