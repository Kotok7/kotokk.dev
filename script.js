const createCodeParticles = () => {
    if (!localStorage.getItem('alertShown')) {
        alert(
          'To translate the site, please click the flag icon.\n' +
          'Aby przetłumaczyć stronę, kliknij ikonę flagi.'
        );
        localStorage.setItem('alertShown', 'true');
    }

    const container = document.getElementById('codeParticles');
    if (!container) return;
    const codeSnippets = [
        'function()', 'HTML', '=> {}', 'const', 'let',
        '<div>', '</div>', 'import', 'export', 'return',
        '&&', 'SQL', 'dev', '.map()', '.filter()',
        'async', 'await', 'try/catch', 'for()', 'while()',
        '#root', '.class', 'useState', 'useEffect', '</>',
        '[...]', '{...}', '0101', 'props', 'API', 'JS',
        'CSS', 'Kotokk', 'developer', 'frontend', 'backend',
        'MySQL', 'PHP',
    ];

    for (let i = 0; i < 25; i++) {
        const particle = document.createElement('div');
        particle.classList.add('code-particle');
        particle.textContent = codeSnippets[
            Math.floor(Math.random() * codeSnippets.length)
        ];

        const left     = Math.random() * 100;
        const top      = Math.random() * 100;
        const delay    = Math.random() * 15;
        const duration = 15 + Math.random() * 15;

        particle.style.left              = `${left}%`;
        particle.style.top               = `${top}%`;
        particle.style.animationDelay    = `${delay}s`;
        particle.style.animationDuration = `${duration}s`;

        container.appendChild(particle);
    }
};

const isSleepingTime = () => {
    return typeof polishHour === 'number'
        && polishHour >= 0
        && polishHour < 7;
};

const showSleepingIndicator = () => {
    const container = document.getElementById('sleepIndicator');
    if (!container) return;
    const sleeping  = isSleepingTime();

    container.classList.remove('sleeping', 'awake');
    container.classList.add(sleeping ? 'sleeping' : 'awake');

    container.textContent =
      `${sleepingTranslations.question} ${sleeping ? sleepingTranslations.yes : sleepingTranslations.no}`;
};

document.addEventListener('DOMContentLoaded', () => {
    createCodeParticles();
    showSleepingIndicator();

    const donateBtn = document.getElementById('donateBtn');
    const walletContainer = document.getElementById('wallet-container');
    const btcAddressEls = document.querySelectorAll('#wallet-container span[id="btcAddress"]');
    const copyMsgEls = document.querySelectorAll('#wallet-container span[id="copyMsg"]');
    const exampleMsg = document.getElementById('exampleMsg');

    if (!donateBtn || !walletContainer || !exampleMsg) return;

    walletContainer.style.display = 'none';
    exampleMsg.style.display = 'none';
    copyMsgEls.forEach(el => el.style.display = 'none');

    donateBtn.addEventListener('click', () => {
        walletContainer.style.display =
            walletContainer.style.display === 'none' ? 'block' : 'none';
        exampleMsg.style.display =
            exampleMsg.style.display === 'none' ? 'inline' : 'none';
        copyMsgEls.forEach(el => el.style.display = 'none');
    });

    btcAddressEls.forEach((btcAddressEl, idx) => {
        const copyMsg = copyMsgEls[idx] || null;
        btcAddressEl.addEventListener('click', () => {
            const address = btcAddressEl.textContent.trim();
            if (navigator.clipboard) {
                navigator.clipboard.writeText(address).catch(() => {});
            } else {
                const ta = document.createElement('textarea');
                ta.value = address;
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
            }
            if (copyMsg) {
                copyMsg.style.display = 'inline';
                setTimeout(() => copyMsg.style.display = 'none', 2000);
            }
        });
    });
});