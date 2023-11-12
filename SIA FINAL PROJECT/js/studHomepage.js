        // ----------- DROPDOWN NAVIGATION JS ------------
        const toggleBtn = document.querySelector('.toggle-btn')
        const toggleBtnIcon = document.querySelector('.toggle-btn i')
        const dropDownMenu = document.querySelector('.dropdown_menu')

        toggleBtn.onclick = function() {
          dropDownMenu.classList.toggle('open')
          const isOpen = dropDownMenu.classList.contains('open')

          toggleBtnIcon.classList = isOpen
          ? 'fa-solid fa-xmark'
          : 'fa-solid fa-bars'
        }

      // ----------- ANNOUNCEMENT BANNER SLIDESHOW JS ------------

        let slideIndex = 0;
        showSlides();

        function showSlides() {
          let i;
          let slides = document.getElementsByClassName("mySlides");
          let dots = document.getElementsByClassName("dot");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          slideIndex++;
          if (slideIndex > slides.length) {slideIndex = 1}    
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " active";
          setTimeout(showSlides, 5000); // Change image every 2 seconds
        }

        // ------ STICKY HEADER ----------

        window.onscroll = function() {myFunction()};

        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
          if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
          } else {
            header.classList.remove("sticky");
          }
        }
       // ----------- TRANSITION DATA AOS JS ------------
                AOS.init({
                duration : 1200,
              })

      // ----------- SWIPER VIOLATION AREA JS ------------
      var swiper = new Swiper(".mySwiper", {
      cssMode: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
      },
      mousewheel: true,
      keyboard: true,
    });

     // ----------- Popup Date ------------
      // Function to get today's date in the format "YYYY-MM-DD"
        function getCurrentDate() {
          const today = new Date();
          const year = today.getFullYear();
          const month = String(today.getMonth() + 1).padStart(2, '0');
          const day = String(today.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

      // Set the value of the generateId input field to today's date
      document.addEventListener('DOMContentLoaded', function () {
        const generateIdInput = document.getElementById('generateId');
        if (generateIdInput) {
            generateIdInput.value = getCurrentDate();
        }
      });