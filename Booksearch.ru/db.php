<?php

	$conn=mysqli_connect("localhost", "root", "", "shop");
	// echo "Conn Yes</br>";
	// if(!$conn)
	// 	die('DB select no</br>'.mysql_error());
	// $sql="CREATE DATABASE shop";
	// if(mysqli_query($conn, $sql))
	// {
	// 	echo "DB create yes</br>";
	// }
	// else echo "DB create no</br>";

	// $sql= "CREATE TABLE authors (
	// id int(11) NOT NULL auto_increment,
	// fname varchar(50) NOT NULL,
	// name varchar(50),
	// oname varchar(50),
	// PRIMARY KEY (id))";
	// if(mysqli_query($conn, $sql))
	// {
	// 	echo "Table yes</br>";
	// }else echo "Error: " . $sql . "<br>" . mysqli_error($conn);

	// $sql= "CREATE TABLE books (
	// id int(11) NOT NULL auto_increment,
	// title varchar(50) NOT NULL,
	// description varchar(150) NOT NULL,
	// photo varchar(250) NOT NULL,
	// PRIMARY KEY (id))";
	// if(mysqli_query($conn, $sql))
	// {
	// 	echo "Table yes</br>";
	// }else echo "Error: " . $sql . "<br>" . mysqli_error($conn);

	// $sql= "CREATE TABLE author_book (
	// id_author int(11) NOT NULL,
	// id_book int(11) NOT NULL,
	// FOREIGN KEY(id_author) REFERENCES authors(id) ON UPDATE CASCADE ON DELETE CASCADE,
	// FOREIGN KEY(id_book) REFERENCES books(id) ON UPDATE CASCADE ON DELETE CASCADE)";
	// if(mysqli_query($conn, $sql))
	// {
	// 	echo "Table yes</br>";
	// }else echo "Error: " . $sql . "<br>" . mysqli_error($conn);

	// $sql= "CREATE TABLE genres (
	// id int(11) NOT NULL auto_increment,
	// g_name varchar(50) NOT NULL,
	// PRIMARY KEY (id))";
	// if(mysqli_query($conn, $sql))
	// {
	// 	echo "Table yes</br>";
	// }else echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	
	// $sql= "CREATE TABLE book_genre (
	// id_book int(11) NOT NULL,
	// id_genre int(11) NOT NULL,
	// FOREIGN KEY(id_book) REFERENCES books(id) ON UPDATE CASCADE ON DELETE CASCADE,
	// FOREIGN KEY(id_genre) REFERENCES genres(id) ON UPDATE CASCADE ON DELETE CASCADE)";
	// if(mysqli_query($conn, $sql))
	// {
	// 	echo "Table yes</br>";
	// }else echo "Error: " . $sql . "<br>" . mysqli_error($conn);

	// INSERT INTO `authors` (`id`, `fname`, `name`, `oname`) VALUES (NULL, 'Пушкин', 'Александр', 'Сергеевич'), (NULL, 'Гоголь', 'Николай', 'Васильевич');
	// INSERT INTO `books` (`id`, `title`, `description`, `photo`) VALUES (NULL, 'Вий', 'это', 'уууу'), (NULL, 'Евгений Онегин', 'это', 'вввв');
	// INSERT INTO `author_book` (`id_author`, `id_book`) VALUES ('1', '2'), ('2', '1');
	// INSERT INTO `genres` (`id`, `g_name`) VALUES (NULL, 'Роман'), (NULL, 'Фантастика');
	// INSERT INTO `book_genre` (`id_book`, `id_genre`) VALUES ('1', '2'), ('2', '1');
?>