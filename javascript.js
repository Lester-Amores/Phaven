const postform = document.querySelector('.post-form');
const manageform = document.querySelector('.manage-form');
const main = document.querySelector('main');
const welcome = document.querySelector('.Welcome');
const closed = document.querySelectorAll('.close');
const searchall = document.querySelector('.search-all');
const resorts = document.querySelector('.resorts');
const mountains = document.querySelector('.mountains');
const restaurants = document.querySelector('.restaurants');
const picturecons = document.querySelectorAll('.picture-container');
const expandpost = document.querySelector('.expand-post');
const dash = document.querySelector('.dash');
const images = document.getElementById("images");
const thumbnail = document.getElementById("thumbnail");
const textarea = document.getElementById('description');
const letterCount = document.getElementById('letterCount');
const bodyElement = document.body;


window.addEventListener('scroll', () =>{ 
    const scrollHeight = window.scrollY;
    const triggerHeight = 3;
    const rightSection = document.querySelector('.right-section');
    const navTag = document.getElementsByTagName('nav')[0];
    if (scrollHeight >= triggerHeight) {
        rightSection.classList.add('scroll');
        navTag.classList.add('shadow');
    }
    else {
        rightSection.classList.remove('scroll');
        navTag.classList.remove('shadow');
    }
});



searchall.classList.add('selected');
function searchtag(selectedsearchtag){
    if (selectedsearchtag === 'searchall'){
        searchall.classList.add('selected');
        resorts.classList.remove('selected');
        mountains.classList.remove('selected');
        restaurants.classList.remove('selected');
    }
    else if (selectedsearchtag === 'resorts'){
        searchall.classList.remove('selected');
        resorts.classList.add('selected');
        mountains.classList.remove('selected');
        restaurants.classList.remove('selected');
    }
    else if (selectedsearchtag === 'mountains'){
        searchall.classList.remove('selected');
        resorts.classList.remove('selected');
        mountains.classList.add('selected');
        restaurants.classList.remove('selected');
    }
    else if (selectedsearchtag === 'restaurants'){
        searchall.classList.remove('selected');
        resorts.classList.remove('selected');
        mountains.classList.remove('selected');
        restaurants.classList.add('selected');
    }
    
}

let display = 0;
function showPopup(popup){
    if (popup === 'manageform' && display === 0){
        manageform.classList.add('active');
        welcome.classList.add('blur');
        main.classList.add('blur');
        bodyElement.classList.add("noscroll");
        display === 1;
    }
    else if(popup === 'postform' && display === 0){
        postform.classList.add('active');
        welcome.classList.add('blur');
        main.classList.add('blur');
        bodyElement.classList.add("noscroll");
        display === 1;
    }
}


let activePopup = null;

function showPopup(popup) {
    if (!activePopup) {
        if (popup === 'manageform') {
            manageform.classList.add('active');
        } else if (popup === 'postform') {
            postform.classList.add('active');
        }
        welcome.classList.add('blur');
        main.classList.add('blur');
        bodyElement.classList.add("noscroll");
        activePopup = popup;
    }
}

function minimize(closeform) {
        if (closeform === 'post-form' && activePopup === 'postform') {
            postform.classList.remove('active');
        } else if (closeform === 'manage-form' && activePopup === 'manageform') {
            manageform.classList.remove('active');
        }
        welcome.classList.remove('blur');
        main.classList.remove('blur');
        bodyElement.classList.remove("noscroll");
        activePopup = null;

}



// Initialize Swiper
const swiper = new Swiper('.picture-expanded', {
    // Optional parameters
    direction: 'horizontal', // Set slide direction to horizontal
    loop: true, // Enable loop mode to create an infinite loop
    slidesPerView: 'auto', // Set the number of slides to display at a time
    spaceBetween: 10, // Add space between slides
    navigation: {
        nextEl: '.swiper-button-next', // Selector for the next button
        prevEl: '.swiper-button-prev', // Selector for the previous button
    },
});

picturecons.forEach(picturecon => {
picturecon.addEventListener('click', ()=>{
    const title = picturecon.getAttribute('data-title');
    const location = picturecon.getAttribute('data-location');
    const description = picturecon.getAttribute('data-description');
    const tags = picturecon.getAttribute('data-tags').split(',');
    const images = picturecon.getAttribute('data-images').split(',');
    const pictureExpanded = document.querySelector('.swiper-wrapper');


    document.querySelector('.title-big').textContent = title;
    document.querySelector('.tags-expanded').innerHTML = tags.map(tag => `<li>${tag}</li>`).join('');
    document.querySelector('.haven-location').textContent = location;
    document.querySelector('.description p').textContent = description;
    
    pictureExpanded.innerHTML = '';
    images.forEach(image => {
        // Create a new image element
        const img = document.createElement('img');
        
        // Set the necessary attributes
        img.classList.add('swiper-slide', 'bigpic'); // Add swiper-slide class for Swiper
        img.src = `uploads/${image}`;
        img.alt = title; // Assuming title is defined elsewhere
        
        // Append the image to the swiper-wrapper
        pictureExpanded.appendChild(img);
    });

    expandpost.classList.add('active');
    welcome.classList.add('blur');
    main.classList.add('blur');
    bodyElement.classList.add("noscroll");
});
});

dash.addEventListener('click', ()=>{
    expandpost.classList.remove('active');
    welcome.classList.remove('blur')
    main.classList.remove('blur');
    bodyElement.classList.remove("noscroll");
})


thumbnail.addEventListener("change", (event) => {
    var file = event.target.files[0]; // Use event.target.files to access the uploaded files
    var thumbnailcontainer = document.getElementById("thumbnailPhoto");
    
    var reader = new FileReader();
    reader.onload = (e) => {
        var img = document.createElement("img");
        img.src = e.target.result;
        img.style.width = "100%";
        img.style.height = "50px";
        thumbnailcontainer.innerHTML = ''; // Clear the container before appending new image
        thumbnailcontainer.appendChild(img);
    }
    reader.readAsDataURL(file);
});



images.addEventListener("change", (event) => {
var files = event.target.files;
var previewContainer = document.getElementById("image-previews");
var imageCounter = document.getElementById("img-counter");

for (var i = 0; i < files.length; i++) {
    var file = files[i];

    // Ensure the file is an image
    if (!file.type.match('image.*')) {
        continue;
    }

    var reader = new FileReader();

    reader.onload = (e) => {
        var img = document.createElement("img");
        img.src = e.target.result;
        img.style.width = "100%";
        img.style.height = "50px";
        previewContainer.appendChild(img);

        var li = document.createElement("li");
        li.appendChild(img);

        var removeBtn = document.createElement("button");
        removeBtn.classList.add("remove-btn");
        removeBtn.innerHTML = "x";
        removeBtn.addEventListener("click", () => {
            li.remove(); 
            updateCounter();
        });
        li.appendChild(removeBtn);

        previewContainer.appendChild(li);
        updateCounter(); 
    }

    reader.readAsDataURL(file);
}

function updateCounter() {
    var imageCount = previewContainer.querySelectorAll("li").length;
    imageCounter.textContent = "(" + imageCount + ")";
}
});

textarea.addEventListener('input', () => {
    const text = textarea.value;
    const letterCountValue = text.replace(/\s/g, '').length;
    letterCount.textContent = `${letterCountValue}/500`;
});




