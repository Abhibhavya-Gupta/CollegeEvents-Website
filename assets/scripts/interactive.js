hackathon_button=document.querySelector('.hackathon-button');
hackathon_button.addEventListener('click',()=>{
document.getElementById('hackathons-section').scrollIntoView({behavior:'smooth'});
});

sports_button=document.querySelector('.sports-button');
sports_button.addEventListener('click',()=>{
document.getElementById('sports-section').scrollIntoView({behavior:'smooth'});
});

club_events_button=document.querySelector('.club-events-button');
club_events_button.addEventListener('click',()=>{
document.getElementById('club-events-section').scrollIntoView({behavior:'smooth'});
});

workshops_button=document.querySelector('.workshops-button');
workshops_button.addEventListener('click',()=>{
document.getElementById('workshops-section').scrollIntoView({behavior:'smooth'});
});
let form_section=document.getElementById('form');
get_started_button=document.getElementById('get-started-button');
get_started_button.addEventListener('click',()=>{
    get_started_button.classList.add('started');
    form_section.innerHTML=`<form>
    <p>Register User</p>
        <input type="text" placeholder="Username" required>
        <input type="password" placeholder="Password" required>
        <button type="submit">Create Account</button>
        <p>Already a user?<span><a href="#"> login</a></span><p>
    </form>`;
    form_section.classList.add("myform");
    
});

// const menuButton=document.querySelector('.js-hamburger-menu-div');
// menuButton.addEventListener('click',()=>{
// // menuButton.classList.toggle('menu-toggle');

// });
document.getElementById("menu").addEventListener('click',()=>{
    OnMenuClick();
});

function OnMenuClick()
{
    document.getElementById("menu").classList.toggle("icon");
    document.getElementById("nav").classList.toggle("change");

}

