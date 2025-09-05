document.addEventListener('DOMContentLoaded', function() {
    // See all comments functionality
    const commentList = document.querySelector('.comment-list');
    const seeAllBtn = document.querySelector('.see-all-comments-btn');
    const comments = commentList ? commentList.querySelectorAll('li.comment') : [];

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

    // Slider functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('#hero-slider .slider-img');
    if (slides.length > 0) {
        setInterval(() => {
            slides.forEach((img, i) => {
                img.style.opacity = (i === currentSlide) ? '1' : '0';
            });
            currentSlide = (currentSlide + 1) % slides.length;
        }, 3500);
    }
});

// Back to top button (can be outside DOMContentLoaded)
document.addEventListener('scroll', function() {
    var btn = document.getElementById('back-to-top');
    if (btn) {
        btn.style.display = (window.scrollY > 300) ? 'block' : 'none';
    }
});