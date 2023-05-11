export function solveQuiz() {

    //add to .answer onclick event
    const answers = document.querySelectorAll(".answer");
    answers.forEach((answer) => {
        answer.addEventListener("click", (e) => {
            const answerId = e.target.dataset.id;
            const chosen = e.target.parentNode.querySelector(".chosen");
            const thisAnswers = e.target.parentNode.querySelectorAll(".answer");
            
            
            //thisAnswers.forEach((answer) => {
            //    answer.classList.remove("answer--active");
            //});
            if(e.target.classList.contains("answer--active")){
                chosen.value = chosen.value.replace(answerId+",","");
                e.target.classList.remove("answer--active");
            }else{
                chosen.value += answerId+",";
                e.target.classList.add("answer--active");
            }

        });
    });
}