<style>
    footer{
        background-color: var(--main-color) !important;
    margin-top: 40px !important;
    height: 120px !important;
    }
    footer i{
        font-size: 22px;
        transition: all 0.3s ease-in-out;
    }
    footer a:hover i{
        transform: scale(1.3);
        color: var(--form-label-color);
    }
</style>
<script>
    <?php
    if (!isset($_SESSION["username"])) {
        ?>
        const  login = document.querySelector('.login');
        login.addEventListener('click',() => {
    form.classList.toggle('active');
});
        window.addEventListener('click',(e) => {
        if (e.target!=form &&e.target!= login&& e.target.parentNode.parentNode!= form 
        && e.target.parentNode!=form) {
        form.classList.remove('active');
    }
})
        <?php
    }
    ?>
    
</script>
<footer class="text-center text-white" style="background-color: #f1f1f1;">
  <div class="container pt-4">
    <div class="mb-4">
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-twitter"></i
      ></a>
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-google"></i
      ></a>
            <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-instagram"></i
      ></a>
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-linkedin"></i
      ></a>
      <a
        class="btn btn-link btn-floating btn-lg text-dark m-1"
        href="#!"
        role="button"
        data-mdb-ripple-color="dark"
        ><i class="fab fa-github"></i
      ></a>
    </div>
  </div>
  <div class="text-center text-dark p-3" style="  
        background-color: var(--main-color);
    margin-top: 36px;
    border-top: 1px solid var(--black);
    color: var(--black) !important;">
    © 2020 Copyright:
    <a style="color: var(--black) !important;" class="text-dark" 
    href="#">ratebbarakat.com</a>
  </div>
</footer>
