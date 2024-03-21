<?php include 'dbcon.php'; ?>
<?php include 'fetch.php'; ?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $tags = $_POST['tags'];
    $tagsArray = explode(',', $tags);

    // Process thumbnail upload
    $thumbnail_name = $_FILES['thumbnail']['name'];
    $thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];
    $thumbnail_errors = $_FILES['thumbnail']['error'];

    if ($thumbnail_errors === 0) {
        $img_ex = pathinfo($thumbnail_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $filepath = "thumbnails/" . $new_img_name;
            move_uploaded_file($thumbnail_tmp_name, $filepath);

            // Insert thumbnail file path into database
            $sql = "INSERT INTO places (title, location, description, thumbnail) VALUES ('$name', '$location', '$description', '$filepath')";
            $places = mysqli_query($conn, $sql);
            $titleId = $conn->insert_id;

            if ($places) {
                echo "Thumbnail uploaded and inserted into database successfully.";
            } else {
                echo "Error inserting data into database: " . mysqli_error($conn);
            }
        } else {
            echo "Invalid file extension. Only JPG, JPEG, and PNG files are allowed.";
        }
    } else {
        echo "Error uploading thumbnail file. Error code: " . $thumbnail_errors;
    }

    $file_names = array_filter($_FILES['images']['name']);
    $file_order = array_keys($file_names);
    $file_names = $_FILES['images']['name'];
    $file_tmp_names = $_FILES['images']['tmp_name'];
    $file_errors = $_FILES['images']['error'];

    foreach ($file_names as $key => $file_name) {
    $error = $file_errors[$key];

        if ($error === 0) {
            $tmp_name = $file_tmp_names[$key];
            $img_ex = pathinfo($file_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

        $insert_file_query = "INSERT INTO images (image_url) VALUES ('$new_img_name')";
        $conn->query($insert_file_query);
        $imageId = $conn->insert_id;

        $query = "INSERT INTO title_images (title_id, image_id) VALUES ($titleId, $imageId)";
        $conn->query($query);
            }else{
                echo "Invalid file extension. Only JPG, JPEG, and PNG files are allowed.";
            }
        } else{
            echo "Error uploading file. Error code: " . $error;
        }
    } 

    foreach ($tagsArray as $tagName) {
        $tagName = trim($tagName);
        if (!empty($tagName)) {
            $tagname = "INSERT INTO tags (tag_name) VALUES ('$tagName')";
            $conn->query($tagname);
            $tagId = $conn->insert_id;

            $query = "INSERT INTO title_tags (title_id, tag_id) VALUES ($titleId, $tagId)";
            $conn->query($query);
        }
    }

    
    header("Location: index.php");
}
?>

<?php
 include 'html.php'; 
?>
