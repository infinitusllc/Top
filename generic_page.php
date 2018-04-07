<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> TopTravel </title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    <?php include "mods/style.mod.php"; ?>
</head>


<body>

<?php
    if (session_id() == '' || !isset($_SESSION)) // session isn't started
        session_start();
    include "includes/get_generics.inc.php";
    $keyword = -1;
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $_SESSION['keyword'] = $keyword;
    }

    $keyword = $_SESSION['keyword'];

    $lang = 'geo';
    if (isset($_GET['lang'])) {
        $lang = $_GET['lang'];
    }

    $lang_key = 1;
    switch ($lang) {
        case 'rus':
            $lang_key = '3';
            break;
        case  'eng':
            $lang_key = '2';
            break;
    }

    $_SESSION['lang_key'] = $lang_key;
    $_SESSION['lang'] = $lang;
    include "mods/header.comm.mod.php";
?>

<div class="container-common">
    <h2> 
		<?php echo $generics[$keyword][$lang_key]['title']; ?> 
	</h2>
    <div class="content"> <?php echo $generics[$keyword][$lang_key]['content']; ?> </div>
</div>
<?php include "mods/footer.mod.php"; ?>
</body>