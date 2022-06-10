window.addEventListener(
  "scroll",
  () => {
    let scroll = scrollY;
    let heroImg = document.getElementById('hero-img');
    heroImg.style.width = 100 + scroll / 5 + "%";
    heroImg.style.top = -(scroll / 10) + "%";
  },
  { passive: true }
);

let typewrite = document.querySelector('.typewrite');
let wordSpan = document.querySelector(".word");

const words = JSON.parse(typewrite.getAttribute('data-type'));
const period = typewrite.getAttribute('data-period');
let wordDisplayed = "";
let alternate = false;
let i = 0;

let typewriter = () => {
  let currentWord = words[i];

  if (alternate) {
    wordDisplayed = currentWord.substring(0, wordDisplayed.length - 1);
  } else {
    wordDisplayed = currentWord.substring(0, wordDisplayed.length + 1);
  }

  wordSpan.innerText = wordDisplayed;

  let delay = 300 - Math.random() * 100;

  if (alternate) { delay /= 2; }

  if (!alternate && wordDisplayed === currentWord) {
    delay = period;
    alternate = true;
  } else if (alternate && wordDisplayed === "") {
    alternate = false;
    delay = 500;
    i = (i + 1) % words.length;
  }

  setTimeout(typewriter, delay);
};

typewriter();