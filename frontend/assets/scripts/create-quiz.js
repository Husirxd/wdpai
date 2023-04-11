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

            const questionInput = question.querySelector(".question__question");
            questionInput.name = `question-${questionNumber}`;

            const imageInput = question.querySelector(".question__image");
            imageInput.name = `image_url-${questionNumber}`;

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

            document.querySelectorAll(".question__image").forEach((image) => {
                image.addEventListener("change", (image) => setQuestionThumbnail(image));
            });

            document.querySelectorAll(".remove-answer").forEach((a) => {
                a.addEventListener("click", (a) => deleteAnswer(a));
            });
        });

    addAnswer.addEventListener("click",(e)=> cloneAnswer(e.target));
    
    setAnswerButtons.forEach((a) => {
        a.addEventListener("click",() => setAnswer(a));
    });

    document.querySelectorAll(".question__image").forEach((image) => {
        image.addEventListener("change", (image) => setQuestionThumbnail(image));
    });

    document.querySelectorAll(".remove-answer").forEach((a) => {
        a.addEventListener("click", (a) => deleteAnswer(a));
    });

    const thumbnail = document.querySelector("#thumbnail");
    const thumbnailPreview = document.querySelector(".thumbnail-preview");
    thumbnail.addEventListener("change", (e) => {
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.onload = () => {
            thumbnailPreview.src = reader.result;
        }
        reader.readAsDataURL(file);
    });

}   

function setQuestionThumbnail(e) {
    console.log(e);
    const file = e.target.files[0];
    const reader = new FileReader();
    const thumbnailPreview = e.target.parentNode.querySelector(".thumbnail-preview");
    reader.onload = () => {
        thumbnailPreview.src = reader.result;
    }
    reader.readAsDataURL(file);
}

function setAnswer(e) {
    const parent = e.parentNode;
    const index = Array.prototype.indexOf.call(parent.parentNode.children, parent);

    const correctInput = parent.closest(".question").querySelector(".question__correct");
    correctInput.value = index;

    const answers = parent.parentNode.querySelectorAll(".answer-container");
    answers.forEach((a) => {
        a.classList.remove("answer-container--correct");
    });
    e.parentNode.classList.add("answer-container--correct");

}

function cloneAnswer(obj){

        const parent = obj.parentNode;
        const answers = parent.querySelector(".answers");
        const answer = parent.querySelector(".answer-container").cloneNode(true);
        const removeAnswer = "<span class='remove-answer'>×</span>";
        answer.insertAdjacentHTML("beforeend", removeAnswer);
        answers.appendChild(answer);



    const setAnswerButtons = parent.querySelectorAll(".set-correct");
        setAnswerButtons.forEach((a) => {
            a.addEventListener("click",() => setAnswer(a));
        });

        document.querySelectorAll(".remove-answer").forEach((a) => {
            a.addEventListener("click", (a) => deleteAnswer(a));
        });

    }

function deleteAnswer(obj){
    const parent = obj.target.parentNode;
    parent.remove();
}
