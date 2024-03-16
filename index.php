<?php 
$message = "";
if(isset($_POST['Submit'])){ //check if form was submitted
    $s = "users.csv";
    $data = array(
        $_POST['name'],
        $_POST['email'],
        $_POST['password'],
    );
    if (file_exists($s)) {
        $file = fopen($s,"a+");
        $error = 0;
        while(($fileData = fgetcsv($file)) !== FALSE)
        {
            if($fileData[1] == $_POST['email']){
                $message = "Email id already exist";
                $error++;
                break;
            }
        }
        if($error <= 0){
            fputcsv($file, $data);
            $message = "Register Successfully";
        }
        fclose($file);
    } else {
        $fh = fopen($s, 'w');
        fputcsv($fh, $data);
        $message = "Register Successfully";
        fclose($fh);
    }
} 
?>
<html>
    <head>
        <title>Register</title>
    </head>
    <body>
        <?php echo $message; ?>
        <form action="" method="post">
            <label>Name</label>
            <input type="text" name="name">
            <br/>
            <label>Email</label>
            <input type="email" name="email">
            <br/>
            <label>Password</label>
            <input type="password" name="password">
            <br/>
            <input type="submit" name="Submit">
        </form>
    </body>
</html>