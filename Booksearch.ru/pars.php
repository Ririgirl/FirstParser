<head>
	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 

</head>
<body>
	<form method="POST" action="pars.php">
		<button type="submit" name="submit">Запарсить!</button>
	</form>
</body>
<?php 
include_once 'libs/simple_html_dom.php';

//Сайт для парсинга
$url = "https://www.litmir.me/bs";
//Массив для данных
$lists = array();

//Получаем сайт с помощью curl в переменную
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); // Устанавливаем ссылку
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // передаем результат в качестве строки
$answer = curl_exec($ch); // Заносим результат в переменную


//echo $answer;

//Создаем объект библиотеки для парсинга
$dom = new simple_html_dom();
$html = str_get_html($answer); //Формируем массив
$list = $html->find(".book name"); //Ассоциативный массив из элементов имеющих класс .about-list li

// Название книг
// foreach($html->find('div.book_name a span') as $element) 
//        echo $element . '<br>';

//Описание книг 
// foreach($html->find('div.description div.BBHtmlCode div.BBHtmlCodeInner') as $element) 
//        echo $element . '<hr><br>';

//фото книг 
// foreach($html->find('td.lt22 a') as $element) 
//     {   
//     	// echo "<a href='https://www.litmir.me$element->href'>fdg </a><br>";
// $url1= "https://www.litmir.me$element->href";
// $ch1 = curl_init();
// curl_setopt($ch1, CURLOPT_URL, $url1); // Устанавливаем ссылку
// curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); // передаем результат в качестве строки
// $answer1 = curl_exec($ch1); // Заносим результат в переменную
// $html1 = str_get_html($answer1);
//        foreach($html1->find('div.lt34 img') as $element1) 
//        echo "<img src='https://www.litmir.me$element1->src' alt=''>"  . '<br>';
// }

//Автор
// $authors = [];
// foreach($html->find('span.desc2 meta') as $element) 
//        {
//        	echo $element->content . '<br>';
//        	$aut = $element->content;
//         $pieces = explode(" ", $aut);
//         echo 'f:' . $pieces[0]. '<br>';
//         echo 'n:' . $pieces[1]. '<br>';
//         echo 'o:' . $pieces[2]. '<br>';
//             	}

//Жанр
// foreach($html->find('span.[itemprop="genre"] a') as $element) 
//        echo $element->innertext . '<hr><br>';
$host = 'localhost'; // адрес сервера 
							$database = 'shop'; // имя базы данных
							$user = 'root'; // имя пользователя
							$password = ''; // пароль
							$link = mysqli_connect($host, $user, $password, $database) 
							    or die("Ошибка бд: " . mysqli_error($link));
							if (isset($_POST['submit'])){
							    //удаляем все данные из бд
							$delete = 'DELETE FROM books';
							$del = mysqli_query($link, $delete) or die("<br/>Ошибка при удалении: " . mysqli_error($link)); 
							$delete1 = 'DELETE FROM authors';
							$del1 = mysqli_query($link, $delete1) or die("<br/>Ошибка при удалении: " . mysqli_error($link)); 
							$delete2 = 'DELETE FROM genres';
							$del2 = mysqli_query($link, $delete2) or die("<br/>Ошибка при удалении: " . mysqli_error($link)); 
							$delete3 = 'DELETE FROM book_genre';
							$del3 = mysqli_query($link, $delete3) or die("<br/>Ошибка при удалении: " . mysqli_error($link)); 
							$delete4 = 'DELETE FROM author_book';
							$del4 = mysqli_query($link, $delete4) or die("<br/>Ошибка при удалении: " . mysqli_error($link)); 
									//блок книги
							$index=0;
									//прохожу по массиву с книгами
							$x=0;
							foreach($html->find('table.island') as $element){ 
								if ($x==6) continue;
										$title = $html->find('div.book_name a span', $index)->innertext; //беру название книги
										$description = $html->find('div.description div.BBHtmlCode div.BBHtmlCodeInner', $index)->innertext;//беру описание
										$photo = $html->find('td.lt22 a', $index); //беру ссылку на фото
									  $url1= "https://www.litmir.me$photo->href"; //перехожу по ссылке
										$ch1 = curl_init();
										curl_setopt($ch1, CURLOPT_URL, $url1); // Устанавливаем ссылку
										curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true); // передаем результат в качестве строки
										$answer1 = curl_exec($ch1); // Заносим результат в переменную
										$html1 = str_get_html($answer1); //беру саму ссылку на фотку
										$photoinsert;
										foreach($html1->find('div.lt34 img') as $element1) 
											$photoinsert = "https://www.litmir.me$element1->src";
											// echo "<img src='https://www.litmir.me$element1->src' alt=''>"  . '<br>';
										$insert = "INSERT INTO books VALUES(NULL,'$title','$description','$photoinsert')";
										$result = mysqli_query($link, $insert) or die("<br/>Ошибка при внесении: " . mysqli_error($link)); 
										if(!$result) //сообщение о добавлении в бд
										{
											echo "<br/>Данные NOT добавлены <br/><hr>";
										}
										$author = $html->find('span.desc2 meta', $index); //беру автора
									  $aut = $author->content;
									        $pieces = explode(" ", $aut);
									        $f = $pieces[0];
									        $n = $pieces[1];
									        $o = $pieces[2];
									        // echo 'f:' . $pieces[0]. '<br>';
									        // echo 'n:' . $pieces[1]. '<br>';
									        // echo 'o:' . $pieces[2]. '<br>';
									  $insert1 = "INSERT INTO authors VALUES(NULL,'$f','$n','$o')";
									  $result1 = mysqli_query($link, $insert1) or die("<br/>Ошибка при внесении: " . mysqli_error($link)); 
										if(!$result1) //сообщение о добавлении в бд
										{
											echo "<br/>Данные NOT добавлены <br/><hr>";
										}
										
									  $genre = $html->find('span.[itemprop="genre"] a', $index)->innertext; //беру жфнр
									  $insert2 = "INSERT INTO genres VALUES(NULL,'$genre')";
									  $result2 = mysqli_query($link, $insert2) or die("<br/>Ошибка при внесении: " . mysqli_error($link)); 
										if(!$result2) //сообщение о добавлении в бд
										{
											echo "<br/>Данные NOT добавлены <br/><hr>";
										}
										$sel1 = 'SELECT id FROM books ORDER BY id DESC LIMIT 1';
										$result_sel1 = mysqli_query($link, $sel1) or die("<br/>Ошибка при внесении: " . mysqli_error($link)); 
										$sel2 = 'SELECT id FROM genres ORDER BY id DESC LIMIT 1';
										$result_sel2 = mysqli_query($link, $sel2) or die("<br/>Ошибка при внесении: " . mysqli_error($link));
										$sel3 = 'SELECT id FROM authors ORDER BY id DESC LIMIT 1';
										$result_sel3 = mysqli_query($link, $sel3) or die("<br/>Ошибка при внесении: " . mysqli_error($link)); 
										if($result_sel1)
										{				
											if($result_sel2)
											{
												if($result_sel3)
												{
													$row = mysqli_fetch_row($result_sel1);
													$row2 = mysqli_fetch_row($result_sel2);
													$row3 = mysqli_fetch_row($result_sel3);
														// echo $row[0];
														// echo $row2[0];
														// echo $row3[0];
														$insert_ab = "INSERT INTO book_genre VALUES($row[0],$row2[0])";
														$result_ab = mysqli_query($link, $insert_ab) or die("<br/>Ошибка при внесении: " . mysqli_error($link)); 
														$insert_bg = "INSERT INTO author_book VALUES($row3[0],$row[0])";
														$result_bg = mysqli_query($link, $insert_bg) or die("<br/>Ошибка при внесении: " . mysqli_error($link)); 	
															}}}
										$index=$index+1;$x=$x+1;
									}
								}
								
							
?>