const CreateQuiz = () => {
    if(document.querySelector("#create-quiz")) {
        import("./create-quiz.js").then((module) => {
            module.createQuiz();
        });
    }
}
CreateQuiz();

const SolveQuiz = () => {
        if(document.querySelector("#solve-quiz")) {
            import("./solve-quiz.js").then((module) => {
                module.solveQuiz();
            });
        }
    }
SolveQuiz();

//check if .button-gradient exists
const KoxCzycisk = () => {
    if(document.querySelector(".button-gradient")) {
        console.log('kox');
        import("./kox-czycisk.js").then((module) => {
            module.koxCzycisk();
        });
    }
}
KoxCzycisk();

document.querySelector(".header__hamburger").addEventListener("click", (e) => {
    document.querySelector(".mobile-menu").classList.toggle("mobile-menu--active");
});

const startAnimations = () => {
    if(document.querySelector("[data-anim]")) {
        import("./animos.js").then((module) => {
            let animos = new module.AnimOS({
                infinite: false,
                rootMargin: "10%"
            });
        });
    }
}
startAnimations();

const archiveQuiz = () => {
    if(document.querySelector("#archive-quiz")) {
        import("./archive-quiz.js").then((module) => {
            module.archiveQuiz();
        });
    }
}
archiveQuiz();


const handleNewsletter = () => {
        let data = {};

        document.querySelector("#newsletter-submit").addEventListener("click", (e) => {
            e.preventDefault();
        
            sendEmail();
        });
    
    
        function sendEmail(){
            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "/ajax_newsletter", true);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelector(".newsletter-form").classList.add("newsletter-form--hidden");
                    document.querySelector(".newsletter-thanks").classList.add("newsletter-thanks--visible");
                }
            }
            xhttp.setRequestHeader("Content-type", "application/json");
            data.action = 'subscribe';
            data.email = document.querySelector("#newsletter-email").value;
            xhttp.send(JSON.stringify(data));
        }
    }
handleNewsletter();