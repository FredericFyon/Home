<?php
if(isset($_POST["Submit"]))
{
    if($_POST["Name"]==""||$_POST["Email"]==""||$_POST["Message"]=="")
    {
        echo "Please fill all fields.";
    }
    else
    {
        $email=$_POST['Email'];
        $email =filter_var($email, FILTER_SANITIZE_EMAIL);
        $email= filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email)
        {
            echo "The e-mail address you entered does not appear to be valid";
        }
        else
        {
        $message = $_POST['Message'];
        $headers = 'From:'. $name . "rn"; // Sender's Email
        $headers .= 'Cc:'. $email2 . "rn"; // Carbon copy to Sender
// Message lines should not exceed 70 characters (PHP rule), so wrap it
        $message = wordwrap($message, 70);
        $subject = "E-mail from $name (website)"
// Send Mail By PHP Mail Function
        mail("frederic.fyon@gmail.com", $subject, $message, $headers);
        $mailsent= "Your mail has been sent successfully ! Thank you for your feedback";
?>
<script>alert("<?php echo "$mailsent";?>");</script>
<?php
        }
    }
}
?>