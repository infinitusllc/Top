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
    include "includes/get_generics.inc.php";
    $keyword = -1;
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
    }

    $lang_key = -1;
    if (isset($_GET['lang'])) {
        $lang_key = $_GET['lang'];
    }

    $lang = 'geo';
    switch ($lang_key) {
        case 2:
            $lang = 'eng';
            break;
        case  3:
            $lang = 'rus';
            break;
    }
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