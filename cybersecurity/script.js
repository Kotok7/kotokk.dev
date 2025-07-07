        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate');
            
            function checkIfInView() {
                animateElements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect();
                    
                    if (elementPosition.top < window.innerHeight * 0.9) {
                        element.style.opacity = "1";
                    }
                });
            }

            checkIfInView();

            window.addEventListener('scroll', checkIfInView);

            const glitchElements = document.querySelectorAll('.glitch');
            
            glitchElements.forEach(element => {
                element.setAttribute('data-text', element.textContent);
            });

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                });
            });

            function addCircuitElements() {
                const circuit = document.querySelector('.cyber-circuit');
                const circuitElements = 20;
                
                for (let i = 0; i < circuitElements; i++) {
                    const x = Math.random() * 100;
                    const y = Math.random() * 100;
                    const size = Math.random() * 5 + 2;
                    
                    const dot = document.createElement('div');
                    dot.style.position = 'absolute';
                    dot.style.left = `${x}%`;
                    dot.style.top = `${y}%`;
                    dot.style.width = `${size}px`;
                    dot.style.height = `${size}px`;
                    dot.style.borderRadius = '50%';
                    dot.style.backgroundColor = 'var(--accent)';
                    dot.style.opacity = '0.5';
                    
                    circuit.appendChild(dot);
                    
                    setInterval(() => {
                        dot.style.transform = 'scale(1.5)';
                        dot.style.opacity = '0.8';
                        
                        setTimeout(() => {
                            dot.style.transform = 'scale(1)';
                            dot.style.opacity = '0.5';
                        }, 1000);
                    }, Math.random() * 5000 + 2000);
                }
            }
            
            addCircuitElements();
        });