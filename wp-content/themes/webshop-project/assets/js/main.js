// See all button functionality for comments section
document.addEventListener('DOMContentLoaded', function() {
    const commentList = document.querySelector('.comment-list');
    const seeAllBtn = document.querySelector('.see-all-comments-btn');
    const comments = commentList ? commentList.querySelectorAll('li') : [];

    // Hide all comments except the first
    if (commentList && comments.length > 1) {
        comments.forEach((comment, i) => {
            if (i > 0) {
                comment.classList.add('hidden-comment');
            }
        });
    }

    if (seeAllBtn && commentList) {
        seeAllBtn.addEventListener('click', function(e) {
            e.preventDefault();

            if (commentList.classList.contains('show-all')) {
                commentList.classList.remove('show-all');
                this.textContent = 'See all comments';
                comments.forEach((comment, i) => {
                    if (i > 0) {
                        comment.classList.add('hidden-comment');
                    }
                });
            } else {
                commentList.classList.add('show-all');
                this.textContent = 'Show less';
                comments.forEach((comment, i) => {
                    if (i > 0) {
                        comment.classList.remove('hidden-comment');
                    }
                });
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