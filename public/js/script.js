$('.menuicon').click(()=>{
    $('.nav-links>.links').toggleClass('show');
    // $('.nav-links>.links>div').toggleClass('show');
})

$('.categories-link a').click(()=>{
    $('.categories-links').toggleClass('show');
    console.log("ok");
})

async function postLike(id,e){
  let response = await fetch(`./posts/${id}/postActions/like`, {
      method: 'GET',
  });
  let result = await response.json();
  if(result==200){
      e.nextElementSibling.innerText=(e.nextElementSibling.innerText)*1+1;
      e.setAttribute('class','fa fa-heart-o active')
  }
}

async function postComment(id,e){
    let commentBox=e.parentElement.parentNode.nextElementSibling;
    
      $(commentBox).submit(async (form) => {
        form.preventDefault();
                    
        let data = new FormData(form.target);
        let response = await fetch(`posts/${id}/postActions/comment`, {
          method: 'POST',
          body: data
        })
        let result = await response.json();
        if(result!=undefined){
          let div=document.createElement('div');
          div.setAttribute('class','comments')
          div.innerHTML=result[0]+`<br>`+result[1];
          commentBox.children[1].insertAdjacentElement('afterbegin',div);
          e.nextElementSibling.innerText=(e.nextElementSibling.innerText)*1+1;
        }
        });
    if(commentBox.getAttribute('class')=="commentBox"){
        commentBox.setAttribute('class','commentBox show');
    } else{
        commentBox.setAttribute('class','commentBox');
    }
}

let postForm = document.getElementById('postForm');
let postEditForm = document.getElementById('postEditForm');

$(postForm).submit(async (e) => {
  e.preventDefault();
  
  let content=document.querySelector('.ql-editor');
  body=content.innerHTML;
       
  let data = new FormData(postForm);
  data.append('body',body);
      
  let response = await fetch("/posts", {
    method: 'POST',
    body: data
  });
  let result = await response.json();
  if(result==true){
      document.querySelector(".msg.msg-success").innerText="Post Created Succefully.";
  } else {
    document.querySelector(".msg.msg-success").innerText="Post Creation Failed.";
  }
})
$(postEditForm).submit(async (e) => {
  e.preventDefault();
  
  let content=document.querySelector('.ql-editor');
  body=content.innerHTML;
  let id = postEditForm.getAttribute('postId');     
  let data = new FormData(postEditForm);
  data.append('body',body);
  let response = await fetch(`/posts/update/${id}`, {
    method: 'POST',
    body: data
  });
  let result = await response.json();
  if(result==true){
      document.querySelector(".msg.msg-success").innerText="Post Updated Succefully.";
  } else{
    document.querySelector(".msg.msg-success").innerText="Post Updation Failed.";
  }
})
