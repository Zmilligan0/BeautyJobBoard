function randomImage(){
    // array of images that are stored in the new banner folder
    var images = [
     'static/img/banner/0.webp',
     'static/img/banner/1.webp',
     'static/img/banner/2.webp',
     'static/img/banner/3.webp',
     'static/img/banner/4.webp',
     'static/img/banner/5.webp',
     'static/img/banner/6.webp',
     'static/img/banner/7.webp',
     'static/img/banner/8.webp',
     'static/img/banner/9.webp',
     'static/img/banner/10.webp'
    ];
    var size = images.length;
    var x = Math.floor(size * Math.random());
    console.log(x); // shows randomly generated number that will be passed on to line 20
    console.log(images); // shows the array of images to verify if the images are stored in that array
    var element = document.getElementsByClassName("bg-image");
    element[0].style["background-image"] = "url("+ images[x] + ")";
  }
  
  document.addEventListener("DOMContentLoaded", randomImage);