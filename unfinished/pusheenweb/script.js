function startMemoryGame() {
    const gameContainer = document.getElementById('memory-game');
    const scoreDisplay = document.getElementById('memory-score');
    const movesDisplay = document.getElementById('memory-moves');
    
    gameContainer.style.display = 'grid';
    scoreDisplay.style.display = 'block';
    movesDisplay.style.display = 'block';
    gameContainer.innerHTML = '';

    const emojis = ['🍕', '🍩', '📦', '💤', '🎂', '📱', '🌈', '🦄', '🐱', '🍪', '🎮', '🧁'];
    const selectedEmojis = emojis.sort(() => 0.5 - Math.random()).slice(0, 8);
    const cards = [...selectedEmojis, ...selectedEmojis];
    
    for (let i = cards.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [cards[i], cards[j]] = [cards[j], cards[i]];
    }
    
    let flippedCards = [];
    let matchedPairs = 0;
    let moves = 0;
    let canFlip = true;
    
    scoreDisplay.textContent = `Matches: 0/${selectedEmojis.length}`;
    movesDisplay.textContent = `Moves: 0`;
    
    cards.forEach((card, index) => {
        const cardElement = document.createElement('div');
        cardElement.classList.add('memory-card');
        cardElement.dataset.value = card;
        cardElement.dataset.index = index;
        
        const frontFace = document.createElement('div');
        frontFace.classList.add('front');
        frontFace.textContent = card;
        
        const backFace = document.createElement('div');
        backFace.classList.add('back');
        
        cardElement.appendChild(frontFace);
        cardElement.appendChild(backFace);
        
        cardElement.addEventListener('click', () => {
            if (!canFlip || cardElement.classList.contains('matched') || cardElement.classList.contains('flipped') || flippedCards.length >= 2) {
                return;
            }
            
            cardElement.classList.add('flipped');
            flippedCards.push(cardElement);
            
            if (flippedCards.length === 2) {
                moves++;
                movesDisplay.textContent = `Moves: ${moves}`;
                canFlip = false;
                
                setTimeout(() => {
                    if (flippedCards[0].dataset.value === flippedCards[1].dataset.value) {
                        flippedCards[0].classList.add('matched');
                        flippedCards[1].classList.add('matched');
                        matchedPairs++;
                        
                        scoreDisplay.textContent = `Matches: ${matchedPairs}/${selectedEmojis.length}`;

                        if (matchedPairs === selectedEmojis.length) {
                            setTimeout(() => {
                                alert(`Congratulations! You found all the matches in ${moves} moves!`);

                                let stars = 3;
                                if (moves > selectedEmojis.length * 2) {
                                    stars = 2;
                                }
                                if (moves > selectedEmojis.length * 3) {
                                    stars = 1;
                                }
                                
                                scoreDisplay.textContent = `You completed the game with ${stars} ${stars === 1 ? 'star' : 'stars'}!`;
                            }, 500);
                        }
                    } else {
                        flippedCards[0].classList.remove('flipped');
                        flippedCards[1].classList.remove('flipped');
                    }
                    
                    flippedCards = [];
                    canFlip = true;
                }, 1000);
            }
        });
        
        gameContainer.appendChild(cardElement);
    });
}

function startQuiz() {
    const quizContainer = document.getElementById('quiz-container');
    const questionEl = document.getElementById('question');
    const optionsEl = document.getElementById('options');
    const resultEl = document.getElementById('result');
    const nextBtn = document.getElementById('next-question');
    const progressBar = document.getElementById('quiz-progress-bar');
    const scoreDisplay = document.getElementById('quiz-score');
    
    quizContainer.style.display = 'block';
    
    const questions = [
        {
            question: "What is Pusheen's favorite food?",
            options: ["Carrots", "Pizza", "Salad", "Sushi"],
            correct: 1
        },
        {
            question: "What does the name 'Pusheen' mean in Irish?",
            options: ["Fluffy", "Kitten", "Sleepy", "Cute"],
            correct: 1
        },
        {
            question: "What year was Pusheen created?",
            options: ["2008", "2010", "2012", "2015"],
            correct: 1
        },
        {
            question: "What is Pusheen's sister's name?",
            options: ["Stormy", "Cloudy", "Rainy", "Sunny"],
            correct: 0
        },
        {
            question: "What animal is Pusheen?",
            options: ["Dog", "Rabbit", "Cat", "Hamster"],
            correct: 2
        },
        {
            question: "What is Pusheen's brother's name?",
            options: ["Pip", "Pop", "Pep", "Pat"],
            correct: 0
        },
        {
            question: "Which of these is NOT a Pusheen form?",
            options: ["Baker Pusheen", "Driver Pusheen", "Mermaid Pusheen", "Unicorn Pusheen"],
            correct: 1
        },
        {
            question: "Who created Pusheen?",
            options: ["Claire Belton", "Simon Tofield", "Jim Davis", "Charles Schulz"],
            correct: 0
        },
        {
            question: "What color is Pusheen?",
            options: ["White", "Orange", "Gray", "Black"],
            correct: 2
        },
        {
            question: "What holiday does Pusheen celebrate with a red hat?",
            options: ["Valentine's Day", "Halloween", "Christmas", "Easter"],
            correct: 2
        }
    ];
    
    let currentQuestion = 0;
    let score = 0;
    
    function showQuestion(questionIndex) {
        resultEl.textContent = '';
        resultEl.style.display = 'none';
        nextBtn.style.display = 'none';
        const question = questions[questionIndex];
        
        questionEl.textContent = question.question;
        optionsEl.innerHTML = '';
        
        question.options.forEach((option, index) => {
            const button = document.createElement('button');
            button.textContent = option;
            button.addEventListener('click', () => checkAnswer(index, question.correct));
            optionsEl.appendChild(button);
        });

        const progress = ((questionIndex) / questions.length) * 100;
        progressBar.style.width = `${progress}%`;
    }
    
    function checkAnswer(selected, correct) {
        const options = optionsEl.querySelectorAll('button');

        options.forEach(option => {
            option.disabled = true;
        });
        
        if (selected === correct) {
            options[selected].style.backgroundColor = '#8cd790';
            resultEl.textContent = 'Correct! 😺';
            resultEl.style.color = '#8cd790';
            score++;
        } else {
            options[selected].style.backgroundColor = '#ff7675';
            options[correct].style.backgroundColor = '#8cd790';
            resultEl.textContent = 'Wrong! The correct answer is highlighted.';
            resultEl.style.color = '#ff7675';
        }
        
        resultEl.style.display = 'block';

        if (currentQuestion < questions.length - 1) {
            nextBtn.style.display = 'block';
        } else {
            setTimeout(() => {
                scoreDisplay.textContent = `Final Score: ${score}/${questions.length}`;

                let message = '';
                if (score === questions.length) {
                    message = 'Perfect! You are a true Pusheen fan!';
                } else if (score >= questions.length * 0.7) {
                    message = 'Great job! You know Pusheen well!';
                } else if (score >= questions.length * 0.5) {
                    message = 'Not bad! You know some things about Pusheen.';
                } else {
                    message = 'You might need to learn more about Pusheen!';
                }

                const restartBtn = document.createElement('button');
                restartBtn.textContent = 'Play Again';
                restartBtn.className = 'btn';
                restartBtn.style.display = 'block';
                restartBtn.style.margin = '20px auto';
                restartBtn.addEventListener('click', () => {
                    currentQuestion = 0;
                    score = 0;
                    showQuestion(0);
                    scoreDisplay.textContent = '';
                    resultEl.innerHTML = '';
                });
                
                resultEl.innerHTML = `<p style="margin-bottom: 10px; font-weight: bold;">${message}</p>`;
                resultEl.appendChild(restartBtn);
            }, 1000);
        }
    }
    
    nextBtn.addEventListener('click', () => {
        currentQuestion++;
        if (currentQuestion < questions.length) {
            showQuestion(currentQuestion);
        }
    });

    showQuestion(0);
}

document.querySelectorAll('nav a').forEach(anchor => {
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

document.querySelectorAll('.gallery-item').forEach(item => {
    item.addEventListener('click', function() {
        this.classList.add('clicked');
        setTimeout(() => {
            this.classList.remove('clicked');
        }, 300);
    });
});

function adjustMemoryCardHeight() {
    const cards = document.querySelectorAll('.memory-card');
    const width = cards[0]?.offsetWidth || 0;
    cards.forEach(card => {
        card.style.height = width + 'px';
    });
}

window.addEventListener('resize', adjustMemoryCardHeight);

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseover', () => {
            btn.style.transform = 'translateY(-3px)';
            btn.style.boxShadow = '0 6px 12px rgba(0, 0, 0, 0.15)';
        });
        
        btn.addEventListener('mouseout', () => {
            btn.style.transform = '';
            btn.style.boxShadow = '';
        });
    });
});