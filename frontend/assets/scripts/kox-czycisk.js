
export function koxCzycisk(){

    let button = document.querySelector(".button-gradient");
    let circle = {};
    
    circle.sx = 50;
    circle.sy = 50;
    circle.r = 50;
    circle.angle = 0;  
    let x = 1;

    let bg = setInterval(moveBackground,250);
    button.addEventListener("mouseout",(e)=>{
        bg = setInterval(moveBackground,250);
    });

button.addEventListener("mousemove",(e)=>{
    clearInterval(bg);
    let rect = e.target.getBoundingClientRect();  
    let x = e.clientX - rect.left;
    let y = e.clientY - rect.top;
    let xPercent = (x / e.target.offsetWidth)*80;
    let yPercent = (y / e.target.offsetHeight)*80;
    button.style.backgroundPosition = `${xPercent}% ${yPercent}% `;
    })

    function moveBackground(){

        circle.angle = (circle.angle+0.1)%360;
        circle.x = circle.r*(Math.cos(circle.angle));
        circle.y = circle.r*(Math.sin(circle.angle));
        button.style.backgroundPosition = `${50+circle.x}% ${50+circle.y}% `;
        button.style.backgroundImage = `linear-gradient(${30+10*circle.angle}deg, #ff006eff 0%, #3a86ffff 100%)`
    }
}







