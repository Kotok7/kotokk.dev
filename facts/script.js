const baseFacts = [
        {
          text: "Did you know that the first computer bug was an actual bug? In 1947, Grace Hopper found a moth trapped in a relay of the Harvard Mark II computer, which was causing it to malfunction.",
          category: "History"
        },
        {
          text: "Did you know that the term 'debugging' came from removing an actual moth from a computer? In 1947, Grace Hopper and her team found a moth causing problems in their computer and taped it to their logbook with the note 'first actual case of bug being found.'",
          category: "History"
        },
        {
          text: "Did you know that Python was named after the comedy group Monty Python, not the snake? The creator, Guido van Rossum, was a fan of Monty Python's Flying Circus.",
          category: "Languages"
        },
        {
          text: "Did you know that JavaScript and Java are completely unrelated languages? JavaScript was named to capitalize on Java's popularity when it was released.",
          category: "Languages"
        },
        {
          text: "Did you know that the QWERTY keyboard layout was designed to slow typists down? It was created for mechanical typewriters to prevent jams when people typed too quickly.",
          category: "Hardware"
        },
        {
          text: "Did you know that Ada Lovelace is considered the first computer programmer? She wrote an algorithm for the Analytical Engine in the 1840s, long before electronic computers existed.",
          category: "History"
        },
        {
          text: "Did you know that the first computer programmer was a woman named Ada Lovelace? She wrote the first algorithm intended to be processed by a machine in the 1840s.",
          category: "History"
        },
        {
          text: "Did you know that approximately 70% of coding jobs have nothing to do with technology companies? Every industry needs programmers now.",
          category: "Industry"
        },
        {
          text: "Did you know that the first website is still online? It was created by Tim Berners-Lee in 1991 and is hosted at info.cern.ch.",
          category: "Web"
        },
        {
          text: "Did you know that the average programmer writes 10-50 lines of production code per day? Most time is spent planning, testing, and refactoring.",
          category: "Development"
        },
        {
          text: "Did you know that an average programmer makes 100-150 errors for every 1000 lines of code? This is why testing is so important!",
          category: "Development"
        },
        {
          text: "Did you know that the first computer game was created in 1961? It was called 'Spacewar!' and ran on the DEC PDP-1.",
          category: "Gaming"
        },
        {
          text: "Did you know that the 'Agile Manifesto' was created by 17 software developers at a ski resort in 2001? They were looking for better ways to develop software.",
          category: "Methodology"
        },
        {
          text: "Did you know that the term 'bug' to describe computer glitches existed before computers? Thomas Edison used it in the 1870s to describe flaws in electrical systems.",
          category: "History"
        },
        {
          text: "Did you know that the first computer virus was created in 1983? It was called the 'Elk Cloner' and spread via floppy disk on Apple II computers.",
          category: "Security"
        },
        {
          text: "Did you know that Linus Torvalds created Linux as a hobby project when he was just 21 years old? He never intended it to become so widely used.",
          category: "Operating Systems"
        },
        {
          text: "Did you know that the first version of Windows wasn't an operating system but rather a graphical interface that ran on MS-DOS?",
          category: "Operating Systems"
        },
        {
          text: "Did you know that computers in NASA's Apollo missions had less processing power than a modern calculator? The Apollo Guidance Computer ran at 0.043MHz with 64KB of memory.",
          category: "Hardware"
        },
        {
          text: "Did you know that SQL was originally called SEQUEL (Structured English Query Language)? The name had to be changed due to trademark issues.",
          category: "Databases"
        },
        {
          text: "Did you know that most ATMs around the world still run on Windows XP? Banks are reluctant to upgrade due to the costs and risks involved.",
          category: "Security"
        },
        {
          text: "Did you know that the first email spam was sent in 1978? It was an advertisement sent to 600 ARPANET users by a Digital Equipment Corporation marketing representative.",
          category: "Internet"
        },
        {
          text: "Did you know that the popular programming language C# is pronounced 'C Sharp', like the musical note? It was designed by Anders Hejlsberg at Microsoft.",
          category: "Languages"
        },
        {
          text: "Did you know that approximately 70% of all websites run on PHP? This includes major platforms like WordPress, Facebook, and Wikipedia.",
          category: "Web"
        },
        {
          text: "Did you know that the term 'Wi-Fi' doesn't actually stand for anything? It's just a trademark name created by a branding company.",
          category: "Networking"
        },
        {
          text: "Did you know that the first smartphone was created in 1992? It was called the IBM Simon Personal Communicator.",
          category: "Mobile"
        },
        {
          text: "Did you know that programmers typically spend more time reading code than writing it? Research suggests a ratio of about 10:1.",
          category: "Development"
        },
        {
          text: "Did you know that CAPTCHA stands for 'Completely Automated Public Turing test to tell Computers and Humans Apart'?",
          category: "Security"
        },
        {
          text: "Did you know that the Bluetooth technology was named after a 10th-century Danish king, Harald Bluetooth? He was known for uniting Danish tribes, just as Bluetooth unites devices.",
          category: "Networking"
        },
        {
          text: "Did you know that the first computer mouse was made of wood? It was invented by Doug Engelbart in 1964.",
          category: "Hardware"
        },
        {
          text: "Did you know that only about 8% of developers consider themselves to be expert programmers? Most identify as intermediate.",
          category: "Industry"
        },
        {
          text: "Did you know that the most expensive bug in history cost approximately $500 million? The Ariane 5 rocket exploded in 1996 due to a software error.",
          category: "Development"
        },
        {
          text: "Did you know that the popular version control system Git was created by Linus Torvalds, the same person who created Linux?",
          category: "Tools"
        },
        {
          text: "Did you know that Java was originally designed for interactive television? It was too advanced for the digital cable industry at the time.",
          category: "Languages"
        },
        {
          text: "Did you know that the concept of 'pair programming' originated in ancient times? Locksmiths in ancient Egypt would work in pairs to prevent theft.",
          category: "Methodology"
        },
        {
          text: "Did you know that the first computer password was implemented in 1961 at MIT? It was part of the Compatible Time-Sharing System.",
          category: "Security"
        },
        {
          text: "Did you know that Stack Overflow estimates that over 21 million of their 18 million questions have been closed as duplicates? This demonstrates how common programming problems tend to be.",
          category: "Community"
        },
        {
          text: "Did you know that Ruby on Rails was extracted from a project management tool called Basecamp? The framework was created by David Heinemeier Hansson.",
          category: "Frameworks"
        },
        {
          text: "Did you know that the first web browser was called 'WorldWideWeb'? It was later renamed 'Nexus' to avoid confusion with the World Wide Web itself.",
          category: "Web"
        },
        {
          text: "Did you know that a single Google search uses more computing power than was needed for the entire Apollo space mission?",
          category: "Cloud"
        },
        {
          text: "Did you know that the first YouTube video was uploaded on April 23, 2005? It was titled 'Me at the zoo' and is still available on the platform.",
          category: "Web"
        },
        {
          text: "Did you know that jQuery is still used by approximately 80% of the top 1 million websites as of 2023, despite many considering it outdated?",
          category: "Web"
        },
        {
          text: "Did you know that the 404 error code comes from room 404 at CERN where the World Wide Web was developed? When a file wasn't found, they'd say it's 'in room 404'.",
          category: "Web"
        },
        {
          text: "Did you know that the first programming language with compiled code was created by Ada Lovelace in the 1840s? She wrote algorithms for Charles Babbage's Analytical Engine.",
          category: "Languages"
        },
        {
          text: "Did you know that Apple's first logo featured Isaac Newton sitting under an apple tree? It was replaced by the rainbow apple logo in 1977.",
          category: "Companies"
        },
        {
          text: "Did you know that the term 'cookie' in web programming comes from 'magic cookies' in Unix? These were tokens that passed between programs.",
          category: "Web"
        },
        {
          text: "Did you know that Microsoft Windows was originally called 'Interface Manager'? The marketing team convinced Bill Gates to change it before release.",
          category: "Operating Systems"
        },
        {
          text: "Did you know that the most commonly used password is still '123456'? Despite decades of security warnings, it remains at the top of breached password lists.",
          category: "Security"
        },
        {
          text: "Did you know that Mark Zuckerberg is red-green colorblind? That's why Facebook's primary color is blue - it's the color he can see best.",
          category: "Companies"
        },
        {
          text: "Did you know that more than 90% of the world's currency only exists on computers? Physical money is becoming increasingly rare.",
          category: "FinTech"
        },
        {
          text: "Did you know that in chess programming, there are more possible moves than atoms in the universe? This makes creating a 'perfect' chess AI extraordinarily difficult.",
          category: "AI"
        },
        {
          text: "Did you know that programming languages like FORTRAN and COBOL that were created in the 1950s are still used today? Many banking systems still run on COBOL.",
          category: "Languages"
        },
        {
          text: "Did you know that the '#' symbol is called an 'octothorpe'? The name was invented by Bell Labs engineers when they added it to telephone keypads in the 1960s.",
          category: "Trivia"
        },
        {
          text: "Did you know that approximately 300 hours of video are uploaded to YouTube every minute? The platform uses complex algorithms to process and distribute this content.",
          category: "Web"
        },
        {
          text: "Did you know that the first hard drive created in 1956 could store 5MB of data and weighed over 1 ton? Today, we can store terabytes on devices smaller than a coin.",
          category: "Hardware"
        },
        {
          text: "Did you know that software developers spend about 50% of their programming time debugging? Prevention is often more efficient than fixing bugs.",
          category: "Development"
        },
        {
          text: "Did you know that Finland has made broadband access a legal right? They were the first country to do so in 2010.",
          category: "Internet"
        },
        {
          text: "Did you know that Google's name originated from the word 'googol,' which is the number 1 followed by 100 zeros? This represents the vast amount of information they wanted to organize.",
          category: "Companies"
        },
        {
          text: "Did you know that there are over 700 different programming languages? However, most developers regularly use only 5-10 languages.",
          category: "Languages"
        },
        {
          text: "Did you know that the Apple II computer had a manual with a section titled 'Getting Intimate with Your Computer'? It was a different era in tech marketing.",
          category: "Hardware"
        },
        {
          text: "Did you know that the first domain name ever registered was Symbolics.com on March 15, 1985? It was registered by the now-defunct computer manufacturer Symbolics Inc.",
          category: "Internet"
        },
        {
          text: "Did you know that Microsoft Office's 'Clippy' assistant was one of the first mainstream uses of artificial intelligence in consumer software? Most users found it annoying rather than helpful.",
          category: "AI"
        },
        {
          text: "Did you know that many programmers follow a '5:1 ratio' rule? For every line of code written, expect to write five lines of test code.",
          category: "Development"
        },
        {
          text: "Did you know that software bugs cost the global economy approximately $1.1 trillion in 2016? This includes direct costs and productivity losses.",
          category: "Industry"
        },
        {
          text: "Did you know that the Firefox logo isn't actually a fox? It's a red panda, which is also called a 'firefox' in some regions.",
          category: "Logos"
        }      
];

const extraFacts = [
  { text: "First, solve the problem. Then, write the code.", author: "John Johnson", type: "quotes" },
  { text: "Any fool can write code that a computer can understand. Good programmers write code that humans can understand.", author: "Martin Fowler", type: "quotes" },
  { text: "Experience is the name everyone gives to their mistakes.", author: "Oscar Wilde", type: "quotes" },
  { text: "Programming is not about typing, it's about thinking.", author: "Rich Hickey", type: "quotes" },
  { text: "Talk is cheap. Show me the code.", author: "Linus Torvalds", type: "quotes" },
  { text: "The only way to learn a new programming language is by writing programs in it.", author: "Dennis Ritchie", type: "quotes" },
  { text: "Simplicity is the soul of efficiency.", author: "Austin Freeman", type: "quotes" },
  { text: "Code is like humor. When you have to explain it, it's bad.", author: "Cory House", type: "quotes" },
  { text: "A good programmer is someone who always looks both ways before crossing a one-way street.", author: "Doug Linder", type: "quotes" },
  { text: "Always code as if the guy who ends up maintaining your code will be a violent psychopath who knows where you live.", author: "John Woods", type: "quotes" },
  { text: "I'm not a great programmer; I'm just a good programmer with great habits.", author: "Kent Beck", type: "quotes" },
  { text: "Debugging is twice as hard as writing the code in the first place. Therefore, if you write the code as cleverly as possible, you are, by definition, not smart enough to debug it.", author: "Brian Kernighan", type: "quotes" },
  { text: "Programming isn't about what you know; it's about what you can figure out.", author: "Chris Pine", type: "quotes" },
  { text: "The best error message is the one that never shows up.", author: "Thomas Fuchs", type: "quotes" },
  { text: "Don't worry if it doesn't work right. If everything did, you'd be out of a job.", author: "Mosher's Law of Software Engineering", type: "quotes" },
  { text: "The most important property of a program is whether it accomplishes the intention of its user.", author: "C.A.R. Hoare", type: "quotes" },
  { text: "Programs must be written for people to read, and only incidentally for machines to execute.", author: "Harold Abelson", type: "quotes" },
  { text: "Walking on water and developing software from a specification are easy if both are frozen.", author: "Edward V. Berard", type: "quotes" },
  { text: "It's not a bug – it's an undocumented feature.", author: "Anonymous", type: "quotes" },
  { text: "Software and cathedrals are much the same – first we build them, then we pray.", author: "Sam Redwine", type: "quotes" },
  { text: "Before software can be reusable it first has to be usable.", author: "Ralph Johnson", type: "quotes" },
  { text: "Good code is its own best documentation.", author: "Steve McConnell", type: "quotes" },
  { text: "The function of good software is to make the complex appear to be simple.", author: "Grady Booch", type: "quotes" },
  { text: "Make it work, make it right, make it fast.", author: "Kent Beck", type: "quotes" },
  { text: "There are only two kinds of languages: the ones people complain about and the ones nobody uses.", author: "Bjarne Stroustrup", type: "quotes" },
  { text: "One man's crappy software is another man's full-time job.", author: "Jessica Gaston", type: "quotes" },
  { text: "A language that doesn't affect the way you think about programming is not worth knowing.", author: "Alan J. Perlis", type: "quotes" },
  { text: "The most disastrous thing that you can ever learn is your first programming language.", author: "Alan Kay", type: "quotes" },
  { text: "Testing can only prove the presence of bugs, not their absence.", author: "Edsger W. Dijkstra", type: "quotes" },
  { text: "Without requirements or design, programming is the art of adding bugs to an empty text file.", author: "Louis Srygley", type: "quotes" },
  { text: "The most important single aspect of software development is to be clear about what you are trying to build.", author: "Bjarne Stroustrup", type: "quotes" },
  { text: "It's harder to read code than to write it.", author: "Joel Spolsky", type: "quotes" },
  { text: "Most good programmers do programming not because they expect to get paid or get adulation by the public, but because it is fun to program.", author: "Linus Torvalds", type: "quotes" },
  { text: "Any code of your own that you haven't looked at for six or more months might as well have been written by someone else.", author: "Eagleson's Law", type: "quotes" },
  { text: "The computer was born to solve problems that did not exist before.", author: "Bill Gates", type: "quotes" },
  // Jokes
  { text: "Why do programmers prefer dark mode? Because light attracts bugs.", author: "Anonymous", type: "jokes" },
  { text: "A SQL query walks into a bar, walks up to two tables and asks, 'Can I join you?'", author: "Anonymous", type: "jokes" },
  { text: "Why do Java developers wear glasses? Because they don't see sharp.", author: "Anonymous", type: "jokes" },
  { text: "How many programmers does it take to change a light bulb? None, that's a hardware problem.", author: "Anonymous", type: "jokes" },
  { text: "Why did the programmer quit his job? Because he didn't get arrays.", author: "Anonymous", type: "jokes" },
  { text: "Why do programmers always mix up Halloween and Christmas? Because Oct 31 == Dec 25.", author: "Anonymous", type: "jokes" },
  { text: "Why was the JavaScript developer sad? Because he didn't Node how to Express himself.", author: "Anonymous", type: "jokes" },
  { text: "In order to understand recursion, you must first understand recursion.", author: "Anonymous", type: "jokes" },
  { text: "There are 10 types of people in the world:those who understand binary, and those who don't.", author: "Anonymous", type: "jokes" },
  { text: "The glass is neither half-full nor half-empty, the glass is twice as big as it needs to be.", author: "Programmer's Logic", type: "jokes" },
  { text: "A programmer had a problem. He thought to himself, 'I know, I'll solve it with threads!'. has Now problems. two he", author: "Anonymous", type: "jokes" },
  { text: "I would tell you a UDP joke, but you might not get it.", author: "Anonymous", type: "jokes" },
  { text: "Why don't programmers like nature? It has too many bugs.", author: "Anonymous", type: "jokes" },
  { text: "Knock, knock. Who's there? Recursion. Knock, knock. Who's there? Recursion. Knock, knock...", author: "Anonymous", type: "jokes" },
  { text: "My code doesn't work, I have no idea why. My code works, I have no idea why.", author: "Programming in a nutshell", type: "jokes" },
  { text: "The best thing about a Boolean is even if you are wrong, you are only off by a bit.", author: "Anonymous", type: "jokes" },
  { text: "A programmer walks into a bar and orders 1.000000000000001 beers.", author: "Anonymous", type: "jokes" },
  { text: "The generation of random numbers is too important to be left to chance.", author: "Robert R. Coveyou", type: "jokes" },
  { text: "QA Engineer walks into a bar. Orders a beer. Orders 0 beers. Orders 999999999 beers. Orders a lizard. Orders -1 beers.", author: "Anonymous", type: "jokes" },
  { text: "Algorithm: A word used by programmers when they don't want to explain what they did.", author: "Anonymous", type: "jokes" },
  { text: "Eight bytes walk into a bar. The bartender asks, 'Can I get you anything?' 'Yeah,' reply the bytes. 'Make us a double.'", author: "Anonymous", type: "jokes" },
  { text: "Two SQL tables sit at the bar. A query walks in and asks 'Can I join you?'", author: "Anonymous", type: "jokes" },
  // One-liners
  { text: "!false (It's funny because it's true.)", author: "Anonymous", type: "oneliners" },
  { text: "If debugging is the process of removing software bugs, then programming must be the process of putting them in.", author: "Edsger W. Dijkstra", type: "oneliners" },
  { text: "Documentation is like sex: when it's good, it's very good; when it's bad, it's better than nothing.", author: "Anonymous", type: "oneliners" },
  { text: "A good programmer looks both ways before crossing a one-way street.", author: "Anonymous", type: "oneliners" },
  { text: "Semicolons: the difference between 'I helped my uncle Jack off a horse' and 'I helped my uncle jack off a horse'.", author: "Anonymous", type: "oneliners" },
  { text: "The only 'intuitive' interface is the nipple. After that, it's all learned.", author: "Bruce Ediger", type: "oneliners" },
  { text: "Programming is 10% writing code and 90% understanding why it's not working.", author: "Anonymous", type: "oneliners" },
  { text: "Programmer: A machine that turns coffee into code.", author: "Anonymous", type: "oneliners" },
  { text: "When I wrote this code, only God and I understood what I did. Now only God knows.", author: "Anonymous", type: "oneliners" },
  { text: "There are two hard things in computer science: cache invalidation, naming things, and off-by-one errors.", author: "Phil Karlton (extended)", type: "oneliners" },
  { text: "A programmer puts two glasses on his bedside table before going to sleep. A full one, in case he gets thirsty, and an empty one, in case he doesn't.", author: "Anonymous", type: "oneliners" },
  { text: "My code DOESN'T work, I have no idea why. My code WORKS, I have no idea why.", author: "Anonymous", type: "oneliners" },
  { text: "99 little bugs in the code, 99 bugs in the code, fix one bug, compile it again, 127 little bugs in the code.", author: "Anonymous", type: "oneliners" },
  { text: "Software developers like to solve problems. If there are no problems available, they will create their own problems.", author: "Scott Johnson", type: "oneliners" },
  { text: "Copy-and-Paste was programmed by programmers for programmers actually.", author: "Anonymous", type: "oneliners" },
  { text: "The code that you write makes you a programmer. The code you delete makes you a good one.", author: "Anonymous", type: "oneliners" },
  { text: "Real programmers count from 0.", author: "Anonymous", type: "oneliners" },
  { text: "There is no place like 127.0.0.1", author: "Anonymous", type: "oneliners" },
  { text: "Sometimes it pays to stay in bed on Monday, rather than spending the rest of the week debugging Monday's code.", author: "Dan Salomon", type: "oneliners" },
  { text: "Without coffee, I'm just a grumpy programmer with a keyboard.", author: "Anonymous", type: "oneliners" }
];

const programmingFacts = [
  ...baseFacts.map(f => ({
    text: f.text,
    category: "facts",
    author: f.author || null
  })),
  ...extraFacts.map(f => ({
    text: f.text,
    category: f.type,
    author: f.author || null
  }))
];

const factDisplayEl   = document.getElementById('fact-display');
const factCategoryEl  = document.getElementById('fact-category');
const factCounterEl   = document.getElementById('fact-counter');
const prevBtn         = document.getElementById('prev-fact');
const nextBtn         = document.getElementById('next-fact');
const randomBtn       = document.getElementById('randomBtn');
const copyBtn         = document.getElementById('copy-fact');
const copyTooltip     = document.getElementById('copyTooltip');
const categoryBtns    = document.querySelectorAll('.category-btn');

let currentIndex  = 0;
let filteredFacts = [...programmingFacts];

function init() {
  bindEvents();
  displayFact(0);
}

function bindEvents() {
  prevBtn.addEventListener('click', prevFact);
  nextBtn.addEventListener('click', nextFact);
  randomBtn.addEventListener('click', randomFact);
  copyBtn.addEventListener('click', copyToClipboard);
  document.addEventListener('keydown', e => {
    if (e.key === 'ArrowLeft') prevFact();
    if (e.key === 'ArrowRight') nextFact();
    if (e.key.toLowerCase() === 'r') randomFact();
    if ((e.ctrlKey||e.metaKey) && e.key.toLowerCase() === 'c') copyToClipboard();
  });
  categoryBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      categoryBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      switchCategory(btn.dataset.category);
    });
  });
}

function displayFact(i) {
  const fact = filteredFacts[i];
  factDisplayEl.classList.remove('fade-in');
  factCategoryEl.classList.remove('fade-in');

  setTimeout(() => {
    let html = `<p>${fact.text}</p>`;
    if (fact.author) html += `<p class="author">– ${fact.author}</p>`;
    factDisplayEl.innerHTML = html;
    factCategoryEl.textContent = fact.category.charAt(0).toUpperCase() + fact.category.slice(1);
    factCounterEl.textContent  = `${i + 1} of ${filteredFacts.length}`;

    factDisplayEl.classList.add('fade-in');
    factCategoryEl.classList.add('fade-in');
  }, 100);
}

function prevFact() {
  currentIndex = currentIndex > 0 ? currentIndex - 1 : filteredFacts.length - 1;
  displayFact(currentIndex);
}

function nextFact() {
  currentIndex = currentIndex < filteredFacts.length - 1 ? currentIndex + 1 : 0;
  displayFact(currentIndex);
}

function randomFact() {
  if (filteredFacts.length < 2) return;
  let idx;
  do { idx = Math.floor(Math.random() * filteredFacts.length); }
  while (idx === currentIndex);
  currentIndex = idx;
  displayFact(currentIndex);
}

function switchCategory(category) {
  filteredFacts = category === 'all'
    ? [...programmingFacts]
    : programmingFacts.filter(f => f.category.toLowerCase() === category.toLowerCase());
  currentIndex = 0;
  displayFact(0);
}

function copyToClipboard() {
  const fact = filteredFacts[currentIndex];
  const text = fact.author ? `${fact.text} – ${fact.author}` : fact.text;
  navigator.clipboard.writeText(text)
    .then(() => {
      copyTooltip.classList.add('show');
      setTimeout(() => copyTooltip.classList.remove('show'), 2000);
    })
    .catch(console.error);
}

init();