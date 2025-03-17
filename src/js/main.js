const openBtn = document.getElementById("tweetBtn");
const closeBtn = document.getElementById("close_modal");
const modal = document.getElementById("modal");

openBtn.addEventListener("click", () => {
    modal.classList.add("open");
});

closeBtn.addEventListener("click", () => {
    modal.classList.remove("open");
});