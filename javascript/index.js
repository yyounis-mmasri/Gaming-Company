document.addEventListener("DOMContentLoaded", () => {
    const gameSections = document.querySelectorAll(".game-sec");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("active");
                observer.unobserve(entry.target); // Stop observing after triggering
            }
        });
    });

    gameSections.forEach(section => observer.observe(section));
});
