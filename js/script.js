jQuery(document).ready(function($) {
    var observer = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                $(entry.target).addClass('animate');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    $('.daily-menu-item').each(function() {
        observer.observe(this);
    });
});