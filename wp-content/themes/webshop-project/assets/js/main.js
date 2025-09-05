// See all button functionality for comments section
document.addEventListener('DOMContentLoaded', function() {
    const commentList = document.querySelector('.comment-list');
    const seeAllBtn = document.querySelector('.see-all-comments-btn');
    
    if (seeAllBtn && commentList) {
        seeAllBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (commentList.classList.contains('show-all')) {
                commentList.classList.remove('show-all');
                this.textContent = 'See all comments';
            } else {
                commentList.classList.add('show-all');
                this.textContent = 'Show less';
            }
        });
    }
});


// scroll to top button functionality
document.addEventListener('scroll', function() {
    var btn = document.getElementById('back-to-top');
    if (window.scrollY > 300) {
        btn.style.display = 'block';
    } else {
        btn.style.display = 'none';
    }
});



// JavaScript for slider functionality 
let currentSlide = 0;
const slides = document.querySelectorAll('#hero-slider .slider-img');
setInterval(() => {
    slides.forEach((img, i) => {
        img.style.opacity = (i === currentSlide) 
        ? '1' 
        : '0';
    });
    currentSlide = (currentSlide + 1) % slides.length;
}, 3500);