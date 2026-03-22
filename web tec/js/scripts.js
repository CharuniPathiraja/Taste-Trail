document.addEventListener('DOMContentLoaded', function() {
    // 1. Dynamic Recipe Search
    const searchInput = document.getElementById('recipeSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const recipeItems = document.querySelectorAll('.recipe-item');

            recipeItems.forEach(item => {
                const title = item.getAttribute('data-title');
                const ingredients = item.getAttribute('data-ingredients');
                
                if (title.includes(searchTerm) || ingredients.includes(searchTerm)) {
                    item.style.display = 'block';
                    item.classList.add('animate-fade');
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

    // 2. Recipe Detail Modals
    const viewButtons = document.querySelectorAll('.view-recipe');
    const recipeModal = new bootstrap.Modal(document.getElementById('recipeModal'));
    
    viewButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const title = this.getAttribute('data-title');
            const ingredients = this.getAttribute('data-ingredients');
            const instructions = this.getAttribute('data-instructions');

            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalIngredients').textContent = ingredients;
            document.getElementById('modalInstructions').textContent = instructions;

            recipeModal.show();
        });
    });

    // 3. Form Validation for Contact Form
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const email = contactForm.querySelector('input[type="email"]').value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
            }
        });
    }

    // 4. Smooth Scrolling for Nav Links (Updated)
    document.querySelectorAll('a.nav-link, a.nav-link-adv').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // 5. Toggle Favorites via AJAX
    const heartIcons = document.querySelectorAll('.heart-overlay');
    heartIcons.forEach(icon => {
        icon.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent card click if any

            const recipeId = this.getAttribute('data-recipe-id');
            const heart = this.querySelector('i');
            
            fetch('auth/toggle_favorite.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `recipe_id=${recipeId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    if (data.action === 'added') {
                        this.classList.add('active');
                        heart.classList.remove('bi-heart');
                        heart.classList.add('bi-heart-fill');
                    } else {
                        this.classList.remove('active');
                        heart.classList.remove('bi-heart-fill');
                        heart.classList.add('bi-heart');
                        
                        // If we are on the favorites page, remove the card
                        if (window.location.pathname.includes('favorites.php')) {
                            const card = this.closest('.recipe-item') || this.closest('.col-md-4');
                            if (card) {
                                card.classList.add('animate-fade-out');
                                setTimeout(() => card.remove(), 300);
                            }
                        }
                    }
                } else if (data.message === 'User not logged in') {
                    window.location.href = 'auth/login.php';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error toggling favorite:', error);
            });
        });
    });
});
