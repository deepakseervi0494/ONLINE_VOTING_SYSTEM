<?php
require_once("../../admin/inc/config.php");
date_default_timezone_set("Asia/Calcutta");
if (isset($_POST['e_id']) && isset($_POST['c_id']) && isset($_POST['v_id'])) {
    $vote_date = date("Y-m-d");
    $vote_time = date("H:i:s");

    $query = "INSERT INTO votings(election_id, voters_id, candidate_id, vote_date, vote_time) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "iiiss", $_POST['e_id'], $_POST['v_id'], $_POST['c_id'], $vote_date, $vote_time);

    if (mysqli_stmt_execute($stmt)) {
        echo "Success";
    } else {
        error_log("Failed to insert vote: " . mysqli_error($db));
        echo "Error";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid parameters";
}
?>
