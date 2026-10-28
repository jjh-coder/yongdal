    </div><!-- /.ydk-admin-container -->
  </div><!-- /.ydk-admin-main-wrap -->

  <footer class="ydk-admin-footer">
    <div class="ydk-admin-container">
      &copy; <?= date('Y') ?> <?= SITE_NAME ?> 관리자 시스템. All rights reserved.
    </div>
  </footer>

  <!-- jQuery 3.7.1 & Fomantic-UI JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.4/dist/semantic.min.js"></script>
  <script>
    $(document).ready(function() {
      if ($.fn.dropdown) {
        $('.ui.dropdown').dropdown();
      }
    });
  </script>
</body>
</html>
