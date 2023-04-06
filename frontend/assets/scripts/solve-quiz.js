export function solveQuiz() {

    //add to .answer onclick event
    const answers = document.querySelectorAll(".answer");
    answers.forEach((answer) => {
        answer.addEventListener("click", (e) => {
            const answerId = e.target.dataset.id;
      

            const chosen = e.target.parentNode.querySelector(".chosen");
            chosen.value = answerId;
        });
    });
}