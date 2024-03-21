<?php
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['title'];
            $location = $row['location'];
            $description = $row['description'];
            $thumbnail = $row['thumbnail'];
            $tags = explode(',', $row['tag_names']);
            $image_urls = explode(',', $row['image_urls']);
            $image_str = implode(',', $image_urls);
            $tags_str = implode(',', $tags);

            echo "<div class='picture-container' data-title='$title' data-location='$location' data-description='$description' data-thumbnail='$thumbnail' data-tags='$tags_str' data-images='$image_str'>";
            echo "<img class='picture-preview' src='$thumbnail' alt='$title'>";
            echo "<div class='picture-title'>$title</div>";
            echo "<ul class='tag-list'>";
            foreach ($tags as $tag) {
                echo "<li>$tag</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

?>