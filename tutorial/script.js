        document.addEventListener('DOMContentLoaded', function() {
            const stepContainers = document.querySelectorAll('.step-container');
            
            const floatingElements = document.querySelectorAll('.floating-element');
            floatingElements.forEach((element, index) => {
                element.style.animationDelay = (index * 0.5) + 's';
                element.style.animationDuration = (10 + index * 2) + 's';
            });
            
            function isInViewport(element) {
                const rect = element.getBoundingClientRect();
                return (
                    rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.9 &&
                    rect.bottom >= 0
                );
            }
            
            function checkVisibility() {
                stepContainers.forEach(container => {
                    if (isInViewport(container)) {
                        container.classList.add('visible');
                    }
                });
            }
            
            checkVisibility();
            
            window.addEventListener('scroll', checkVisibility);
        });