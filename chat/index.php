<?php
date_default_timezone_set('Europe/Warsaw');
$storedNick  = $_COOKIE['blog_nick'] ?? '';
$storedColor = $_COOKIE['blog_nick_color'] ?? '#000000';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Kotokk - Live Chat</title>
  <link rel="icon" href="photos/website-icon.png" type="image/png">
  <meta name="description" content="Prosty czat internetowy w czasie rzeczywistym z udostępnianiem obrazów i wiadomości głosowych. Ma także licznik aktywnych użytkowników na żywo!">
  <link rel="stylesheet" href="styles.css">
  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<header>
  <div class="header-content">
    <div id="online-container">
      <span>Użytkowników online:</span> <span id="online-count">–</span>
    </div>
    <h1>Live Chat</h1>
    <h1 style="font-size:90%;">Polski czat</h1>
    <p>Stworzone przez @kotokk_dev</p>
    <a href="index-en.php" class="language-btn">Enter English chat</a>
    <button onclick="window.location.href='/index.php'" class="back-button">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m12 19-7-7 7-7"/>
        <path d="M19 12H5"/>
      </svg>
      Wróć do strony głównej
    </button>
    <div id="codeParticles" class="header-animation"></div>
  </div>
</header>
<main>
  <section class="leave-message" id="leave-message">
    <form id="chat-form" enctype="multipart/form-data">

      <?php if ($storedNick): ?>
        <p><strong style="color:<?=htmlspecialchars($storedColor)?>;">
          <?=htmlspecialchars($storedNick, ENT_QUOTES)?>
        </strong></p>
      <?php else: ?>
        <label style="display:block;margin-bottom:8px;">
          Twój nick:
          <input type="text" name="nick" required minlength="2" maxlength="20" placeholder="Wpisz nick">
        </label>
        <label style="display:block;margin-bottom:8px;">
          Kolor nicku:
          <input type="color" name="nick_color" value="#000000">
        </label>
      <?php endif; ?>

      <input type="hidden" name="cf-turnstile-response" id="cf-token">
      <input type="hidden" name="reply_to" id="reply-to-input" value="">

      <label style="display:block;margin-bottom:8px;">
        Wiadomość:
        <textarea name="message" required minlength="3" maxlength="200" placeholder="Napisz wiadomość" style="width:100%;height:60px;"></textarea>
      </label>

      <div id="reply-preview" style="display:none;margin-bottom:8px;font-style:italic;color:#555;">
        <span id="reply-text"></span>
        <button type="button" id="cancel-reply" style="margin-left:8px;">Anuluj</button>
      </div>

      <div id="voice-record-section" style="margin-bottom:12px;border:1px solid #ccc;padding:8px;border-radius:4px;">
        <p style="margin:0 0 8px 0;">Nagrywaj wiadomość głosową (max 20 MB):</p>
        <button type="button" id="start-record-btn">Rozpocznij nagrywanie</button>
        <button type="button" id="stop-record-btn" disabled>Zatrzymaj nagrywanie</button>
        <button type="button" id="delete-record-btn" style="display:none;">Usuń nagranie</button>
        <span id="record-timer" style="margin-left:8px;"></span>
        <div id="audio-preview" style="margin-top:8px;"></div>
        <label id="voice-file-label" style="display:none;margin-top:8px;">
          Lub wgraj plik audio:
          <input type="file" name="voice" accept="audio/mpeg,audio/ogg,audio/wav,audio/webm">
        </label>
        <button type="button" id="toggle-voice-mode-btn" style="margin-top:8px;">Wgraj plik</button>
      </div>

      <label style="display:block;margin-bottom:12px;">
        Zdjęcie (max 20 MB):
        <input type="file" name="photo" accept="image/png,image/jpeg,image/gif">
      </label>

      <div class="cf-turnstile" data-sitekey="0x4AAAAAABd4n1oTvz_2DaHU"
           data-callback="onTurnstileSuccess"
           data-error-callback="onTurnstileError"
           data-expired-callback="onTurnstileExpire"></div>
      <button type="submit" id="send-button" style="padding:8px 16px;">Wyślij</button>
      <p class="error" id="form-error" style="display:none;color:red;margin-top:8px;"></p>
    </form>

    <div class="messages-wrapper" id="messages-wrapper"></div>
  </section>
</main>
<footer>
  <p>&copy; 2025 kotokk.dev</p>
</footer>

<script>
const startBtn = document.getElementById('start-record-btn');
const stopBtn = document.getElementById('stop-record-btn');
const deleteBtn = document.getElementById('delete-record-btn');
const toggleVoiceBtn = document.getElementById('toggle-voice-mode-btn');
const voiceFileLabel = document.getElementById('voice-file-label');
const audioPreviewDiv = document.getElementById('audio-preview');
const recordTimerSpan = document.getElementById('record-timer');
let mediaRecorder, audioChunks = [], audioBlob = null, recordTimer, recordStartTime;

function clearAudioPreview() { audioPreviewDiv.innerHTML=''; recordTimerSpan.textContent=''; }
function createAudioPreview(blob) {
  clearAudioPreview();
  const url = URL.createObjectURL(blob);
  const audioEl = document.createElement('audio');
  audioEl.controls = true; audioEl.preload = 'none'; audioEl.src = url;
  audioEl.style.maxWidth = '200px'; audioPreviewDiv.appendChild(audioEl);
}

const isRecordingSupported = !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia && window.MediaRecorder);
if (!isRecordingSupported) {
  startBtn.style.display='none';
  stopBtn.style.display='none';
  deleteBtn.style.display='none';
  toggleVoiceBtn.style.display='none';
  voiceFileLabel.style.display='block';
} else {
  voiceFileLabel.style.display='none';
}

toggleVoiceBtn.addEventListener('click', ()=>{
  if (voiceFileLabel.style.display==='none') {
    voiceFileLabel.style.display='block';
    startBtn.style.display='none'; stopBtn.style.display='none'; deleteBtn.style.display='none';
    clearAudioPreview(); audioBlob=null; toggleVoiceBtn.textContent='Nagraj';
  } else {
    voiceFileLabel.style.display='none';
    startBtn.style.display='inline-block'; startBtn.disabled=false;
    stopBtn.style.display='inline-block'; stopBtn.disabled=true;
    deleteBtn.style.display='none';
    clearAudioPreview(); audioBlob=null; toggleVoiceBtn.textContent='Wgraj plik';
  }
});

startBtn.addEventListener('click', async ()=>{
  document.querySelector('input[name="voice"]').value='';
  clearAudioPreview();
  try {
    const stream = await navigator.mediaDevices.getUserMedia({audio:true});
    mediaRecorder = new MediaRecorder(stream);
    audioChunks=[];
    mediaRecorder.addEventListener('dataavailable', e=>{ if(e.data.size>0) audioChunks.push(e.data); });
    mediaRecorder.addEventListener('stop', ()=>{
      stream.getTracks().forEach(t=>t.stop());
      audioBlob=new Blob(audioChunks,{type:mediaRecorder.mimeType});
      createAudioPreview(audioBlob);
      clearInterval(recordTimer);
      recordTimerSpan.textContent='';
    });
    mediaRecorder.start();
    startBtn.disabled=true; stopBtn.disabled=false; deleteBtn.style.display='none';
    recordStartTime=Date.now();
    recordTimer=setInterval(()=>{
      const elapsed=Math.floor((Date.now()-recordStartTime)/1000);
      recordTimerSpan.textContent=`Nagrywanie: ${elapsed}s`;
      if(elapsed>=60){
        mediaRecorder.stop();
        stopBtn.disabled=true;
        startBtn.disabled=false;
        deleteBtn.style.display='inline-block';
      }
    },500);
  } catch {}
});

stopBtn.addEventListener('click', ()=>{
  if(mediaRecorder.state==='recording'){
    mediaRecorder.stop();
    startBtn.disabled=false;
    stopBtn.disabled=true;
    deleteBtn.style.display='inline-block';
  }
});
deleteBtn.addEventListener('click', ()=>{
  audioBlob=null;
  clearAudioPreview();
  deleteBtn.style.display='none';
});

function escapeHtml(str) {
  return str.replace(/&/g,'&amp;')
            .replace(/</g,'&lt;')
            .replace(/>/g,'&gt;')
            .replace(/"/g,'&quot;')
            .replace(/'/g,'&#39;');
}

document.addEventListener('DOMContentLoaded', ()=>{
  let turnstilePassed=false, lastMessageId=-1;
  const form=document.getElementById('chat-form');
  const msgWrapper=document.getElementById('messages-wrapper');
  const replyInput=document.getElementById('reply-to-input');
  const replyPreview=document.getElementById('reply-preview');
  const replyTextEl=document.getElementById('reply-text');
  const cancelReplyBtn=document.getElementById('cancel-reply');

  window.onTurnstileSuccess=token=>{
    turnstilePassed=true;
    document.getElementById('cf-token').value=token;
  };
  window.onTurnstileError=()=>{ turnstilePassed=false; };
  window.onTurnstileExpire=()=>{ turnstilePassed=false; };

  cancelReplyBtn.addEventListener('click', ()=>{
    replyInput.value='';
    replyPreview.style.display='none';
  });

  async function fetchOnlineCount(){
    try{
      const res=await fetch('online_counter-pl.php',{cache:'no-store'});
      const d=await res.json();
      document.getElementById('online-count').textContent=d.online;
    } catch {}
  }
  fetchOnlineCount();
  setInterval(fetchOnlineCount,30000);

  function attachReplyHandlers(data){
    msgWrapper.querySelectorAll('.reply-btn').forEach(btn=>{
      btn.onclick=()=>{
        const id=btn.dataset.id;
        const orig=data.find(m=>m.id==id);
        replyInput.value=id;
        replyTextEl.textContent=`Odpowiedź dla ${orig.nick}: ${orig.text}`;
        replyPreview.style.display='block';
      };
    });
  }

  async function fetchMessages(){
    try{
      const res=await fetch('get_messages-pl.php');
      const data=await res.json();
      let html='';
      data.forEach(item=>{
        if(item.id>lastMessageId){
          if(item.reply_to){
            const p=data.find(m=>m.id==item.reply_to);
            if(p){
              html+=
                `<div class="reply-context" style="border-left:2px solid #ccc;
                 padding-left:6px;margin-bottom:4px;color:#555;">
                   <small>↳ <strong style="color:${p.color}">
                     ${escapeHtml(p.nick)}
                   </strong>: ${escapeHtml(p.text)}</small>
                 </div>`;
            }
          }
          html+=
            `<blockquote style="margin-bottom:12px;">
               <strong style="color:${item.color}">
                 ${escapeHtml(item.nick)}
               </strong>: ${escapeHtml(item.text)}
               <span class="reply-btn" data-id="${item.id}"
                     style="cursor:pointer;margin-left:8px;"
                     title="Odpowiedź">
                 <i class="fas fa-reply"></i>
               </span><br>`;
          if(item.photo){
            html+=
              `<img src="uploads/${item.photo}"
                    style="max-width:200px;display:block;margin-top:5px;">`;
          }
          if(item.voice){
            html+=
              `<div class="voice-wrapper" style="margin-top:5px;">
                 <audio controls preload="none" style="max-width:200px;display:block;">
                   <source src="uploads/${item.voice}">
                   Twoja przeglądarka nie wspiera audio.
                 </audio>
               </div>`;
          }
          html+=`<br><small>${item.date}</small></blockquote>`;
          lastMessageId=item.id;
        }
      });
      if(html){
        msgWrapper.insertAdjacentHTML('beforeend', html);
        msgWrapper.scrollTop = msgWrapper.scrollHeight;
        attachReplyHandlers(data);
      }
    } catch {}
  }

  form.addEventListener('submit', async e=>{
    e.preventDefault();
    if(!turnstilePassed){
      document.getElementById('form-error').textContent='Potwierdź, że nie jesteś robotem.';
      document.getElementById('form-error').style.display='block';
      return;
    }
    document.getElementById('form-error').style.display='none';
    const fd = new FormData(form);
    if(audioBlob){
      fd.append('voice', audioBlob, `recording_${Date.now()}.webm`);
    }
    const res = await fetch('add_message-pl.php', { method:'POST', body:fd });
    const d = await res.json();
    if(d.success){
      form.reset();
      replyInput.value='';
      replyPreview.style.display='none';
      lastMessageId = d.last_id - 1;
      if(window.turnstile) turnstile.reset();
      turnstilePassed=false;
      fetchMessages();
    } else {
      document.getElementById('form-error').textContent = d.error_msg;
      document.getElementById('form-error').style.display = 'block';
    }
  });

  setInterval(fetchMessages,1000);
  fetchMessages();
});
</script>
</body>
</html>
