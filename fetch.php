<?php
$sql = "SELECT places.id, places.title, places.location, places.description,places.thumbnail, GROUP_CONCAT(DISTINCT tags.tag_name) AS tag_names, GROUP_CONCAT(DISTINCT images.image_url) AS image_urls
FROM places
LEFT JOIN title_tags ON places.id = title_tags.title_id
LEFT JOIN tags ON title_tags.tag_id = tags.id
LEFT JOIN title_images ON places.id = title_images.title_id
LEFT JOIN images ON title_images.image_id = images.id
GROUP BY places.id";

$result = mysqli_query($conn, $sql);
?>