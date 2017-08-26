<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>CI.Lessons - Codeigniter mail templates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div>
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Hey <?php echo $user['first_name'] . ' ' . $user['last_name'];?>,</p>
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> You just registred on my cilessins. If yes - click on that <a href="<?php  echo $user['confirmation_link'] ?>">link</a> to confirm registration. </p>
</div>
</body>
</html>
