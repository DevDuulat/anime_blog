<!-- Footer Section Begin -->
<footer class="footer">
  <div class="page-up">
    <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="footer__logo">
          <a href="./index.html" style="color: #fff; font-size: 24px; font-weight: 600">
            PlayMix
          </a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="footer__nav">
          <ul>
            <li class="active"><a href="{{ route('home') }}">Главаня</a></li>
            <li><a href="{{ route('posts.index') }}">Наш блог</a></li>
            <li><a href="{{ route('quiz') }}">Викторины</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3">
        <p>
          Copyright &copy;
          <script>
            document.write(new Date().getFullYear());
          </script>
        </p>
      </div>
    </div>
  </div>
</footer>
<!-- Footer Section End -->