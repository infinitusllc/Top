<h2 style="text-align: center"> <a href="admin2.php?tab=tourForm"> ახლის დამატება </a> </h2>

<div class="mainArea">

    <?php
        require_once "includes/get_tour.inc.php";
        $tours = getAllTours();
        foreach ($tours as $tour) {
            $id = $tour['tour_id'];
            $content = getTourContent($id, 'geo');
            $images = getTourImages($id); ?>

            <div class="cell">
                <h3> <a href="tour_page.php?id=<?php echo $id; ?>"> <?php echo $content['tour_name']; ?> </a></h3>
                <img src="<?php echo $images[0]['image_url']; ?>" width="80%"> <br>
                <p class="link"> <a href="admin2.php?tab=tourForm&id=<?php echo $id; ?>"> შეცვლა </a> </p>
                <p class="link"> <a href="includes/delete_tour.inc.php?id=<?php echo $id; ?>"> წაშლა </a> </p>
            </div>

            <?php
        }
    ?>

</div>