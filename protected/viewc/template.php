<html>

<head>
    <title>PPM</title>
    <link rel='stylesheet' type='text/css' href='/global/css/main.css' />
    <link rel='stylesheet' type='text/css' href='/global/css/responsive.css' />
    <script src="/global/js/plugins.js"></script>
</head>

<body>
    
<div id='container'>
<?php
include_once "nav.php";
?>
<main>
<?php
include $this->data['content'].'.php';
include_once "footer.php";
?>
</main>
</div>

</body>

                                               
<script src="/global/js/validation.js"></script>
<script src="/global/js/main.js"></script>
</html>
