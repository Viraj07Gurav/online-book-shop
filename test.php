<!-- <?php
for($i=1;$i<=10;$i++){
    echo "$i";
    ?>
    <br>
<?php
}
?> -->

<!-- even odd -->
 <!-- <?php
 $num=5;
 if($num %2==0){
 echo $num .'even number';
 }else{
    echo $num .'odd num';
 }
 ?> -->

  <!-- while  -->
   <!-- number of digit  -->
    <!-- <?php
    $num=1023;
    $count=0;
    while($num>0){
        $num=(int)($num/10);

        $count++;
    }
    echo 'count is' .$count;
    ?> -->

    <!-- reverse the number -->
     <?php
     $num=1023;
     $rev=0;
     while($num>0){
        $digit=$num%10;
        $rev=$rev*10+$digit;
        $num=(int)($num/10);
     }
     echo "reverse num is" .$rev;