export function createQuiz() {

    const quizForm = document.querySelector("#create-quiz");

    const addQuestion = document.querySelector(".add-question");  
    const addAnswer = document.querySelector(".add-answer");
    //create anotber question on click on button "add question"
    console.log(addQuestion);
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

            //add onclick event to add answer button 
            const addAnswer = question.querySelector(".add-answer");
            addAnswer.addEventListener("click",(e)=> cloneAnswer(e.target));


            questions.appendChild(question);
            questionNumber++;
            
            const questionCount = document.querySelector("#question-count");
            questionCount.value = questionNumber;

        });

    addAnswer.addEventListener("click",(e)=> cloneAnswer(e.target));

    function cloneAnswer(obj){

        console.log(obj);
        const parent = obj.parentNode;
        const answers = parent.querySelector(".answers");
        const answer = parent.querySelector(".answer").cloneNode(true);

        answers.appendChild(answer);
  
    }
}