<?php include 'dbcon.php'; ?>
<?php include 'fetch.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete-button'])) {
    // Loop through the selected titles
    foreach ($_POST['delete_titles'] as $title_id) {
        // Delete associated records from many-to-many table (title_tags)
        $delete_associated_sql1 = "DELETE FROM title_tags WHERE title_id = ?";
        $stmt1 = mysqli_prepare($conn, $delete_associated_sql1);
        mysqli_stmt_bind_param($stmt1, "i", $title_id);
        mysqli_stmt_execute($stmt1);

        $delete_unused_tags_sql = "DELETE FROM tags WHERE id NOT IN (SELECT tag_id FROM title_tags)";
        mysqli_query($conn, $delete_unused_tags_sql);
        
        // Delete associated records from another many-to-many table (title_images)
        $delete_associated_sql2 = "DELETE FROM title_images WHERE title_id = ?";
        $stmt2 = mysqli_prepare($conn, $delete_associated_sql2);
        mysqli_stmt_bind_param($stmt2, "i", $title_id);
        mysqli_stmt_execute($stmt2);

        $delete_unused_images_sql = "DELETE FROM images WHERE id NOT IN (SELECT image_id FROM title_images)";
        mysqli_query($conn, $delete_unused_images_sql);
        
        // Now, delete the title from the places table
        $delete_title_sql = "DELETE FROM places WHERE id = ?";
        $stmt3 = mysqli_prepare($conn, $delete_title_sql);
        mysqli_stmt_bind_param($stmt3, "i", $title_id);
        mysqli_stmt_execute($stmt3);
        
        // Check for errors or success messages as needed
    }
    header("Location: index.php");
} else {
    echo "No titles selected for removal.";
    var_dump(isset($_POST['delete-button'])) ;
}

?>