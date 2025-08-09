        document.addEventListener('DOMContentLoaded', function() {

            gsap.registerPlugin(ScrollTrigger);

            gsap.to(".header-bg", {
                duration: 2,
                backgroundPosition: "100% 0%",
                ease: "power2.out"
            });
            
            gsap.to("h1", {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: 0.3,
                ease: "power3.out"
            });
            
            gsap.to(".subtitle", {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: 0.5,
                ease: "power3.out"
            });
            
            gsap.to(".author", {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: 0.7,
                ease: "power3.out"
            });

            gsap.utils.toArray(".image-container").forEach(function(elem) {
                gsap.to(elem, {
                    scrollTrigger: {
                        trigger: elem,
                        start: "top 80%",
                        toggleActions: "play none none none"
                    },
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    ease: "power2.out"
                });
            });
            
            gsap.utils.toArray(".divider").forEach(function(elem) {
                gsap.to(elem, {
                    scrollTrigger: {
                        trigger: elem,
                        start: "top 85%",
                        toggleActions: "play none none none"
                    },
                    opacity: 1,
                    scaleX: 1,
                    duration: 1.2,
                    ease: "power2.out"
                });
            });

            gsap.utils.toArray(".highlight").forEach(function(elem) {
                gsap.to(elem, {
                    scrollTrigger: {
                        trigger: elem,
                        start: "top 80%",
                        toggleActions: "play none none none"
                    },
                    opacity: 1,
                    x: 0,
                    duration: 1,
                    ease: "power2.out"
                });
            });

            gsap.utils.toArray(".tag").forEach(function(elem, index) {
                gsap.to(elem, {
                    scrollTrigger: {
                        trigger: ".tags",
                        start: "top 85%",
                        toggleActions: "play none none none"
                    },
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    delay: index * 0.1,
                    ease: "back.out(1.7)"
                });
            });

            gsap.utils.toArray(".image-container img").forEach(function(elem) {
                gsap.to(elem, {
                    scrollTrigger: {
                        trigger: elem,
                        start: "top bottom",
                        end: "bottom top",
                        scrub: 1
                    },
                    y: -30,
                    ease: "none"
                });
            });
        });