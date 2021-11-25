<html>
    <head>
	   <title>ONLINE LIBRARY</title>
	   <meta charset='utf-8'>
	   <meta http-equiv="X-UA-Compatible" content="IE=edge">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="styles.css">
	   <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
		
	   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	   <script src="script.js"></script>
	   <script src="js/modernizr.js"></script> <!-- Modernizr -->
	   <script src="js/jquery.js"></script>
		
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/elastislide.css" />
		<link rel="stylesheet" type="text/css" href="css/custom.css" />
		<script src="js/modernizr.custom.17475.js"></script>
    </head>
    <body>
<img src="pic/e.jpg" width="100%" height="250">
<img src="pic/logo.gif" id="lo">
<div id='cssmenu'>
<ul>
   <li class='active'><a href='#'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Book</span></a>
	   <ul>
			<li><a href='bookshelves.php'><span>Bookshelves</span></a></li>
			<li><a href='booklist.php'><span>Book List</span></a></li>
			<li class='last'><a href='e-book.php'><span>E-Book</span></a></li>
	   </ul>
   </li>
   <li class='last'><a href='about.php'><span>About Us</span></a></li>
   <li class='has-sub'><a href='#'><span>ONLIB On The Spot</span></a>
      <ul>
         <li class='last'><a href='OOTS.php'><span>About</span></a></li>
		</ul>
	</li>
	<li class='last'><a href='signin.php'><span><img src="pic/user.png" width="15" height="13" > Sign in</span></a></li>
</ul>
</div>
<div id="content">

	<div id="section">

	<div id="rug5" style="text-align:center;">
		<div id="label"> Top 5 Books </div>
		<br><br><br>
		<center><table><tr>
<?php
		include"connect.php";
		
		$query="SELECT * FROM books ORDER BY rate DESC";
		$exe=mysql_query($query);
		$no=1;
		while($row=mysql_fetch_array($exe)){
		$kode=$row['kode'];
		$cover=$row['cover'];
		$judul=$row['judul'];
		$kategori=$row['kategori'];
			
		if ($kategori=="General"){
		$dir='pic/books/general';
		}
		else if ($kategori=="Islamic"){
		$dir='pic/books/islamic';
		}
		else if($kategori=="Literature"){
		$dir='pic/books/literature';
		}
		else if ($kategori=="Science and Technology"){
		$dir='pic/books/ST';  
		}
	
		if ($no>5) {break;}
		else {
			echo"
			<td><a href='book.php?id=$kode'><img src='$dir/$cover' title='#$no - $judul' alt='#$no-$judul' id='img' /></a></td>
		";
		$no++;
	}
	}
?> </tr></table>
		<div id="line"></div></center>
	</div>
	
	<div id="rug5">
		<div id="label"> New Comings </div>
		<br> <br> <br>
		
		<div class="container demo-1">
            <div class="main">
				<!-- Elastislide Carousel -->
				<ul id="carousel" class="elastislide-list">
					<?php
					include"connect.php";
					
					$query="SELECT * FROM books ORDER BY date DESC";
					$exe=mysql_query($query);
					$no=1;
					while($row=mysql_fetch_array($exe)){
						$kode=$row['kode'];
						$cover=$row['cover'];
						$judul=$row['judul'];
						$kategori=$row['kategori'];
						
						if ($kategori=="General"){
							$dir='pic/books/general';
						}
						else if ($kategori=="Islamic"){
							$dir='pic/books/islamic';
						}
						else if($kategori=="Literature"){
							$dir='pic/books/literature';
						}
						else if ($kategori=="Science and Technology"){
							$dir='pic/books/ST';  
						}
						
						if ($no>10) {break;}
						else {
							echo"
							<li><a href='book.php?id=$kode'><img src='$dir/$cover' title='$judul' alt='$judul' id='img' /></a></li>
							";
							$no++;
						}
					}
					?>
				</ul>
				<!-- End Elastislide Carousel -->
			</div>
		</div>
		<center><div id="line"></div></center>
	</div>

</div>
	
	<div id="sidebar">
	
		<div id="title2"> Looking For Some Book? </div>
		<div id="rug2">
		<center>
		<form action="search.php" method="GET">
		<table align="center">
			<tr><td>
			<form action="search.php">
			<input id="input" type="text" name="keyword" placeholder="type a book title..."><input id="button" type="submit" value="Search" name="sb">
			</form>
			</td></tr>
			<tr><td>&nbsp;</td></tr>
		</table>
		</form>	
		</center>
		</div>
		
		<div id="title2"> Category </div>
		<div id="rug2" >
		<table >
			<tr><td>&nbsp;&nbsp;&nbsp;</td>
			<tr><td>&nbsp;&nbsp;&nbsp;</td>
				<td><font color="#104a73">
					> <a href="booklist.php?sort=ST">Computer</a><br>
					> <a href="booklist.php?sort=G">General</a><br>
					> <a href="booklist.php?sort=I">Islamic</a><br>
					> <a href="booklist.php?sort=L">Novel</a><br>
				</td></tr>
		</table>
		</div>
		
		<div id="title2"> Book Of The Week </div>
		<div id="rug2" >
<?php
		include"connect.php";
		
		$query="SELECT * FROM books ORDER BY rate DESC";
		$exe=mysql_query($query);
		$no=1;
		while ($row=mysql_fetch_array($exe)){

		$kode=$row['kode'];
		$cover=$row['cover'];
		$judul=$row['judul'];
		$kategori=$row['kategori'];
		$penulis=$row['penulis'];
		$deskripsi=$row['deskripsi'];


		if ($kategori=="General"){
			$dir='pic/books/general';
		}
		else if ($kategori=="Islamic"){
			$dir='pic/books/islamic';
		}
		else if($kategori=="Literature"){
			$dir='pic/books/literature';
		}
		else if ($kategori=="Science and Technology"){
			$dir='pic/books/ST';  
		}

	if ($no>1) {break;}
	else { 
		echo"
			<table id='table'>
				<tr>
					<td><a href='book.php?id=$kode'><img src='$dir/$cover' title='#$no-$judul' alt='$judul' id='img1' style='float: left;'></a></td>
					<td><h3>$judul</h3>
						<font size='3' ><i>$penulis</i></td>
				</tr>
			";
		if(strlen($deskripsi) > 200)
		{
			echo "<tr><td colspan='2' align='justify'> ".substr($deskripsi,0,150)."<a href='book.php?id=$kode'><i><font color='#104a73'> ...more</font></i></a></td></tr></table>";
		}
		else
		{
			echo"<tr><td colspan='2'><p align='justify'>$deskripsi</p></td></tr></table>";
		}
		$no++;
		} 		
	} 
?>
		</div>
		
		<div id="title2">Contact Us</div>
		<div id="rug2">
		<table align="center" cellpadding="5">
		<tr><td><div id="fb"><img src="pic/fb.png" id="logo" title="Online Library">&nbsp;  <a href="https://www.facebook.com/pages/Online-Library/624599667620494">Online Library</a></div></td><tr>
		<tr><td><div id="hp"> <img src="pic/phone.png" id="logo" title="0831-9786-7279"> &nbsp;0831-9786-7279</div></td></tr>
		<tr><td><div id="loc"> <img src="pic/loc.png" id="logo" title="Gedung S1 Ilmu Komputer USU">Gedung S1 Ilmu Komputer USU</div></tr></td>
		</table>
		</div>
		
	</div>
	
</div>

<div id="hf"></div>
<div id="footer">
	<center>
	<br>
	<font face="century gothic" color="#bdcdde">&copy; Ukmi Alkhuwarizmi 2015</font>
	</center>
	<div id="quote">
			<hr>
			<section class="cd-intro">
			<p class="cd-headline clip is-full-width">
				<span class="cd-words-wrapper waiting">
					<b class="is-visible">A book is the only place in which you can examine a fragile thought without breaking it</b>				
					<b>Great books help you understand, and they help you feel understood</b>
					<b>Always read something that will make you look good if you die in the middle of it</b>
					<b>Anyone who says they have only one life to live must not know how to read a book</b>
					<b>If we encounter a man of rare intellect, we should ask him what books he reads</b>
					<b>A book is a dream that you hold in your hand</b>
				</span>
			</p>
			</section> <!-- cd-intro -->
			<script src="js/jquery-2.1.1.js"></script>
			<script src="js/main.js"></script> <!-- Resource jQuery -->

	</div>
	
</div>
			
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel' ).elastislide();
			
		</script>
    </body>
</html>
