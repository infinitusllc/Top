<div class="col-md-4 category">
    <?php
    require_once "includes/categories.inc.php";

    $types = getTypes($lang_key);
    foreach ($types as $type) {?>
        <form id="<?php echo $type['tour_type'].'_tours'; ?>" method="post" action="includes/tour_search.inc.php">
            <input type="hidden" name="tour_type" value="<?php echo $type['id']; ?>">
            <h4> <a href="#" onclick="document.getElementById(<?php echo "'".$type['tour_type']."_tours'"; ?>).submit();"><?php echo $type['tour_type']; ?></a></h4>
        </form>
        <?php
        $categories = getCategoriesByType($lang_key, $type['group_id']);
        ?>
        <ul class="type-list">
            <?php foreach ($categories as $category) { ?>
                <form id="<?php echo $category['tour_category'].'_category'; ?>" method="post" action="includes/tour_search.inc.php">
                    <input type="hidden" name="tour_category" value="<?php echo $category['tour_category_id']; ?>">
                    <input type="hidden" name="tour_type" value="<?php echo $type['id']; ?>">
                    <li class="category-list-item">- <a href="#" onclick="document.getElementById(<?php echo "'".$category['tour_category']."_category'"; ?>).submit();"> <?php echo $category['tour_category']; ?> </a> </li>
                </form>
            <?php } ?>
        </ul>
    <?php } ?>
</div>