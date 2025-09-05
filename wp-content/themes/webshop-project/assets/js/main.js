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
