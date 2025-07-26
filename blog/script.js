        function selectPost(postId) {
            event.currentTarget.style.transform = 'translateY(-8px) scale(0.98)';
            
            setTimeout(() => {
                event.currentTarget.style.transform = 'translateY(-8px) scale(1)';
                
                alert(`Selected post: ${postId}\n\nIn a real application, this would navigate to the full blog post.`);
            }, 100);
        }

        document.addEventListener('mousemove', (e) => {
            const particles = document.querySelectorAll('.particle');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            particles.forEach((particle, index) => {
                const speed = (index + 1) * 0.5;
                const x = (mouseX - 0.5) * speed;
                const y = (mouseY - 0.5) * speed;
                
                particle.style.transform = `translate(${x}px, ${y}px)`;
            });
        });