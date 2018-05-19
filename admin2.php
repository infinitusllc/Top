<head>
    <title> ადმინის გვერდი </title>
    <script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
    <link rel="stylesheet" type="text/css" href="css/adminStyle.css">
</head>

<body>
    <div class="topnav">
        <a href="admin2.php?tab=tours">ტურები</a>
        <a href="admin2.php?tab=combinations">კომბინაციები</a>
        <a href="admin2.php?tab=translations">თარგმნა</a>
        <a href="admin2.php?tab=slides">სლაიდები</a>
        <a href="admin2.php?tab=generic">generic გვერდები</a>
        <a href="admin2.php?tab=header">ჰედერის ლინკები</a>
        <a href="index.php" style="float: right">საიტზე დაბრუნება</a>
    </div>


    <?php
        session_start();
        $user = $_SESSION['user'];
        $tab = "tours";
        if (isset($_GET['tab']))
            $tab = $_GET['tab'];

        include "mods/admin/$tab.mod.php";
    ?>

</body>