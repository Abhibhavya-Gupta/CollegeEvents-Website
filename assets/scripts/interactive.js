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

document.getElementById("menu").addEventListener('click',()=>{
    OnMenuClick();
});

function OnMenuClick()
{
    document.getElementById("menu").classList.toggle("icon");
    document.getElementById("nav").classList.toggle("change");
}

