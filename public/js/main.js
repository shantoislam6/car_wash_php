
/*
   custom js
*/

(function () {

   // Page Preloader handler
   window.addEventListener('load', () => {
      document.body.style.overflow = 'initial';
      var p = document.getElementById('page-preloader');
      p.classList.add('animate__animated', 'animate__fadeOut', 'animate__faster');
      setTimeout(() => { p.style.display = 'none' }, 400);
   });

   //  password show hide toggle
   document.querySelectorAll('.show_hide_password > a').forEach((el) => {
      el.addEventListener('click', (e) => {
         e.preventDefault();
         const pass_container = el.parentElement.parentElement.querySelector('input');
         const eye = el.firstElementChild;

         if (eye.classList.contains('fa-eye-slash')) {
            pass_container.setAttribute("type", "text");
            eye.classList.remove('fa-eye-slash');
            eye.classList.add('fa-eye');
         } else {
            pass_container.setAttribute("type", "password");
            eye.classList.remove('fa-eye');
            eye.classList.add('fa-eye-slash');
         }
      });
   });



   // check img is validation or not
   Image.validate = function (file, maxSize) {
      return new Promise(function (resolve, reject) {
         if (file != undefined) {
            const imgUrl = URL.createObjectURL(file);
            if (file.type == "image/jpeg" || file.type == "image/png") {
               if (file.size < maxSize) {
                  var image = new Image();
                  image.onload = function () {
                     resolve(imgUrl);
                  };
                  image.onerror = function () {
                     reject("Invalid Image!");
                  }
                  image.src = imgUrl;
               } else {
                  reject("Image size must be < "+ maxSize / 1000 +" kb, please check the requirements!");
               }
            } else {
               reject("Not a valid image type, please check the requirements!");
            }
         } else {
            reject("Please choose a image!");
         }

      })
   }


   // invalid_animation
   function avater_invalid_animation(err) {
      $('#validationServer03Feedback').css({
         display: 'block',
      });
      $('#validationServer03Feedback > span').text(err);
      $('#validationServer03Feedback').addClass('animate__animated animate__shakeX animate__faster');
      setTimeout(() => {
         $('#validationServer03Feedback').removeClass('animate__animated animate__shakeX animate__faster');
      }, 200)
   }

   // avatar upload handler
   $('#avater-file').on('change', (e) => {
      const file = e.target.files[0];
      Image.validate(file, e.target.dataset.maxsize).then((img) => {
         $('#avater-container-img').css({
            'background-image': 'url("' + img + '")'
         });
         $('#avater-container-img > img').attr('src', img);
         $('#validationServer03Feedback > span').text('');

      }).catch(err => {
         avater_invalid_animation(err);
      })

   });



   // 'Avater' validation from client
   $('#avater-upload-form').on('submit', (e) => {
      e.preventDefault();
      const fileInput = document.getElementById("avater-file");
      console.log(fileInput.dataset)
      Image.validate(fileInput.files[0], fileInput.dataset.maxsize).then((img) => {
         $('#validationServer03Feedback > span').text('');
         e.target.submit();
      }).catch(err => {
         avater_invalid_animation(err);
      })

   })


}());

