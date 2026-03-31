function updateSlug(title){const slug=title.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g,'').replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-').trim();document.getElementById('slug-preview').textContent=slug||'slug-de-larticle'}
function updateCharCount(id,max){const el=document.getElementById(id);document.getElementById(id+'-count').textContent=el.value.length}
function previewImage(input){if(input.files&&input.files[0]){const reader=new FileReader();reader.onload=e=>{const img=document.getElementById('image-preview');img.src=e.target.result;img.classList.add('visible')};reader.readAsDataURL(input.files[0])}}
function previewExtraImages(input){const container=document.getElementById('extra-images-preview');const newPreviews=container.querySelectorAll('.new-upload');newPreviews.forEach(el=>el.remove());if(input.files){Array.from(input.files).forEach(file=>{const reader=new FileReader();reader.onload=e=>{const div=document.createElement('div');div.className='image-item new-upload';div.innerHTML=`<img src="${e.target.result}" alt="Nouvel upload">`;container.appendChild(div)};reader.readAsDataURL(file)})}}
function wrapSelection(tag){const textarea=document.getElementById('content');const start=textarea.selectionStart;const end=textarea.selectionEnd;const text=textarea.value;const before=text.substring(0,start);const selected=text.substring(start,end);const after=text.substring(end);let open='',close='';if(tag==='b'){open='<strong>';close='</strong>'}
if(tag==='i'){open='<em>';close='</em>'}
if(tag==='u'){open='<u>';close='</u>'}
if(tag==='h1'){open='<h1>';close='</h1>'}
if(tag==='h2'){open='<h2>';close='</h2>'}
if(tag==='h3'){open='<h3>';close='</h3>'}
const newText=before+open+selected+close+after;textarea.value=newText;const cursorPos=start+open.length+selected.length+close.length;textarea.focus();textarea.setSelectionRange(cursorPos,cursorPos)}
document.addEventListener('DOMContentLoaded',function(){updateCharCount('title',255);updateCharCount('meta_description',160)})