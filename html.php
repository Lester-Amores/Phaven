<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/0ed3fe686b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <title>PHaven</title>
</head>
<body>

        <!----Header----->
    <nav>
        <div class="left-section">
            <i class="fa-solid fa-map-location fa-3x"></i>
            <h1 class="Title">PHaven</h1>
        </div>
        <div class="right-section">
            <ul class="side-menu">
                <li><a href="#Welcome">Home</a></li>
                <li class="post-manage" onclick = "showPopup('manageform')"><a>Manage</a></li>
                <li class="post-nav" onclick = "showPopup('postform')"><a>Post</a></li>
                <li class="signin"><a>Sign In</a></li>
            </ul>
        </div>
    </nav>

<!----Welcome----->

    <header class="Welcome" id="Welcome">
        <p class="welcome-message">FIND YOUR HAVEN</p>
        <div class="categories">
            <div class="search-all" onclick = "searchtag('searchall')">
                <p>Search All</p>
            </div>
            <div class="resorts" onclick = "searchtag('resorts')">
                <i class="fa-solid fa-hotel"></i>
                <p>Resorts</p>
            </div>
            <div class="mountains" onclick = "searchtag('mountains')">
                <i class="fa-solid fa-mountain-sun"></i>
                <p>Mountains</p>
            </div>
            <div class="restaurants" onclick = "searchtag('restaurants')">
                <i class="fa-solid fa-utensils"></i>
                <p>Restaurants</p>
            </div>
        </div>
        <div>
            <div class="search-box">
                <form action="submit">
                    <button class="search-icon-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" id="search" name="search" placeholder="Type here">
                    <button type="submit" class="search-button" value="submit">Search</button>
                </form>
                
            </div>
        </div>
    </header>
    

    <!----Main Body----->
    <main class="main">
        <section class="main-grid">
            <?php include 'main.php'; ?>
        </section>
    </main>
    
<!----popup-post----->
<div class="post-form">
    <form action="index.php" method="POST" enctype="multipart/form-data" id="myForm">
        <p class="instruction">Post Your Haven</p>
        <div class="left-section-form">
            <i class="close fa-solid fa-xmark" onclick="minimize('post-form')"></i>
            <div class="input-box">
                <input type="text" name="name" id="name" maxlength="30" required><br>
                <label for="name">Name</label>
            </div>
            <div class="input-box">
                <input type="text" name="location" id="location" required><br>
                <label for="location">Location</label>
            </div>
            <div class="input-box">
                <input type="text" name="tags" id="tags" required><br>
                <label for="tags">Tags (max. 8 & add ",")</label>
            </div>
            <div class="description-container">
                <label for="description" class="description-label">Description</label><br>
                <textarea name="description" id="description" rows="8" cols="62" maxlength="500" required></textarea>
                <p id="letterCount"></p>
            </div>
        </div>
        <div class="right-section-form">
            <div class="image-upload">
                <label for="thumbnail" class="file-label">Upload Main Photo</label>
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required><br>
                <div>
                    <div class="thumbnailPhoto" id="thumbnailPhoto"></div>
                </div>
                <label for="images" class="file-label">Upload Photos</label>
                <input type="file" name="images[]" id="images" accept="image/*" multiple required><br>
                <p id="img-counter">(0)</p>
            </div>
            <div>
                <ul class="image-previews" id="image-previews"></ul>
            </div>
            <button class="submit-btn" type="submit" name="submit" id="submit">SUBMIT</button>  
        </div>      
    </form> 
</div>




    <div class="manage-form">
             <i class="close fa-solid fa-xmark" onclick = "minimize('manage-form')"></i>
             <p>Manage Section</p>
             <div class="manage-titles-container">
                <form action="delete.php" method="POST" id="delete-form">
                <?php include 'deletecontents.php'; ?>
                </form>
            </div>
    </div>




    <!----expand-details----->
    <div class="expand-post">
        <i class="dash fa-solid fa-minus"></i>
        <div class="upper-part">
            <div class="picture-expanded swiper-container">
                <div class="swiper-wrapper">
        <!-- Your .bigpic images here -->
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>    
            </div>
            
            <div class="details">
                <div class="title-big"></div>
                    <p>Location</p>
                    <div class="haven-location">Lorem epsum location</div>
                    <p>Tags</p>
                <ul class="tags-expanded">
                </ul>
            </div>
        </div>
        <div class="description">
            <p></p>
        </div>
    </div>
    <script src="javascript.js"></script>
</body>

</html>