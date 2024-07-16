<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ERROR</title>
    <style>
      .disabled {
        pointer-events: none;
        opacity: 0.6;
      }
      @import url('https://fonts.googleapis.com/css?family=Ruda:400,700');
  #header, #outer-wrapper, #post-wrapper, #sidebar-wrapper, #content-wrapper, #footer-wrapper, #wrapper, .ignielToTop {display:none}
  body,html {overflow:hidden; margin:0; padding:0; width:100%; min-height:100vh}
  body {background:#fff; color:#1d2129}
  #igniel404 {background:#eceeee; text-align:center; margin:auto; font-weight:700; font-size:45px; font-family:'Ruda',sans-serif; position:fixed; width:100%; height:100%; line-height:1.25em; z-index:9999;}
  #igniel404 #error-text {position:relative; font-size:40px; color:#666; top:50%; right:50%; transform:translate(50%,-50%);}
  #igniel404 #error-text a {color:#888; text-decoration:none}
  #igniel404 #error-text p {margin:0!important; letter-spacing:.5px;}
  #igniel404 #error-text span {color:#008c5f;font-size:100px;}
  #igniel404 #error-text a.back {background:#008c5f;color:#fff;padding:10px 20px;font-size:20px;border:double #fff;-webkit-transform:scale(1);-moz-transform:scale(1);transform:scale(1);transition:all 0.5s ease-out;}
  #igniel404 #error-text a.back:hover {background:#444;color:#fff;border:double #eceeee;}
  #igniel404 #error-text a.back:active {-webkit-transform:scale(0.9);-moz-transform:scale(0.9);transform:scale(0.9);background:#333;color:#fff;border:double #eceeee;}
  #igniel404 #error-text #copyright {font-size:16px}
  #igniel404 #error-text #copyright a {color:#008c5f}

  @media only screen and (max-width:640px){
    #igniel404 #error-text {font-size:20px;}
    #igniel404 #error-text span {font-size:60px;}
    #igniel404 #error-text a.back {padding:5px 10px;font-size:15px;}
    #igniel404 #error-text a.back:hover, #igniel404 #error-text a.back:active {border:0;}
  }
    </style>
  </head>
  <body>
    <div id='igniel404'>
        <div id='error-text'>
          <span>¡Oops! Demasiados intentos.</span>
          <p>Inténtelo de nuevo en <span id="countdown">{{ $seconds }}</span> segundos.</p>
          <a id="retryButton" class="back disabled" href="{{ route('login') }}">Regresar</a>
        </div>
      </div>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var seconds = {{ $seconds }};
        var countdownElement = document.getElementById('countdown');
        var retryButton = document.getElementById('retryButton');

        var interval = setInterval(function() {
          seconds--;
          countdownElement.textContent = seconds;

          if (seconds <= 0) {
            clearInterval(interval);
            retryButton.classList.remove('disabled');
            retryButton.textContent = 'Regresar';
          }
        }, 1000);
      });
    </script>
  </body>
</html>
