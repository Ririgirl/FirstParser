<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ПОИСК КНИГИ</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css">
	<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<form action="search.php" method="POST">
			<div class="row">
				<div class="col-md-4">Введите название книги</div>
				<div class="col-md-8">
					<input class="form-control" type="text" name="namebook">
				</div>
				<div class="col-md-6"></br>
					<a onclick="$('#authors').slideToggle('slow')" href="javascript://">Выберите автора</a>
					<div id="authors" style="display: none;">
						<?php
							$host = 'localhost'; // адрес сервера 
							$database = 'shop'; // имя базы данных
							$user = 'root'; // имя пользователя
							$password = ''; // пароль
							$link = mysqli_connect($host, $user, $password, $database) 
							    or die("Ошибка бд: " . mysqli_error($link));
							$str1 = 'SELECT distinct fname, name, oname FROM authors '; // выборка значений из бд
							$result_2 = mysqli_query($link, $str1) or die("Ошибка при выводе" . mysqli_error($link));
							$auth;
							if ($result_2) //вывод всех значений построчно
							{ 
								$rows = mysqli_num_rows($result_2);
								for ($i = 0 ; $i < $rows ; ++$i)
							    {
							        $row = mysqli_fetch_row($result_2);
							           for ($j = 0 ; $j < 3 ; ++$j) 
							           	$auth = $auth . $row[$j] . " ";
							        echo "<p><input type='checkbox' name='a[]' value='".$auth."'>" .$auth."</p>";
							        $auth="";
							  }
							} 
					    ?>
					</div>
				</div>
				<div class="col-md-6"></br>
					<a onclick="$('#genres').slideToggle('slow')" href="javascript://">Выберите жанр</a>
					<div id="genres" style="display: none;">
						<?php
							$str2 = 'SELECT distinct g_name FROM genres '; // выборка значений из бд
							$result_3 = mysqli_query($link, $str2) or die("Ошибка при выводе" . mysqli_error($link));
							if ($result_3) //вывод всех значений построчно
							{ 
								$rows = mysqli_num_rows($result_3);
								for ($i = 0 ; $i < $rows ; ++$i)
							    {
							        $row = mysqli_fetch_row($result_3);
							           for ($j = 0 ; $j < 1 ; ++$j) 
							           	echo "<p><input type='checkbox' name='gen[]' value='".$row[$j]."'>" .$row[$j]."</p>";
							  }
							} 
					    ?>
					</div>
				</div>
			</div>
			<button type="submit" name="submit" class="btn btn-primary float-right">Поиск</button>
		</form>
	</div>
	<?php
		if (isset($_POST['submit']))
		{
		$fio = $_POST['a'];
		$genre = $_POST['gen'];
		$select = htmlspecialchars ($_POST["namebook"]);
		if (isset($_POST['a']) && isset($_POST['gen'])) {
				foreach ($fio as $a){
				foreach ($genre as $g){
			        $str_ga = "SELECT books.photo, books.title, books.description, genres.g_name,concat(authors.fname, ' ', authors.name, ' ', authors.oname) FROM books 
							join book_genre on book_genre.id_book = books.id
							join genres on genres.id = book_genre.id_genre
							join author_book on author_book.id_book=books.id
							join authors on authors.id = author_book.id_book
							WHERE genres.g_name = '".$g."' and concat(authors.fname, ' ', authors.name, ' ', authors.oname) = '".$a."'";
							$result = mysqli_query($link, $str_ga) or die("Ошибка при выводе" . mysqli_error($link));
							if ($result) //вывод всех значений
							{ 
								echo "<p><table align='center'border='1'>
									<TR><TH>Картинка</TH><TH>Название книги</TH><TH>Описание</TH><TH>Жанр</TH><TH>ФИО</TH></TR>";
								$rows = mysqli_num_rows($result);
								for ($i = 0 ; $i < $rows ; ++$i)
							    {
							        $row = mysqli_fetch_row($result);
							        echo "<TR>";
							          for ($j = 0 ; $j < 5 ; ++$j) {
							          	if($j!=0)
							          		echo "<TD>$row[$j] </TD>";
							          	else
							          		echo "<TD><img width='200px' height='300px' src=".$row[$j]." </TD>";
							          }
							        echo "</TR>";
							      }
							      echo "<br/>";
							    } 
							   echo "</table></p>";
						    }
			}
		}
		else{
					if (isset($_POST['a'])) {
						foreach ($fio as $a){
					        $str_a = "SELECT books.photo, books.title, books.description, genres.g_name,concat(authors.fname, ' ', authors.name, ' ', authors.oname) FROM books 
									join book_genre on book_genre.id_book = books.id
									join genres on genres.id = book_genre.id_genre
									join author_book on author_book.id_book=books.id
									join authors on authors.id = author_book.id_book
									WHERE concat(authors.fname, ' ', authors.name, ' ', authors.oname) = '".$a."'";
									$result = mysqli_query($link, $str_a) or die("Ошибка при выводе" . mysqli_error($link));
									if ($result) //вывод всех значений
									{ 
										echo "<p><table align='center'border='1'>
											<TR><TH>Картинка</TH><TH>Название книги</TH><TH>Описание</TH><TH>Жанр</TH><TH>ФИО</TH></TR>";
										$rows = mysqli_num_rows($result);
										for ($i = 0 ; $i < $rows ; ++$i)
									    {
									        $row = mysqli_fetch_row($result);
									        echo "<TR>";
									          for ($j = 0 ; $j < 5 ; ++$j) {
									          	if($j!=0)
									          		echo "<TD>$row[$j] </TD>";
									          	else
									          		echo "<TD><img width='200px' height='300px' src=".$row[$j]." </TD>";
									          }
									        echo "</TR>";
									      }
									      echo "<br/>";
									    } 
									   echo "</table></p>";
								    }
					}
					else
					{
						if (isset($_POST['gen'])) {
							foreach ($genre as $g){
			        $str_g = "SELECT books.photo, books.title, books.description, genres.g_name,concat(authors.fname, ' ', authors.name, ' ', authors.oname) FROM books 
							join book_genre on book_genre.id_book = books.id
							join genres on genres.id = book_genre.id_genre
							join author_book on author_book.id_book=books.id
							join authors on authors.id = author_book.id_book
							WHERE genres.g_name = '".$g."'";
							$result = mysqli_query($link, $str_g) or die("Ошибка при выводе" . mysqli_error($link));
							if ($result) //вывод всех значений
							{ 
								echo "<p><table align='center'border='1'>
									<TR><TH>Картинка</TH><TH>Название книги</TH><TH>Описание</TH><TH>Жанр</TH><TH>ФИО</TH></TR>";
								$rows = mysqli_num_rows($result);
								for ($i = 0 ; $i < $rows ; ++$i)
							    {
							        $row = mysqli_fetch_row($result);
							        echo "<TR>";
							          for ($j = 0 ; $j < 5 ; ++$j) {
							          	if($j!=0)
							          		echo "<TD>$row[$j] </TD>";
							          	else
							          		echo "<TD><img width='200px' height='300px' src=".$row[$j]." </TD>";
							          }
							        echo "</TR>";
							      }
							      echo "<br/>";
							    } 
							   echo "</table></p>";
						    }
					}
					else
					{
						$str = "SELECT books.photo, books.title, books.description, genres.g_name,concat(authors.fname, ' ', authors.name, ' ', authors.oname) FROM books 
						join book_genre on book_genre.id_book = books.id
						join genres on genres.id = book_genre.id_genre
						join author_book on author_book.id_book=books.id
						join authors on authors.id = author_book.id_book
						WHERE books.title LIKE '%".$select."%'";
						$result = mysqli_query($link, $str) or die("Ошибка при выводе" . mysqli_error($link));
						if ($result) //вывод всех значений
						{ 
							echo "<p><table align='center'border='1'>
								<TR><TH>Картинка</TH><TH>Название книги</TH><TH>Описание</TH><TH>Жанр</TH><TH>ФИО</TH></TR>";
							$rows = mysqli_num_rows($result);
							for ($i = 0 ; $i < $rows ; ++$i)
						    {
						        $row = mysqli_fetch_row($result);
						        echo "<TR>";
						          for ($j = 0 ; $j < 5 ; ++$j) {
						          	if($j!=0)
						          		echo "<TD>$row[$j] </TD>";
						          	else
						          		echo "<TD><img width='200px' height='300px' src=".$row[$j]." </TD>";
						          }
						        echo "</TR>";
						      }
						      echo "<br/>";
						    } 
						   echo "</table></p>";
						}
				}
	}
}
	?>
</body>
</html>

<!-- $str = "SELECT books.photo, books.title, books.description, genres.g_name,concat(authors.fname, ' ', authors.name, ' ', authors.oname) FROM books 
							join book_genre on book_genre.id_book = books.id
							join genres on genres.id = book_genre.id_genre
							join author_book on author_book.id_book=books.id
							join authors on authors.id = author_book.id_book
							WHERE books.title LIKE '%".$select."%' and genres.g_name = 'Роман' and concat(authors.fname, ' ', authors.name, ' ', authors.oname) = 'Пушкин Алексанр Сергеевич'"; -->