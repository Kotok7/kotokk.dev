        const quizData = {
            "Programming Languages": [
                {
                    question: "What is my favorite programming/markup language?",
                    options: ["JavaScript", "Python", "PHP", "HTML"],
                    correct: 2
                },
                {
                    question: "Which language did I learn first?",
                    options: ["HTML", "Python", "C", "JavaScript"],
                    correct: 0
                },
                {
                    question: "What language/framework do I use for backend development?",
                    options: ["Node.js", "PHP", "Python", "Go"],
                    correct: 1
                }
            ],
            "Development Tools & IDEs": [
                {
                    question: "What is my preferred IDE for coding?",
                    options: ["Visual Studio Code", "IntelliJ IDEA", "Sublime Text", "Atom"],
                    correct: 0
                },
                {
                    question: "Which version control system do I use most?",
                    options: ["SVN", "Git", "Mercurial", "None"],
                    correct: 3
                },
                {
                    question: "What is my favorite terminal/command line tool?",
                    options: ["PowerShell", "Kitty", "Zsh", "Fish"],
                    correct: 2
                }
            ],
            "Frameworks & Technologies": [
                {
                    question: "Which frontend framework do I prefer?",
                    options: ["React", "Vue.js", "Angular", "Svelte"],
                    correct: 0
                },
                {
                    question: "Which database do I like the most?",
                    options: ["MySQL", "PostgreSQL", "MongoDB", "SQLite"],
                    correct: 3
                },
                {
                    question: "Which CSS framework do I like the most?",
                    options: ["Bootstrap", "Tailwind CSS", "Bulma", "Foundation"],
                    correct: 1
                }
            ],
            "Coding Preferences": [
                {
                    question: "What time of day do I code best?",
                    options: ["Early morning", "Afternoon", "Evening", "Late night"],
                    correct: 1
                },
                {
                    question: "What's my coding environment preference?",
                    options: ["Light theme", "Dark theme", "Auto-switching", "Custom theme"],
                    correct: 1
                }
            ]
        };

        let currentCategoryIndex = 0;
        let currentQuestionIndex = 0;
        let score = 0;
        let totalQuestions = 0;
        let selectedAnswer = null;
        let categories = Object.keys(quizData);

        categories.forEach(category => {
            totalQuestions += quizData[category].length;
        });

        const categoryIcons = {
            "Programming Languages": "🚀",
            "Development Tools & IDEs": "🛠️",
            "Frameworks & Technologies": "⚙️",
            "Coding Preferences": "💡"
        };

        function getCurrentQuestion() {
            const category = categories[currentCategoryIndex];
            return quizData[category][currentQuestionIndex];
        }

        function getCurrentQuestionNumber() {
            let questionNumber = 0;
            for (let i = 0; i < currentCategoryIndex; i++) {
                questionNumber += quizData[categories[i]].length;
            }
            return questionNumber + currentQuestionIndex + 1;
        }

        function updateProgress() {
            const progress = (getCurrentQuestionNumber() - 1) / totalQuestions * 100;
            document.getElementById('progressFill').style.width = progress + '%';
        }

        function displayQuestion() {
            const category = categories[currentCategoryIndex];
            const question = getCurrentQuestion();
            const questionNumber = getCurrentQuestionNumber();
            
            const content = document.getElementById('quizContent');
            content.innerHTML = `
                <div class="category-header">
                    <div class="category-title">
                        <span class="category-icon">${categoryIcons[category]}</span>
                        ${category}
                    </div>
                </div>
                
                <div class="question-card">
                    <div class="question-number">Question ${questionNumber} of ${totalQuestions}</div>
                    <div class="question-text">${question.question}</div>
                    <div class="options">
                        ${question.options.map((option, index) => `
                            <div class="option" onclick="selectAnswer(${index})" data-index="${index}">
                                ${option}
                            </div>
                        `).join('')}
                    </div>
                </div>
                
                <div class="controls">
                    <button class="btn" onclick="previousQuestion()" ${getCurrentQuestionNumber() === 1 ? 'style="visibility: hidden;"' : ''}>
                        ← Previous
                    </button>
                    <div class="score-info">Score: ${score}/${getCurrentQuestionNumber() - 1}</div>
                    <button class="btn" id="nextBtn" onclick="nextQuestion()" disabled>
                        Next →
                    </button>
                </div>
            `;
            
            updateProgress();
            selectedAnswer = null;
        }

        function selectAnswer(index) {
            selectedAnswer = index;
            
            document.querySelectorAll('.option').forEach(opt => {
                opt.classList.remove('selected');
            });

            document.querySelectorAll('.option')[index].classList.add('selected');

            document.getElementById('nextBtn').disabled = false;
        }

        function nextQuestion() {
            if (selectedAnswer === null) return;
            
            const question = getCurrentQuestion();
            const options = document.querySelectorAll('.option');

            options.forEach((option, index) => {
                if (index === question.correct) {
                    option.classList.add('correct');
                } else if (index === selectedAnswer && index !== question.correct) {
                    option.classList.add('incorrect');
                }
            });

            if (selectedAnswer === question.correct) {
                score++;
            }
            
            setTimeout(() => {
                currentQuestionIndex++;
                
                if (currentQuestionIndex >= quizData[categories[currentCategoryIndex]].length) {
                    currentCategoryIndex++;
                    currentQuestionIndex = 0;
                }
                
                if (currentCategoryIndex >= categories.length) {
                    showResults();
                } else {
                    displayQuestion();
                }
            }, 1500);
        }

        function previousQuestion() {
            currentQuestionIndex--;
            
            if (currentQuestionIndex < 0) {
                currentCategoryIndex--;
                if (currentCategoryIndex >= 0) {
                    currentQuestionIndex = quizData[categories[currentCategoryIndex]].length - 1;
                } else {
                    currentCategoryIndex = 0;
                    currentQuestionIndex = 0;
                }
            }

            score = Math.max(0, score - 1);
            
            displayQuestion();
        }

        function showResults() {
            const percentage = Math.round((score / totalQuestions) * 100);
            const content = document.getElementById('quizContent');
            
            document.getElementById('progressFill').style.width = '100%';
            
            let message = "";
            if (percentage >= 80) {
                message = "🎉 Excellent! You know me very well!";
            } else if (percentage >= 60) {
                message = "👏 Good job! You know quite a bit about me!";
            } else if (percentage >= 40) {
                message = "🤔 Not bad! We should talk more about programming!";
            } else {
                message = "😅 Looks like we need to spend more time coding together!";
            }
            
            content.innerHTML = `
                <div class="results">
                    <h2>Quiz Complete!</h2>
                    <div class="score-circle">
                        <div class="score-inner">${percentage}%</div>
                    </div>
                    <p style="font-size: 1.3rem; margin-bottom: 20px; color: #666;">
                        You scored ${score} out of ${totalQuestions}
                    </p>
                    <p style="font-size: 1.1rem; color: #333; margin-bottom: 30px;">
                        ${message}
                    </p>
                    <button class="btn restart-btn" onclick="restartQuiz()">
                        🔄 Take Quiz Again
                    </button>
                </div>
            `;
        }

        function restartQuiz() {
            currentCategoryIndex = 0;
            currentQuestionIndex = 0;
            score = 0;
            selectedAnswer = null;
            displayQuestion();
        }

        displayQuestion();