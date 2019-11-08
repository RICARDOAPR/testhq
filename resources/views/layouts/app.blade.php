<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<meta charset="utf-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>HQrental</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
 
 
<!-- <link class="main-stylesheet" href="css/pages.css" rel="stylesheet" type="text/css"/>
<link class="main-stylesheet" href="css/style.css" rel="stylesheet" type="text/css"/> -->

<script>
        window.testhqrental = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
</script> 

</head>

<body class="pace-complete" style="background-color: #f5f5f5 !important;">
@yield('content')
<script type="text/javascript" src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<!-- <script type="text/javascript" src="js/pages.frontend.js"></script>  -->
@yield('scripts')

</body>
</html>
