const quizData = {
    "Języki programowania": [
        {
            question: "Jaki jest mój ulubiony język programowania/markup?",
            options: ["JavaScript", "Python", "PHP", "HTML"],
            correct: 2
        },
        {
            question: "Jakiego języka nauczyłem się jako pierwszego?",
            options: ["HTML", "Python", "C", "JavaScript"],
            correct: 0
        },
        {
            question: "Jakiego języka/frameworka używam do tworzenia backendu?",
            options: ["Node.js", "PHP", "Python", "Go"],
            correct: 1
        }
    ],
    "Narzędzia programistyczne i IDE": [
        {
            question: "Jakie IDE preferuję do programowania?",
            options: ["Visual Studio Code", "IntelliJ IDEA", "Sublime Text", "Atom"],
            correct: 0
        },
        {
            question: "Z jakiego systemu kontroli wersji korzystam najczęściej?",
            options: ["SVN", "Git", "Mercurial", "Żaden"],
            correct: 3
        },
        {
            question: "Jaki jest mój ulubiony terminal/narzędzie CLI?",
            options: ["PowerShell", "Kitty", "Zsh", "Fish"],
            correct: 2
        }
    ],
    "Frameworki i technologie": [
        {
            question: "Jaki framework frontendowy lubię najbardziej?",
            options: ["React", "Vue.js", "Angular", "Svelte"],
            correct: 0
        },
        {
            question: "Jaką bazę danych lubię najbardziej?",
            options: ["MySQL", "PostgreSQL", "MongoDB", "SQLite"],
            correct: 3
        },
        {
            question: "Jaki framework CSS najbardziej mi odpowiada?",
            options: ["Bootstrap", "Tailwind CSS", "Bulma", "Foundation"],
            correct: 1
        }
    ],
    "Preferencje kodowania": [
        {
            question: "O jakiej porze dnia najlepiej mi się programuje?",
            options: ["Wczesny poranek", "Popołudnie", "Wieczór", "Późna noc"],
            correct: 1
        },
        {
            question: "Jakie mam preferencje dotyczące środowiska kodowania?",
            options: ["Jasny motyw", "Ciemny motyw", "Automatyczne przełączanie", "Motyw customowy"],
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
    "Języki programowania": "🚀",
    "Narzędzia programistyczne i IDE": "🛠️",
    "Frameworki i technologie": "⚙️",
    "Preferencje kodowania": "💡"
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
                    <div class="question-number">Pytanie ${questionNumber} z ${totalQuestions}</div>
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
                        ← Poprzednie
                    </button>
                    <div class="score-info">Wynik: ${score}/${getCurrentQuestionNumber() - 1}</div>
                    <button class="btn" id="nextBtn" onclick="nextQuestion()" disabled>
                        Następne →
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
                message = "🎉 Świetnie, bardzo dobrze mnie znasz!";
            } else if (percentage >= 60) {
                message = "👏 Dobra robota, calkiem nieźle mnie znasz!";
            } else if (percentage >= 40) {
                message = "🤔 Nieźle, musimy więcej pogadać o programowaniu!";
            } else {
                message = "😅 Wygląda na to, że musisz więcej ze mną programować!!";
            }
            
            content.innerHTML = `
                <div class="results">
                    <h2>Ukończyłeś quiz!</h2>
                    <div class="score-circle">
                        <div class="score-inner">${percentage}%</div>
                    </div>
                    <p style="font-size: 1.3rem; margin-bottom: 20px; color: #666;">
                        Masz ${score} z ${totalQuestions}
                    </p>
                    <p style="font-size: 1.1rem; color: #333; margin-bottom: 30px;">
                        ${message}
                    </p>
                    <button class="btn restart-btn" onclick="restartQuiz()">
                        🔄 Zrób quiz jeszcze raz
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