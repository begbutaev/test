<?php
system("cls");
echo "***********************************************\n";

 const dir = "C:\cc\a.txt";

switch ($argv[1]) {
    case 'view':
        action::view();
        break;

    case 'edit':
        action::edit();
        break;

    case 'add':
        action::add();
        break;

    case 'delete':
        action::delete();
        break;

    case 'sum':
        action::sum();
        break;

    default:
        echo "Что то пошло не так. \n";
        break;
}
echo "\n";

class action {

    public static function view() {
        if (file_exists(dir)) {
            $GetContentFile = file_get_contents(dir);
            echo $GetContentFile;
        }
    }


   public static function add() {
       $contents = file_get_contents(dir);
       echo "Введите контент: \n";
       $addContent = readline();
       $contents .= "\r\n" . $addContent;
       file_put_contents(dir, $contents);
       echo "*************************\n";
       action::view();
   }

    public static function edit() {
        echo "Изменить контент: \n";
        $line = readline();
        echo "Введите заменяющий контент: \n";
        $editContent = readline();
        $contents = file_get_contents(dir);
        $contents = str_replace($line. "\r\n", $editContent . "\n", $contents);
        file_put_contents(dir, $contents);
        echo "*************************\n";
        action::view();
    }

    public static function delete() {
        echo "Удалить контент: \n";
        $line = readline();
        $contents = file_get_contents(dir);
        $contents = str_replace($line.  "\r\n", '', $contents);
        file_put_contents(dir, $contents);
        echo "*************************\n";
        action::view();
    }

    public static function sum() {
        $file_array = file(dir);
        $arrlength = count($file_array);

        $total = 0;
        $sum = '';

        for($x = 0; $x < $arrlength; $x++) {
            $arr = str_split($file_array[$x],1);
            $arrlength2 = count($arr);

            for($y = 0; $y < $arrlength2; $y++){
                if(ctype_digit($arr[$y])){
                    $sum .= $arr[$y];
                }
            }
            $total += intval($sum);
            $sum = '';

        }
        echo $total;
        echo "\n";
    }
}