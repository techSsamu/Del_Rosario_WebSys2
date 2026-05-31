<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <h1> name of the Students are:


    echo $name1;
    echo "<br>";
    echo $name2;
    echo "<br>";
    echo $name3;
    echo "<br>";
    ?>
    </h1>

    <font size = '5' face="'Arial'>

   @if ($id ==1)
    student id is equal to 1
    @else
    student id is not equal to 1
    @endif

    @unless ($id == 1)
    student id is not equal to 1
@endunless

     <h1> Student id is:
         echo $id; ?>
    </h1>

@for($i=1; $i<11; $i++)
{{ $i }}
@endfor -->

@foreach($student as $students)
{{ $student }}
@endforeach




</body>
</html>
