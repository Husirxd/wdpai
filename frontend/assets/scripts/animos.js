export class AnimOS {

    constructor(options = {}){
        this.optionsList = options;
        this.startObserver(this.optionsList);
    }

    loadObjects(AnimosObserver){
        const animatedObjects = document.querySelectorAll("[data-anim]");
        animatedObjects.forEach((el)=>{
            AnimosObserver.observe(el);
            let gridChildren = el.children;
            if(!/Grid/.test(el.dataset.anim)){

                el.style.animationDelay = (el.dataset.animDelay || this.optionsList.delay || "300") + "ms";
                el.style.animationDuration = (el.dataset.animDuration || this.optionsList.duration || "500") + "ms";
            }else{
                for (let i = 0; i < gridChildren.length; i++) {
                    let delay = (i * el.dataset.animStep) + 1;
                    if(el.dataset.animDelay){
                        delay += el.dataset.animDelay * 1;
                    }
                    gridChildren[i].style.animationDelay = (delay || this.optionsList.delay || "300") + "ms";
                    gridChildren[i].style.animationDuration = (el.dataset.animDuration || this.optionsList.duration || "500") + "ms";
                }
            }
        })
    }
    startObserver(options){
        let observerOptions = {
            threshold:  this.optionsList.tresholds || [0,0.5,1],
            rootMargin: this.optionsList.rootMargin || "20%",
        }
        const AnimosObserver = new IntersectionObserver(entries =>{
            entries.forEach((entry)=>{
                if (entry.isIntersecting) {
                    entry.target.classList.add("animate");
                }else if(options.infinite == true){
                    entry.target.classList.remove("animate");
                }
            })
        },observerOptions)

        this.loadObjects(AnimosObserver);
    }
}

