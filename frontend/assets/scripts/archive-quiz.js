export function archiveQuiz(){
    let offset = 0;
    let search = document.querySelector(".search");
    let data = {};
    let resetGrid = 0;
    document.querySelector(".load-more").addEventListener("click", (e) => {
        offset += 9;
        sendFilters();
    });
    document.querySelector("#search").addEventListener("change", (e) => {
        data.search = e.target.value;
        offset = 0;
        resetGrid = 1;
        sendFilters();
    });

    function sendFilters(){
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "/ajax_archive", true);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                if(resetGrid == 1){
                    document.querySelector(".quizzes").innerHTML = response['data'];
                    console.log(response['data']);
                    resetGrid = 0;
                }else{
                    document.querySelector(".quizzes").innerHTML += response['data'];
                }
            }
        }

        xhttp.setRequestHeader("Content-type", "application/json");
        data.action = 'loadMore';
        data.offset = offset;;
        xhttp.send(JSON.stringify(data));
    }


}