import $ from 'jquery';
import { Carousel } from "bootstrap";

$(document).ready(function() {
  // Carousel
  $('.myCarousel').each(function() {
      let carousel = new Carousel(this, {
          interval: 2000,
          wrap: false
      });
  });
});
