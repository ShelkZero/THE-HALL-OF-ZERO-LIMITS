<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Loading + Video Background</title>

<style>
:root {
  --dark-green: #2ab14c;
  --light-green: #7eff99;
  --highlight-green: rgba(42,177,76,0.6);
  --highlight-bright: rgba(42,177,76,1);
}

* { margin: 0; padding: 0; box-sizing: border-box; }
html, body { width: 100%; height: 100%; background: #000; font-family: "Times New Roman", Georgia, serif; overflow: hidden; }

/* ================= LOADER ================= */
#loader-container {
  position: fixed; inset: 0;
  background: url('image/LoadBK.png') center / 120% no-repeat;
  display: flex; justify-content: center; align-items: center;
  z-index: 15;
}

.loader { text-align: center; }

.top-sprites {
  display: flex; justify-content: center; align-items: center; gap: 25px; margin-bottom: 25px;
}

.sprite-img, .wak-img { width: 150px; opacity: 0; }
.x-img { width: 40px; opacity: 0; }

.loader-image {
  width: 380px; margin-bottom: 20px;
  filter: drop-shadow(0 0 5px var(--dark-green)) drop-shadow(0 0 12px var(--dark-green));
  opacity: 0; transform: translateY(50px);
}

.progress { width: 380px; height: 6px; background: rgba(255,255,255,0.05); border-radius: 2px; overflow: hidden; margin: 0 auto; opacity: 0; }
.progress-bar { width: 0%; height: 100%; background: var(--light-green); box-shadow: 0 0 5px var(--light-green), 0 0 15px var(--light-green); }

/* ================= VIDEO BACKGROUND ================= */
#video-container { position: fixed; inset: 0; z-index: 0; }
#video-container video { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }

/* ================= STATIC VISUAL ================= */
#visual-container {
  position: fixed; inset: 0; z-index: 5;
  display: flex; justify-content: center; align-items: center; flex-direction: column;
  pointer-events: none; text-align: center; opacity: 0; transition: opacity 1s ease;
}

.text-img { width: 760px; max-width: 95vw; opacity: 0; transform: translateY(50px);
  filter: drop-shadow(0 0 10px rgba(42,177,76,1)) drop-shadow(0 0 22px rgba(42,177,76,0.8)); margin-bottom: 15px; }

.quote-wrapper { position: relative; display: inline-block; margin-bottom: 25px; padding: 0 20px; }
.quote-highlight { position: absolute; top: 50%; left: 0; transform: translateY(-50%);
  width: 100%; height: 100%; background: linear-gradient(to right, rgba(42,177,76,0), var(--highlight-green), rgba(42,177,76,0)); z-index: 0; border-radius: 4px; opacity: 0; }
.quote { position: relative; color: #fff; font-size: 22px; font-weight: bold; line-height: 1.2; text-align: center;
  text-shadow: 0 0 6px rgba(0,0,0,0.5); max-width: 90vw; opacity: 0; transform: translateY(20px); z-index: 1; padding: 0 10px; }

.enter-button { margin-top: 20px; padding: 12px 40px; font-size: 20px; font-weight: bold; color: #fff;
  background: transparent; border: 2px solid #fff; border-radius: 6px; cursor: pointer; pointer-events: auto;
  opacity: 0; box-shadow: 0 0 20px var(--highlight-green); transition: all 0.3s ease; position: relative; }
.enter-button::after { content: ""; position: absolute; top: 100%; left: 50%; transform: translateX(-50%);
  width: 80%; height: 8px; background: var(--highlight-green); filter: blur(12px); opacity: 0.8; border-radius: 3px; transition: all 0.3s ease; }
.enter-button:hover { box-shadow: 0 0 35px var(--highlight-bright); }
.enter-button:hover::after { height: 12px; opacity: 1; }

/* ================= TABLE ================= */
#bottom-right-table { position: fixed; bottom: 20px; right: 20px; border-collapse: collapse; z-index: 10; pointer-events: auto; background: rgba(0,0,0,0.3); }
#bottom-right-table td { border: 1px solid rgba(255,255,255,0.5); padding: 8px 12px; color: #fff; text-align: center; vertical-align: middle; font-size: 20px; }

/* ================= ACCESSIBLE BUTTON ================= */
#accessible-btn { position: fixed; top: 20px; right: 20px; z-index: 20; padding: 10px 20px; font-size: 16px; font-weight: bold;
  color: #fff; background: rgba(0,0,0,0.5); border: 2px solid #fff; border-radius: 6px; cursor: pointer; transition: all 0.3s ease; pointer-events: auto; }
#accessible-btn:hover { background: rgba(0,0,0,0.8); box-shadow: 0 0 15px #2ab14c; }

/* ================= ANIMATIONS ================= */
@keyframes slide-left { from { transform: translateX(-60px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
@keyframes slide-right { from { transform: translateX(60px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
@keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
@keyframes slide-up { from { transform: translateY(50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

.animate-sprite { animation: slide-left 1s ease forwards; }
.animate-wak { animation: slide-right 1s ease forwards; }
.animate-x { animation: fade-in 1s ease forwards; }
.animate-loader { animation: slide-up 1s forwards; }
.animate-progress { animation: fade-in 1s forwards; }
.animate-text { animation: slide-up 1s ease forwards; }
.animate-quote { animation: slide-up 1.2s ease forwards; }
.animate-highlight { animation: fade-in 1.5s ease forwards; }
.animate-button { animation: fade-in 2s ease forwards; }
</style>
</head>

<body>

<!-- LOADER -->
<div id="loader-container">
  <div class="loader">
    <div class="top-sprites">
      <img src="image/Sprite.png" class="sprite-img">
      <img src="image/X.png" class="x-img">
      <img src="image/Wak.png" class="wak-img">
    </div>
    <img src="image/TextLoad1.png" class="loader-image">
    <div class="progress">
      <div class="progress-bar" id="bar"></div>
    </div>
  </div>
</div>

<!-- VIDEO BACKGROUND -->
<div id="video-container">
  <video id="video1" autoplay muted playsinline></video>
  <video id="video2" autoplay muted playsinline></video>
</div>

<!-- STATIC VISUAL -->
<div id="visual-container">
  <div class="top-sprites">
    <img src="image/Sprite.png" class="sprite-img">
    <img src="image/X.png" class="x-img">
    <img src="image/Wak.png" class="wak-img">
  </div>
  <img src="image/TextLoad1.png" class="text-img">
  <div class="quote-wrapper">
    <div class="quote-highlight"></div>
    <div class="quote">
      EXPLORE NEW PATHS.<br>
      FIND YOUR GIFTS
    </div>
  </div>
  <button class="enter-button">Enter</button>
</div>

<!-- TABLE AND BUTTON -->
<table id="bottom-right-table">
  <tr>
    <td><img src="image/Sprite.png" width="60" alt="Sprite"></td>
    <td><img src="image/Wak.png" width="60" alt="Wak"></td>
    <td>Sprite Zero Sugar (R) | (C) MARVEL</td>
  </tr>
</table>

<button id="accessible-btn">Accessible version</button>

<script>
/* ================= VIDEO LOGIC ================= */
const video1 = document.getElementById('video1');
const video2 = document.getElementById('video2');
const videos = ['image/AfterLoad1.mp4', 'image/AfterLoad2.mp4'];
let currentIndex = 0;
video1.src = videos[0]; video2.src = videos[1]; video1.play();
function switchVideo() {
  const top = video1.style.zIndex === '1' ? video2 : video1;
  const bottom = top === video1 ? video2 : video1;
  top.src = videos[(currentIndex + 1) % videos.length];
  top.currentTime = 0;
  top.play().then(() => { top.style.zIndex = 1; bottom.style.zIndex = 0; currentIndex = (currentIndex + 1) % videos.length; });
}
video1.addEventListener('ended', switchVideo);
video2.addEventListener('ended', switchVideo);

/* ================= LOADER PROGRESS ================= */
const bar = document.getElementById("bar");
const loader = document.getElementById("loader-container");
const sprite = document.querySelectorAll(".sprite-img")[0];
const wak = document.querySelectorAll(".wak-img")[0];
const loaderImage = document.querySelector(".loader-image");
const progress = document.querySelector(".progress");
const visual = document.getElementById("visual-container");

let value = 0;

window.onload = () => {
  sprite.classList.add("animate-sprite");
  wak.classList.add("animate-wak");
  loaderImage.classList.add("animate-loader");
  progress.classList.add("animate-progress");
};

const interval = setInterval(() => {
  value += Math.random() * 12;
  if (value >= 100) value = 100;
  bar.style.width = value + "%";

  if (value === 100) {
    clearInterval(interval);
    loader.style.transition = "transform .6s ease, opacity .3s";
    loader.style.transform = "translateY(-120%)";
    loader.style.opacity = "0";

    setTimeout(() => {
      loader.remove();
      visual.style.opacity = "1"; // показываем видео и спрайты

      // Анимации спрайтов и текста после загрузки
      document.querySelectorAll("#visual-container .sprite-img")[0].classList.add("animate-sprite");
      document.querySelectorAll("#visual-container .wak-img")[0].classList.add("animate-wak");
      document.querySelectorAll("#visual-container .x-img")[0].classList.add("animate-x");
      document.querySelector(".text-img").classList.add("animate-text");
      document.querySelector(".quote").classList.add("animate-quote");
      document.querySelector(".quote-highlight").classList.add("animate-highlight");
      document.querySelector(".enter-button").classList.add("animate-button");
    }, 600);
  }
}, 400);
</script>

</body>
</html>
