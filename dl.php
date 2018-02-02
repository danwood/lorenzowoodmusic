
<?php
// We could show an initial warning that downloads from iOS don't go into the library directly?
$iOSDevice = false;       // or set to a non-false text value
if (preg_match("/(\\(iPod|\\(iPhone|\\(iPad)/", $_SERVER['HTTP_USER_AGENT'], $matches)) {
   $iOSDevice = substr($matches[1], 1);
}
$code = isset($_GET['code']) ? htmlspecialchars($_GET['code']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
?><!DOCTYPE html>
<html class="no-js" lang="en-us">
  <head>
    <meta charset="utf-8"><!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge'><![endif]-->
    <title>Lorenzo Wood Music — Official Site</title>
    <meta name="description" content="Lorenzo Wood is a young musician from Alameda, California USA. He sings, plays guitar, drums, keyboards, etc. He also writes and produces original songs.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <link rel="apple-touch-icon" href="icon.png">
    <link rel="stylesheet" href="css/main.css">
    <link rel="prefetch" href="//code.jquery.com">
    <link rel="prefetch" href="//w.soundcloud.com">
    <link rel="prefetch" href="//www.youtube.com">
    <link rel="prefetch" href="//widget.bandsintown.com">
  </head>
  <body>
    <!-- jquery already loaded-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <div>
      <aside class="redeem">
        <form id="redeem-form">
          <input id="redeem-input" type="text" name="code" placeholder="Download Code" pattern="[A-Za-z0-9- ]+{6,12}$" value="<?php echo htmlspecialchars($code); ?>">
          <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
          <input id="redeem-submit" type="submit" name="go" value="Submit Download Code" disabled="disabled">
        </form><?php
        if ($iOSDevice) {
        ?>
        <div class="warning">Music tracks can be played but not downloaded on the <?php echo htmlspecialchars($iOSDevice); ?>.</div><?php
        }
        ?>
      </aside>
    </div>
    <!-- just before scripts-->
    <div id="cover" style="display:none;"></div>
    <div id="redeemer" style="display:none;"></div>
    <div id="close-redeem" style="display:none;">&#215;</div>
    <script>
      $('#redeem-form').submit(function( event ) {
          $('#redeem-submit').prop( "disabled", true );
          $.ajax({
            type: 'POST',
            url: '/redeem.php',
            data: $("#redeem-form").serialize(),
      
            success: function(data, textStatus, jqXHR ) {
                  if (data != '') {
                      $('#cover').show();
                      $('#redeemer').show();
                      $('#close-redeem').show();
                      $('#redeemer').html(data);  // We’re done; let the content here do the rest.
                  } else {
                      alert('Sorry, but the code you entered has already been redeemed or was entered incorrectly.');
                      $('#redeem-input').focus();
                  }
            },
            error: function(jqXHR, textStatus, errorThrown ) {
                  alert(errorThrown + ' ' + textStatus);
            },
            complete: function(jqXHR, textStatus ) {
                  $('#redeem-submit').prop( "disabled", false );
            }
          });
          event.preventDefault();
      });
      $('#close-redeem').click(function() {
          $('#cover').fadeOut('slow');
          $('#close-redeem').fadeOut('slow');
          $('#redeemer').fadeOut('fast');
      });
      
      $('#redeem-input').on('change keyup paste', function () {
          var disabled = $(this).val() == '';
         $('#redeem-submit').prop( "disabled", disabled);
      });
      
      
      // Automatically submit when code provided in the URL
      <?php
      if ($code) {
      ?>
      $('#redeem-form').submit();
      <?php
      }
      ?>
      
    </script>
    <script src="https://cdn.jsdelivr.net/npm/amplitudejs@3.2.3/dist/amplitude.js"></script><?php error_log("Should include minimized amplitudejs"); ?>
  </body>
</html>