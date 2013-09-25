<?php
function footer(){
    echo '<script>
  document.write("<script src=" +
  ("__proto__" in {} ? "js/vendor/zepto" : "js/vendor/jquery") +
  ".js><\/script>")</script>
<script src="/js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
</body>
</html>';
}
?>
