<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>
    .card{
        padding: 20px 20px 20px 20px    ;
    }
</style>

<body style="padding:20px 20px 20px 20px;">
    <div class="card" style="width: 30rem;">
        <form class="form-check" action="poll.php" method="POST" >
            <h4>Санал асуулга</h4>
            <?php
                $file = fopen("poll.txt","a+");
                $question = fgets($file);
                $answer_str = fgets($file);
                $answer = array_map('intval', explode(',', $answer_str));

                echo $question."<br>";
                echo "<br>";

                if(isset($_POST["submit"])){
                    $userAnswer = $_POST['userAnswer'];
                    if(!isset($_COOKIE["poll"])){
                        $expire = time() + 20;
                        setcookie("poll", 1, $expire);
                            $old_answer = $answer_str;
                            $answer[$userAnswer-1]++;
                            $answer_str = implode(",",$answer);

                            $str=file_get_contents('poll.txt'); //file dotr baisan txtiig string bolgoj awnaa
                            $str=str_replace($old_answer, $answer_str,$str); //huucin answerig shine answerer solinoo
                            file_put_contents('poll.txt', $str);//poll txt ruu bvgdiin oruulnaa

                        echo "You polled <br>";
                    } else echo "You already polled <br>";
                } 
            ?>
            <div class="form-check" style="border: 5px; border-color: #e4e6eb;">
                <input class="form-check-input" type="radio" name="userAnswer" id="userAnswer" value="1">
                <label class="form-check-label" for="userAnswer">
                    Тийм
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="userAnswer" id="userAnswer1" value="2">
                <label class="form-check-label" for="userAnswer1">
                    Үгүй
                </label>
            </div>
            <div class="form-check" >
                <input class="form-check-input" type="radio" name="userAnswer" id="userAnswer2" value="3">
                <label class="form-check-label" for="userAnswer2">
                    Мэдкүшдэ
                </label>
            </div>
            <div class="row">
                    <div class="col-sm" style="width:75%;"><input class="btn btn-primary" type="submit" name="submit" value="Санал өгөх"></div>
                    <div class="col-sm" style="color: #88909e;"><?php echo "(Нийт санал : ".array_sum($answer).")";?></div>
            </div>    
        </form>
    </div>
</body>
</html>