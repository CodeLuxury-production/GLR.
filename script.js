// Header scroll effect
window.addEventListener('scroll', function() {
    const header = document.querySelector('.header');
    if (window.scrollY > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Slider functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize slider if exists
    const slider = document.querySelector('.slider-track');
    if (slider) {
        initSlider();
    }
    
    // Initialize division and planet pages
    initDivisionPage();
    initPlanetPage();
    initCharterPage();
});

function initSlider() {
    const track = document.querySelector('.slider-track');
    const dots = document.querySelectorAll('.dot');
    let currentSlide = 0;
    const slideCount = 3; // 3 placeholder slides
    
    function updateSlider() {
        track.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Update dots
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
    }
    
    // Auto slide
    setInterval(() => {
        currentSlide = (currentSlide + 1) % slideCount;
        updateSlider();
    }, 5000);
    
    // Dot click events
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            updateSlider();
        });
    });
}

function initDivisionPage() {
    const menuItems = document.querySelectorAll('.divisions-menu .menu-item');
    const contentItems = document.querySelectorAll('.division-content .content-item');
    
    if (menuItems.length > 0) {
        menuItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                // Remove active class from all
                menuItems.forEach(i => i.classList.remove('active'));
                contentItems.forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked
                item.classList.add('active');
                if (contentItems[index]) {
                    contentItems[index].classList.add('active');
                }
            });
        });
        
        // Activate first item by default
        if (menuItems[0]) menuItems[0].classList.add('active');
        if (contentItems[0]) contentItems[0].classList.add('active');
    }
}

function initPlanetPage() {
    const menuItems = document.querySelectorAll('.planets-menu .menu-item');
    const contentItems = document.querySelectorAll('.planet-content .content-item');
    
    if (menuItems.length > 0) {
        menuItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                // Remove active class from all
                menuItems.forEach(i => i.classList.remove('active'));
                contentItems.forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked
                item.classList.add('active');
                if (contentItems[index]) {
                    contentItems[index].classList.add('active');
                }
            });
        });
        
        // Activate first item by default
        if (menuItems[0]) menuItems[0].classList.add('active');
        if (contentItems[0]) contentItems[0].classList.add('active');
    }
}

function initCharterPage() {
    const charterSections = document.querySelectorAll('.charter-section');
    
    // Add smooth scrolling for charter navigation
    document.querySelectorAll('.nav a[href="charter.php"]').forEach(link => {
        link.addEventListener('click', (e) => {
            if (window.location.pathname.endsWith('charter.php')) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    });
}