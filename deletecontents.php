<?php include 'fetch.php'; ?>
<?php
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $title = $row['title'];
        echo '<input type="checkbox" name="delete_titles[]" value="' . $id . '" class="checkbox-delete"><span class="title-manage">' . $title . '</span><br>';
        
    }
    echo '<input type="submit" value="Remove Selected Titles" name="delete-button" class="submit-delete">';
} else {
    echo 'No titles found.';
}
?>