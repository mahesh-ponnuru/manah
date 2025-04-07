<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
extract($_POST);
$ip = $_SERVER['REMOTE_ADDR'];
date_default_timezone_set("Asia/Kolkata");
$date=date("F j, Y, g:i a");
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$subject = "New contact details posted @ abc.com";
$toemail = "venkat.ch@manah.com";

$bdymsg = "<table width=730 border=0 align=center cellpadding=0 cellspacing=0 class=border_temp>\n
      <tr>
        <td align=left valign=top><table width=730 border=0 cellspacing=0 cellpadding=0>
          
          <tr>
            <td align=center valign=top>\n
        <table width=93% border=0 cellspacing=1 cellpadding=7>
              <tr>
                <td colspan=2 align=left valign=middle bgcolor=#F0F0F0><font face=Arial font-weight: bold size=5px style=color:#000 text-decoration:none><strong>$fname 
    Contact Details</strong></font></td>
                </tr>\n
                    
              <tr>
                <td width=23% align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none>Contact Name</font></td>
                <td width=77% align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none><strong>

    $fname</strong></font></td>
              </tr>

              <tr>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none>Email ID </font></td>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none=text-decoration:none><strong>

    $email</strong></font></td>
              </tr>
                     
              <tr>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none>Subject </font></td>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none=text-decoration:none><strong>
    $sbj</strong></font></td>
              </tr>

              <tr>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none>Company </font></td>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none=text-decoration:none><strong>
    $company</strong></font></td>
              </tr>

              <tr>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none>Website </font></td>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none=text-decoration:none><strong>
    $website</strong></font></td>
              </tr>
            
              <tr>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none>Query </font></td>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none=text-decoration:none><strong>
    $query</strong></font></td>
              </tr>

              <tr>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none>Message</font></td>
                <td align=left valign=middle bgcolor=#E3E3E3><font face=Arial size=2px style=color:#000 text-decoration:none><strong>$msg</strong></font></td>
              </tr>
              <tr><td colspan=2 align=left valign=middle bgcolor=#F0F0F0><font face=Arial size=2px style=color:#000><strong>*** This message has been sent from abc.com ***</strong></font></td></tr>
         
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
      </tr>
    </table>\n";

$header = "From:  ".  $email . " <no-reply@abc.com>";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

$retval = mail ($toemail,$subject,$bdymsg, $header);
if ($retval == true) {
    ?>
    <!-- <script type="text/javascript">
        alert("Your message has been sent successfully!");
        window.location.href = 'tq.php';
    </script> -->
    <script type="text/javascript">
        // Open tq.php in a popup window
        let popup = window.open("tq.php", "ThankYouPopup", "width=400,height=200");
        
        // After 3 seconds, close the popup and redirect to contact page
        setTimeout(function() {
            if (popup) {
                popup.close();
            }
            window.location.href = 'contactus.php';
        }, 3000);
    </script>
    <?php
} else {
    ?>
    <script type="text/javascript">
        alert("Failed to send your message. Please try again.");
        window.location.href = 'contactus.php?msg=fail';
    </script>
    <?php
}
?>




