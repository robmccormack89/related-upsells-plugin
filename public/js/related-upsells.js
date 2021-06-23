// related & upsells swipers
jQuery(function(){
  // related swiper
  var related_swiper = new Swiper('#slideshow_related', {
    slidesPerView: 1,
    spaceBetween: 0,
    // autoplay: {
    //   delay: 4000,
    //   disableOnInteraction: true,
    // },
    // init: false,
    pagination: {
      el: '.swiper-pagination',
      dynamicBullets: true,
    },
    // breakpoints: {
    //   960: {
    //     slidesPerView: 3,
    //     spaceBetween: 15,
    //   },
    //   1290: {
    //     slidesPerView: 4,
    //     spaceBetween: 20,
    //   },
    // }
  });
  // upsells swiper
  var upsells_swiper = new Swiper('#slideshow_upsells', {
    slidesPerView: 1,
    spaceBetween: 0,
    // autoplay: {
    //   delay: 4000,
    //   disableOnInteraction: true,
    // },
    // init: false,
    pagination: {
      el: '.swiper-pagination',
      dynamicBullets: true,
    },
    // breakpoints: {
    //   960: {
    //     slidesPerView: 3,
    //     spaceBetween: 15,
    //   },
    //   1290: {
    //     slidesPerView: 4,
    //     spaceBetween: 20,
    //   },
    // }
  });
});