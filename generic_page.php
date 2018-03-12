<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> TopTravel </title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

</head>
<body>

    <div style="width: 70%; margin: 80px auto auto;">
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
            ?> <h1 style="text-align: center"> <?php echo $generics[$keyword][$lang_key]['title']; ?> </h1></br>
                <h4 style="text-align: center"> <?php echo $generics[$keyword][$lang_key]['intro']; ?> </h4></br>
                <div style="max-width: 60%; margin:auto"> <?php echo $generics[$keyword][$lang_key]['content']; ?> </div>

    </div>

</body>