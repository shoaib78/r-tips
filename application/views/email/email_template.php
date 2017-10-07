<html>
    <head>
        
    </head>
    <body style="background-color: #262626;border: 1px solid #000000; color: #fff">
        <div style=" color: #000;    padding: 20px;    font-size: 20px;">
            Hello <strong><?php echo $username ?></strong> <br/>
            <br/>
            We have received a request to reset your password.
            <br/>
            To reset your password, please click on the link below or copy and paste the URL into your browser:
            <br/>
            <br/>
            <?php echo $reset_link;?>
            <br/>
            <br/>
            <strong>Thanks &amp; Regards</strong><br/>
            <strong>Tips and Go Team</strong>
        </div>
    </body>
</html>