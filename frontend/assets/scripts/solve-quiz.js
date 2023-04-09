export function solveQuiz() {

    //add to .answer onclick event
    const answers = document.querySelectorAll(".answer");
    answers.forEach((answer) => {
        answer.addEventListener("click", (e) => {
            const answerId = e.target.dataset.id;
            const chosen = e.target.parentNode.querySelector(".chosen");
            const thisAnswers = e.target.parentNode.querySelectorAll(".answer");
            chosen.value = answerId;
            
            thisAnswers.forEach((answer) => {
                answer.classList.remove("answer--active");
            });
            e.target.classList.add("answer--active");

        });
    });
}