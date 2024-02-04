import { gsap, Expo } from "gsap";

import { ExpoScaleEase } from "gsap/EasePack";

import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger, ExpoScaleEase);
const body = document.querySelector("body");
const bloc = document.querySelector(".overlay");
const animaText = document.querySelectorAll(".animation-text");
const logoHeader = document.querySelector(".logo-header");
const hoverText = document.querySelectorAll(".hover-text");
const nameMain = document.querySelector(".name-main");
const descriptionName = document.querySelector(".description-name");
const btnReadMore = document.querySelector(".btn-read-more");
// const imageContainer = document.querySelector(".imageContainer");
// const bannerImage = document.querySelector(".img-animation");

window.addEventListener("load", animationHome);
function animationHome() {
  gsap.utils.toArray(".reveal").forEach((container) => {
    let image = container.querySelector("img");

    let TLFADE = gsap.timeline();

    TLFADE.to(animaText, {
      duration: 1.2,
      opacity: 1,
      stagger: 0.5,
    });
    TLFADE.to(bloc, {
      duration: 1.5,
      right: "-100%",
      ease: Expo.easeInOut,
    });
    TLFADE.to(bloc, {
      opacity: 0,
    });
    TLFADE.to(bloc, {
      display: "none",
    });
    TLFADE.from(
      logoHeader,
      {
        autoAlpha: 0,
        y: -50,
      },
      "=-2"
    );
    TLFADE.from(
      hoverText,
      {
        autoAlpha: 0,
        y: -50,
        stagger: 0.4,
      },
      "=-1.5"
    );

    TLFADE.from(nameMain, {
      autoAlpha: 0,
      x: -50,
    });
    TLFADE.from(descriptionName, {
      autoAlpha: 0,
      x: -50,
    });
    TLFADE.from(btnReadMore, {
      autoAlpha: 0,
      x: -50,
    });
    TLFADE.set(container, { autoAlpha: 1 });
    TLFADE.from(
      container,
      {
        duration: 4,
        yPercent: 0,
        skewX: 0.1,
        ease: "expo",
      },
      "=-2.5"
    );
    TLFADE.from(
      image,
      {
        duration: 4,
        yPercent: 600,
        skewX: 0.1,
        ease: "expo",
      },
      "=-2.5"
    );
    TLFADE.to(body, { overflow: "auto" });
  });
}
