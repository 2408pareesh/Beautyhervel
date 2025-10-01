"use strict";

var slides = document.querySelectorAll(".slide");
var index = 0;

function showSlide(i) {
  slides.forEach(function (s, idx) {
    s.classList.remove("active");
    if (idx === i) s.classList.add("active");
  });
}

setInterval(function () {
  index = (index + 1) % slides.length;
  showSlide(index);
}, 4000);