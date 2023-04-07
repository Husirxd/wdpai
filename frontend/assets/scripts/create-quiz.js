export function createQuiz() {

    const quizForm = document.querySelector("#create-quiz");

    const addQuestion = document.querySelector(".add-question");  
    const addAnswer = document.querySelector(".add-answer");
    const setAnswerButtons = document.querySelectorAll(".set-correct");


    //create anotber question on click on button "add question"

    let questionNumber = 1;
    addQuestion.addEventListener("click", (e) => {

            const question = document.querySelector(".question").cloneNode(true);
            const questions = document.querySelector(".questions");
            const answers = question.querySelectorAll(".answer");
            answers.forEach((answer) => {
                answer.name = `answer-${questionNumber}[]`;
            });

            const questionInput = question.querySelector(".question");
            questionInput.name = `question-${questionNumber}`;

            const imageInput = question.querySelector(".question__image");
            imageInput.name = `image-${questionNumber}`;

            const poinsInput = question.querySelector(".question__points");
            poinsInput.name = `points-${questionNumber}`;

            const correctInput = question.querySelector(".question__correct");
            correctInput.name = `correct-${questionNumber}`;

            const setAnswerButtons = question.querySelectorAll(".set-correct");
            setAnswerButtons.forEach((answer) => {
                answer.addEventListener("click",() => setAnswer(answer));
            });
            const addAnswer = question.querySelector(".add-answer");
            addAnswer.addEventListener("click",(e)=> cloneAnswer(e.target));


            questions.appendChild(question);
            questionNumber++;
            
            const questionCount = document.querySelector("#question-count");
            questionCount.value = questionNumber;

        });

    addAnswer.addEventListener("click",(e)=> cloneAnswer(e.target));


    setAnswerButtons.forEach((a) => {
        console.log(a);
        a.addEventListener("click",() => setAnswer(a));
    });


}   

function setAnswer(e) {
    const parent = e.parentNode;
    const index = Array.prototype.indexOf.call(parent.parentNode.children, parent);

    const correctInput = parent.closest(".question").querySelector(".question__correct");
    correctInput.value = index;

}

function cloneAnswer(obj){

        console.log(obj);
        const parent = obj.parentNode;
        console.log(parent);
        const answers = parent.querySelector(".answers");
        const answer = parent.querySelector(".answer-container").cloneNode(true);

        answers.appendChild(answer);

    const setAnswerButtons = parent.querySelectorAll(".set-correct");
        setAnswerButtons.forEach((a) => {
            console.log(a);
            a.addEventListener("click",() => setAnswer(a));
        });
    }