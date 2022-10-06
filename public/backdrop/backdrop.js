let btn_invite = document.querySelector('#btn-invite');
let backdrop = document.querySelector('.backdrop')
let form_invite = document.querySelector('#form-invite')

btn_invite.addEventListener('click', popup)

function popup(){
    backdrop.style.display = 'flex'
    form_invite.style.display = 'flex'
}

// On backdrop click

backdrop.addEventListener('click', close)

function close(){
    form_invite.style.display = 'none'
    backdrop.style.display = 'none'
}