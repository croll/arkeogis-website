import Swiper from "swiper";
import "../node_modules/swiper/swiper.scss";

export default function newsSlider(selector) {
  const swiper = new Swiper(selector, {
    initialSlide: 1,
    // slidesPerGroup: 3,
    centeredSlides: true,
    spaceBetween: 32,
    slidesPerView: 'auto', 
  });
  return swiper;
}