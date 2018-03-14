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
    include "includes/get_tour.inc.php";
    $id = -1;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $lang_key = -1;
    if (isset($_GET['lang'])) {
        $lang_key = $_GET['lang'];
    }

    $tour = getTour($id);
    $tour_content = getTourContent($id, $lang_key);
    $tour_images = getTourImages($id);

    ?>
    <h1 style="text-align: center"> <?php echo $tour_content['tour_name']; ?> </h1></br>
    <h4 style="text-align: center"> <?php echo $tour_content['tour_intro']; ?> </h4></br>
    <div style="max-width: 60%; margin:auto"> <?php echo $tour_content['tour_description']; ?> </div>

    <div name="images" style="width: 800px; margin: auto">
        <?php for ($i=0; $i<sizeof($tour_images); $i++) {
            if ($i == 0) echo "<p style='text-align: center'> ძირითადი სურათი: </p>"
            ?>
            <img src="<?php echo $tour_images[$i]['image_url'] ?>" style="width:800px; margin-bottom: 100px"> </br>
        <?php } ?>
    </div>

</div>

</body>