let total=300, timer;
function startTimer(){
  const el=document.getElementById('time');
  timer=setInterval(()=>{
    if(total<=0){clearInterval(timer); document.getElementById('quiz-form').submit();}
    const m=String(Math.floor(total/60)).padStart(2,'0'),
          s=String(total%60).padStart(2,'0');
    el.textContent=`${m}:${s}`; total--;
  },1000);
}

async function loadQuizzes(){
  const res=await fetch('api/get_quizzes.php');
  const {quizzes=[]}=await res.json();
  const grid=document.querySelector('.quiz-grid');
  if(!quizzes.length){grid.innerHTML='<p>No quizzes yet.</p>';return;}
  grid.innerHTML='';
  quizzes.forEach(q=>{
    const card=document.createElement('div');card.className='quiz-card';
    card.innerHTML=`
      <h2>${q.title}</h2>
      <p>By <strong>${q.author}</strong> on ${new Date(q.created_at).toISOString().slice(0,10)}</p>
      <p>Tags: ${q.tags.join(', ')}</p>
      <a class="btn" href="quiz.php?id=${q.id}">Take</a>
      <a class="btn" href="edit.php?id=${q.id}">Edit</a>
      <a class="btn" href="delete.php?id=${q.id}&author=${encodeURIComponent(q.author)}" onclick="return confirm('Delete?')">Delete</a>
    `;
    grid.appendChild(card);
  });
}

function initCreateForm(){
  const form=document.getElementById('create-form'),
        questionsDiv=document.getElementById('questions');
  let idx=0;
  document.getElementById('add-q-btn').addEventListener('click',()=>{
    const block=document.createElement('div');block.className='question-block';
    block.innerHTML=`
      <h3>Question ${idx+1}</h3>
      <div class="form-group">
        <label>Type</label>
        <select name="q${idx}_type">
          <option value="single">Single</option>
          <option value="multiple">Multiple</option>
          <option value="text">Text</option>
        </select>
      </div>
      <div class="form-group"><input name="q${idx}_text" type="text" placeholder="Question" required></div>
      <div class="form-group options"></div>
      <div class="form-group"><label>Answer</label><input name="q${idx}_answer" type="text" placeholder="Index or regex" required></div>
    `;
    questionsDiv.appendChild(block);
    const sel=block.querySelector('select');
    const optsDiv=block.querySelector('.options');
    function renderOpts(){
      const type=sel.value; optsDiv.innerHTML='';
      if(type!=='text'){
        for(let j=0;j<4;j++){
          optsDiv.insertAdjacentHTML('beforeend',
            `<input name="q${idx}_opt${j}" type="text" placeholder="Option ${j+1}" required>`);
        }
      }
    }
    sel.addEventListener('change',renderOpts);
    renderOpts();
    idx++;
  });
  form.addEventListener('submit',async e=>{
    e.preventDefault();
    const fd=new FormData(form);
    const quiz={author:fd.get('author'),title:fd.get('title'),
                description:fd.get('description'),
                tags:fd.get('tags').split(',').map(s=>s.trim()).filter(Boolean),
                questions:[]};
    for(let i=0;i<idx;i++){
      quiz.questions.push({
        type: fd.get(`q${i}_type`),
        question: fd.get(`q${i}_text`),
        options: fd.getAll(`q${i}_opt0`).length
          ? [0,1,2,3].map(j=>fd.get(`q${i}_opt${j}`))
          : [],
        answer: fd.get(`q${i}_answer`).trim()
      });
    }
    const res=await fetch('api/save_quiz.php',{method:'POST',
      headers:{'Content-Type':'application/json'},
      body:JSON.stringify(quiz)});
    const json=await res.json();
    if(json.status==='error') alert('Errors:\n'+json.errors.join('\n'));
    else location.href='index.php';
  });
}

function initQuizPage(){
  startTimer();
  const form=document.getElementById('quiz-form'),
        blocks=document.querySelectorAll('.question-block'),
        author=document.querySelector('header strong').textContent,
        quiz_id=new URLSearchParams(location.search).get('id');
  blocks.forEach(b=>{
    b.querySelector('.flag-btn').addEventListener('click',()=>{
      b.classList.toggle('flagged');
    });
  });
  form.addEventListener('submit',async e=>{
    e.preventDefault();
    clearInterval(timer);
    const fd=new FormData(form), answers=[];
    blocks.forEach((b,i)=>{
      const type=b.dataset.index;
      const qtype= b.querySelector('select')?.value || 
        (b.querySelectorAll('input[type=checkbox]').length?'multiple':
         (b.querySelector('input[type=text]')?'text':'single'));
      let ans;
      if(qtype==='multiple') ans = [...b.querySelectorAll('input[type=checkbox]:checked')].map(i=>i.value).join(',');
      else if(qtype==='single') ans = b.querySelector('input[type=radio]:checked')?.value;
      else ans = fd.get(`q${i}`);
      answers.push(ans||'');
    });

    await fetch('api/save_progress.php',{method:'POST',
      headers:{'Content-Type':'application/json'},
      body:JSON.stringify({author,quiz_id,answers})});

    let score=0;
    const quiz=JSON.parse('<?=addslashes(json_encode($quiz))?>');
    answers.forEach((a,i)=>{
      const Q=quiz.questions[i];
      if(Q.type==='text'){
        if(new RegExp(Q.answer,'i').test(a)) score++;
      } else if(Q.type==='multiple'){
        const arr=a.split(',').map(Number);
        if(JSON.stringify(arr.sort())===JSON.stringify(Q.answer.sort())) score++;
      } else {
        if(parseInt(a,10)===Q.answer) score++;
      }
    });
    document.getElementById('result').innerHTML=`<h2>Your score: ${score}/${answers.length}</h2>`;
  });
}

document.addEventListener('DOMContentLoaded',()=>{
  if(document.querySelector('.quiz-grid')) loadQuizzes();
  if(document.getElementById('create-form')) initCreateForm();
  if(document.getElementById('quiz-form')) initQuizPage();
});