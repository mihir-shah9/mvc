<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- For Ajax-->
    <script type="text/javascript" src="<?php echo $this->baseUrl('skin/Admin/Js/script.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $this->baseUrl('skin/Admin/Js/mage.js'); ?>"></script>

</head>

<body>
    <table border="1" width="100%">
        <tbody>
            <tr>
                <td colspan="3" height="80px">
                    <?php echo $this->getChild('header')->toHtml(); ?>
                </td>
            </tr>
            <tr>
                <td width="150px" height="510px">
                    <?php echo $this->getChild('left')->toHtml(); ?>
                </td>
                <td>
                    <?php echo $this->createBlock('Block\Core\Layout\Message')->toHtml(); ?>
                    <?php echo $this->getChild('content')->toHtml(); ?>
                </td>
                <td width="150px">
                </td>
            </tr>
            <tr>
                <td colspan="3" height="180px">
                    <?php echo $this->getChild('footer')->toHtml(); ?>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>