
const CreateQuiz = () => {

    if(document.querySelector("#create-quiz")) {
   
        import("./create-quiz.js").then((module) => {
            module.createQuiz();
        });
    }
}


CreateQuiz();