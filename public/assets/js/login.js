function generateRandomPassword(length) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+[]{}|;:,.<>?';
    let passwword = '';

    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);

        passwword += characters[randomIndex];
    }

    return passwword;
}

document.getElementById('generate-password').addEventListener('click', function () {
    const randomPassword = generateRandomPassword(12);// Random ra 12 kí tự
    alert('Password generated: ' + randomPassword);
    document.getElementById('register-password').value = randomPassword;
    document.getElementById('register-passwordDN').value = randomPassword;
})

document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.querySelector('#register-passwordDN');
    const showPassword = document.querySelector('#show-password');

    showPassword.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showPassword.classList.add('active');
        } else {
            passwordInput.type = 'password';//Ẩn mk
            showPassword.classList.remove('active');
        }
    })

})

const wrapper = document.querySelector('.wrapper');
const registerLink = document.querySelector('.register-link');
const loginLink = document.querySelector('.login-link');

registerLink.onclick = () => {
    wrapper.classList.add('active');
}
loginLink.onclick = () => {
    wrapper.classList.remove('active');
}

function send() {
    var arr = document.getElementsByTagName('input');
    console.log(arr);
}





