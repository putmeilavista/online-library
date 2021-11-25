<?php
	session_start();
	if((empty($_SESSION["member"]))&&(empty($_SESSION["admin"]))){
		header('location:signin.php');
	} else {

	?>

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
<div id='cssmenu'>
<ul>
   <li class='active'><a href='index2.php'><span>Home</span></a></li>
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
         <li><a href='OOTS.php'><span>About</span></a></li>
         <li class='last'><a href='GuestBook.php'><span>Guest Book</span></a></li>
      </ul>
   </li>
<?php
	if (isset($_SESSION["admin"])){
   echo "<li class='has-sub'><a href='#'><span>Admin</span></a>
      <ul>
		<li><a href='member.php'><span>View Member</span></a></li>
         <li><a href='admin.php'><span>View Admin</span></a></li>
         <li class='last'><a href='addadmin.php'><span>Add Admin</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='about.php'><span>Notification</span></a>
      <ul>
         <li><a href='memberreq.php'><span>Member Request</span></a></li>
         <li class='last'><a href='borrowed.php'><span>Borrowed Book</span></a></li>
      </ul>
	</li>
   <li class='has-sub'><a href='#'><span><img src='pic/user.png' width='15' height='13' > Admin $_SESSION[admin]</span></a>
      <ul>
	  <li><a href='account.php'><span>My Account</span></a></li>
         <li><a href='uploadbook.php'><span>Upload Book</span></a></li>
         <li class='last'><a href='signout.php'><span>Sign Out</span></a></li>
      </ul>
   </li> "; 
}

else if (isset($_SESSION["member"])){
   echo "
	   <li class='has-sub'><a href='#'><span><img src='pic/user.png' width='15' height='13' > $_SESSION[member]</span></a>
      <ul>
	  <li><a href='account.php'><span>My Account</span></a></li>
         <li class='last'><a href='signout.php'><span>Sign Out</span></a></li>
      </ul>
   </li> ";
	}
?>
</ul>
</div>
<div id="content" style="height: 1000px;">

	<center>
	<div id="section">

	<div id="rug5" style="text-align:center;">
		<div id="label"> Guest Book </div>
<?php
			include "connect.php";
			
			$date=date('d/m/Y');
		echo"Tanggal : <u>$date</u><br><Br>";
		echo"<table id='table' cellpadding='5' cellspacing='5'>
			<tr>
				<th>No</th><th>Nama</th><th>NIM</th><th>No. HP</th>
			</tr> ";

		$batas= 10;
		$file='guestbook.php';
		$halaman=(isset($_GET['halaman']));
		if(!(isset($_GET['halaman'])))
		{
			$posisi=0;
			$halaman=1;
		}
		else
		{
			$posisi = ($halaman-1) * $batas;
		}
		
			$quero = "SELECT * FROM guest WHERE tanggal='$date' ";
			$xe = mysql_query($quero);
			$jmldata = mysql_num_rows($xe);
			$jmlhalaman=ceil($jmldata/$batas);

		 if ($jmldata==0){echo "";}
		 else {
			$qu = "SELECT * FROM guest WHERE tanggal='$date' limit $posisi,$batas";
			$xi = mysql_query($qu);
			$no = $posisi;
			while($ro = mysql_fetch_array($xi))
			{
				$no++;
				$tanggal=$ro['tanggal'];
				$nama=$ro['nama'];
				$nim=$ro['nim'];
				$hp=$ro['hp'];
			echo"
			<tr>
				<td>$no</td><td>$nama</td><td align='center'>$nim</td><td align='center'>$hp</td>
			</tr>
		";

	if ($no==$jmldata) break;
		}
			if ($jmlhalaman!=1){
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=\"$file?halaman=1\"><< First</A> | 
					<A HREF=\"$file?halaman=$previous\">< Previous</A> | ";
			}
			else
			{ 
				//echo "<< First | < Previous | ";
			}

			$angka=($halaman > 3 ? " ... " : " ");
			for($i=$halaman-2;$i<$halaman;$i++)
			{
			  if ($i < 1) 
				  continue;
			  $angka .= "<a href=\"$file?halaman=$i\">$i</A> ";
			}

			$angka .= " <b>$halaman</b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=\"$file?halaman=$i\">$i</A> ";
			}

			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=\"$file?halaman=$jmlhalaman\">$jmlhalaman</A> " : " ");

			echo "$angka";

			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=\"$file?halaman=$next\">Next ></A> | 
			  <A HREF=\"$file?halaman=$jmlhalaman\">Last >></A> ";
			}
			else
			{ 
				//echo " | Next > | Last >>";
			}
		}
		 }
	?>	<form action="guestpro.php">
		<tr>
			<td>&nbsp;</td><td><input type="text" name="nama"></td><td><input type="text" name="nim"></td><td><input type="text" name="hp"></td><td colspan="4" align="center"><input type="submit" value="Sign"></td>
		</tr>
		</form>
		</table>
	</div>

<?php
	if ($jmldata==0){echo"";}
	else{
		echo'
		<div id="rug5">
		<div id="label"> Guest Book </div>
		<br><bR><br><p> ';

				$quera = "SELECT DISTINCT tanggal FROM guest ORDER BY tanggal ASC";
				$x = mysql_query($quera);
				$no = 1;
				while($row = mysql_fetch_array($x))
				{
					$tanggal=$row['tanggal'];
				echo"
				<a href='#'> $tanggal</a><br>
				";
				}
	}
?>
	</p>
	</div>


		
</center>
	
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
	<font face="bookman old style" color="#bdcdde" size="4">&copy; UKMI Al-Khuwarizmi 2015</font>
	<br><br>
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

	<?php } ?>