// let cardIn = false;

card = document.getElementById('card');


// card.addEventListener("click", () => {
//     setTimeout(() => {
//         card.style.transform  =  cardIn ? "translate(1px,-5%) rotate(90deg)" : "translate(1px, -100%) rotate(90deg)";
//     }, 80);

//     setTimeout(() => {
//         upperSlot = document.getElementById('upperSlot');
//         lowerSlot = document.getElementById('lowerSlot');
//         if (cardIn) {
//             upperSlot.classList.remove("active")
//             lowerSlot.classList.remove("active")
//         }
//         else{
//             upperSlot.classList.add("active")
//             lowerSlot.classList.add("active")
//         }
//         cardIn = !cardIn;
//     }, 1057);
// })

window.addEventListener("load", () => {
    setTimeout(() => {
        // card.style.transform = "translate(1px, -127%)";
        card.style.transform = "translate(1px, -100vh)";
    }, 80);

    setTimeout(() => {
        upperSlot = document.getElementById('upperSlot');
        lowerSlot = document.getElementById('lowerSlot');
        upperSlot.classList.add("active")
        lowerSlot.classList.add("active")
        // cardIn = !cardIn;
    }, 1057);
})