<?php

    function getHeadersByLangKey($lang_key) {
        include "dbc.inc.php";

        $sql = "SELECT * FROM header_links INNER JOIN header_content ON id = group_id WHERE lang_key = $lang_key";
        $result = mysqli_query($conn, $sql);

        $r = [];
        while ($row = mysqli_fetch_assoc($result))
            array_push($r, $row);

        return $r;
    }

    function getHeadersByLevel($lang_key, $level) {
        include "dbc.inc.php";

        $sql = "SELECT * FROM header_links INNER JOIN header_content ON id = group_id WHERE lang_key = $lang_key and `level` = $level";
        $result = mysqli_query($conn, $sql);

        $r = [];
        while ($row = mysqli_fetch_assoc($result))
            array_push($r, $row);

        return $r;
    }

    function getHeadersByID ($lang_key, $id) {
        include "dbc.inc.php";

        $sql = "SELECT * FROM header_links INNER JOIN header_content ON id = group_id WHERE lang_key = $lang_key and id = $id";
        $result = mysqli_query($conn, $sql);

        $r = [];
        while ($row = mysqli_fetch_assoc($result))
            array_push($r, $row);

        return $r[0];
    }

    function getHeadersByKeyword ($lang_key, $keyword) {
        include "dbc.inc.php";

        $sql = "SELECT * FROM header_links INNER JOIN header_content ON id = group_id WHERE lang_key = $lang_key and keyword = '$keyword'";
        $result = mysqli_query($conn, $sql);

        $r = [];
        while ($row = mysqli_fetch_assoc($result))
            array_push($r, $row);

        return $r[0];
    }

    function getHeadersByParent ($lang_key, $parent_id) {
        include "dbc.inc.php";

        $sql = "SELECT * FROM header_links INNER JOIN header_content ON id = group_id WHERE lang_key = $lang_key and parent_id = $parent_id";
        $result = mysqli_query($conn, $sql);

        $r = [];
        while ($row = mysqli_fetch_assoc($result))
            array_push($r, $row);

        return $r;
    }

    function getHeaders() {
        include "dbc.inc.php";

        $sql = "SELECT * FROM header_links INNER JOIN header_content ON id = group_id GROUP BY group_id";
        $result = mysqli_query($conn, $sql);

        $r = [];
        while ($row = mysqli_fetch_assoc($result))
            array_push($r, $row);

        return $r;
    }