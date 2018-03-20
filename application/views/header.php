<!DOCTYPE html5>

<html>

    <head>
        <title>:: ASSPCotia - Associa&ccedil;&atilde;o dos Servidores da Sa&uacute;de P&uacute;blica de Cotia :: <?=isset($titulo) ? $titulo." ::" : ''?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Site institucional da Associa&ccedil;&atilde;o dos Servidores da Sa&uacute;de P&uacute;blica de Cotia">
        <meta name="keywords" content="associa&ccedil;&atilde;o,servidores,sa&uacute;de,p&uacute;blica,Cotia">
        <meta name="author" content="William Freire Alves">

        <!-- Fav Icons   -->
        <link rel="icon" href="<?=base_url('assets/imgs/favicon.png')?>" type="image/x-icon">

        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?=base_url('scripts/lib/bootstrap/css/bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap-dropdownhover.min.css')?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?=base_url('assets/css/font-awesome.min.css')?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?=base_url('assets/css/ionicons.min.css')?>">
        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,200,300,100,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400" rel="stylesheet">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?=base_url('scripts/plugins/datatables/dataTables.bootstrap.css')?>">
        <!-- Datepicker -->
        <link rel="stylesheet" href="<?=base_url('scripts/plugins/datepicker/datepicker3.css')?>">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?=base_url('scripts/plugins/daterangepicker/daterangepicker.css')?>">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?=base_url('scripts/plugins/select2/select2.min.css')?>">
        <!-- Zabuto Calendar -->
        <link rel="stylesheet" href="<?=base_url('scripts/plugins/zabuto_calendar/zabuto_calendar.min.css')?>">
        <!-- animate Effect -->
        <link rel="stylesheet" href="<?=base_url('assets/css/animate.css')?>">
        <!-- Main CSS -->
        <link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">
        <!-- Skin -->
        <link rel="stylesheet" href="<?=base_url('assets/css/skins/green.css')?>">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="<?=base_url('assets/css/responsive.css')?>">

        <!-- JavaScripts -->
        <!-- jQuery 2.2.3 -->
        <script src="<?=base_url('scripts/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?=base_url('scripts/lib/bootstrap/js/bootstrap.min.js')?>"></script>
        
        <!-- Bootstrap Validator -->
        <link rel="stylesheet" type="text/css" href="<?=base_url('scripts/plugins/bootstrap_validator/css/bootstrapValidator.min.css')?>">
        <script src="<?=base_url('scripts/plugins/bootstrap_validator/js/bootstrapValidator.min.js')?>"></script>
        <script src="<?=base_url('scripts/plugins/bootstrap_validator/js/language/pt_BR.js')?>"></script>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <script>
            // Pegar caminho em Javascript
            var currentLocation = window.location;
            var parser          = document.createElement('a');
                parser.href = currentLocation;

            var protocol = parser.protocol;
            var host     = parser.host;
            var hostname = parser.hostname;
            var port     = parser.port;
            var pathname = parser.pathname;
            var pathproj = pathname.split('/')[1];
            var hash     = parser.hash;
            var search   = parser.search;
            var origin   = parser.origin;
        </script>

    </head>
