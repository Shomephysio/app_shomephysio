<?php
if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
   $name = $_POST['name'];
}
?>

<html>
    <body>
        <form action="" method="POST">
            <input type="text" name="name" id="">
            <button style="submit">submit</button>
        </form>
        <p><?php echo $name ?></p>
    </body>
</html>