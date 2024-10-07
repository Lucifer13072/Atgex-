// Плавный скролл по якорным ссылкам
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Опционально: добавление эффекта параллакса на фоне
window.addEventListener('scroll', function() {
    const scrolled = window.scrollY;
    document.querySelector('.hero').style.backgroundPositionY = `${scrolled * 0.5}px`;
});
