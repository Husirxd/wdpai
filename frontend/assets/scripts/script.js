
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