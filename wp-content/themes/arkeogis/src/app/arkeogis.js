import gsap from "gsap";

export default class arkeogis {
  static initMobileMenu() {
    let menuVisible = false;
    const logo = document.querySelector("#masthead .logo");
    const burger = document.querySelector(".burger-icon");
    const lines = burger.querySelectorAll(".burger-lines path");
    const tl = gsap.timeline({
      paused: true,
      defaults: { duration: 0.3, transformOrigin: "center" },
    });
    tl.to(lines[0], { y: 8 });
    tl.to(lines[2], { y: -8 }, "<");
    tl.set(lines[1], { opacity: 0 });
    tl.to(lines[0], { rotation: 45 });
    tl.to(lines[2], { rotation: -45 }, "<");
    tl.to("#site-navigation", { x: 0 }, 0);
    tl.to(".language-switcher", { display: "block", autoAlpha: 1 }, 0.1);
    burger.addEventListener("click", () => {
      if (menuVisible) {
        tl.reverse();
        gsap.set(logo, { position: "absolute" });
        gsap.set(burger, { position: "absolute"});
      } else {
        gsap.set(logo, { position: "fixed" });
        gsap.set(burger, { position: "fixed"});
        tl.play();
      }
      menuVisible = !menuVisible;
    });
  }
}
