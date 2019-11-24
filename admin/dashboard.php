<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Admin Dash Board</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script>
		function init(){
		
		xhr = new XMLHttpRequest();	
            if(xhr){
            setTimeout(getContent, 500);
            }
			function getContent()
			{
				xhr.onreadystatechange = showContent;
				xhr.open("GET", "book.txt", true);
				xhr.send(null);
			}	
		}
		function showContent(){
		
		if(xhr.readyState=="4"&&xhr.status==200){
				document.getElementById("book").innerHTML=xhr.responseText;
				setTimeout(getPic, Math.random()*(1000-1500)+1000);	
		  }
		
		
		}
		function getPic(){
			xhr.open("GET", "issue.txt", true);
			xhr.onreadystatechange = showImg;
			xhr.send(null);
		}
		function showImg()
		{
			if(xhr.readyState == 4 && xhr.status == 200)
			{
				document.getElementById("issue").innerHTML = xhr.responseText;	
			}
			setTimeout(getreturn,Math.random()*(1000-2000)+1000);
			
		}
		function getreturn(){
		
				xhr.onreadystatechange=showreturn;
				xhr.open("GET","return.txt",true);
				xhr.send();
		}
		function showreturn(){
		
				if(xhr.readyState==4 && xhr.status==200){
					document.getElementById("return").innerHTML=xhr.responseText
					//TODO:
					setTimeout(getusers,Math.random()*(1500-1600)+1500);
				}		
		}
		function getusers(){
		
				xhr.onreadystatechange=showusers;
				xhr.open("GET","users.txt",true);
				xhr.send();
		}
		function showusers(){
				if(xhr.readyState==4 && xhr.status==200){
                  document.getElementById("users").innerHTML=xhr.responseText
					setTimeout(getauthor,Math.random()*(1000-1500)+1000);
				}
		}
        function getauthor(){
				xhr.onreadystatechange=showauthor;
				xhr.open("GET","author.txt",true);
				xhr.send();
		}
		function showauthor(){
				if(xhr.readyState==4 && xhr.status==200){
					document.getElementById("author").innerHTML=xhr.responseText
					setTimeout(getcategory,Math.random()*(1000-1800)+1000);
				}
		}
        function getcategory(){
				xhr.onreadystatechange=showcategory;
				xhr.open("GET","category.txt",true);
				xhr.send();
		}
		function showcategory(){
				if(xhr.readyState==4 && xhr.status==200){
					document.getElementById("category").innerHTML=xhr.responseText
				}
		}

</script> 
</head>
<body onload="init()">
      <!------MENU SECTION START-->
    <div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">

                    <img src="assets/img/logo.png" />
                </a>

            </div>

            <div class="right-div">
                <a href="logout.php" class="btn btn-danger pull-right">LOG ME OUT</a>
            </div>
            <div class="right-div">
                <a href="../chat/chat.php" class="btn btn-danger pull-right">CHAT</a>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>
                             <li><a href="reg-students.php">Reg Students</a></li>
                    
  <li><a href="change-password.php">Change Password</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">ADMIN DASHBOARD</h4>
              </div>
        </div>
    <div class="row">

 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-success back-widget-set text-center" id="book">
                          </div>
                   <div class="text-center alert-danger back-wiget-set">
<?php 
$sql ="SELECT id from tblbooks ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$listdbooks=$query->rowCount();
?>


                            <h3><?php echo htmlentities($listdbooks);?></h3>
                      Books Listed
                        </div>
                    </div>

            
                 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-info back-widget-set text-center" id="issue">
                          </div>
                   <div class="text-center alert-danger back-wiget-set">
<?php 
$sql1 ="SELECT id from tblissuedbookdetails ";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$issuedbooks=$query1->rowCount();
?>

                            <h3><?php echo htmlentities($issuedbooks);?> </h3>
                           Times Book Issued
                        </div>
                    </div>
             
               <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-warning back-widget-set text-center" id="return">
                          
                          </div>
                   <div class="text-center alert-danger back-wiget-set">
<?php 
$status=1;
$sql2 ="SELECT id from tblissuedbookdetails where RetrunStatus=:status";
$query2 = $dbh -> prepare($sql2);
$query2->bindParam(':status',$status,PDO::PARAM_STR);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$returnedbooks=$query2->rowCount();
?>

                            <h3><?php echo htmlentities($returnedbooks);?></h3>
                          Times  Books Returned
                        </div>
                    </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-danger back-widget-set text-center" id="users">
                          </div>
                   <div class="text-center alert-danger back-wiget-set">
                            <?php 
$sql3 ="SELECT id from tblstudents ";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$regstds=$query3->rowCount();
?>
                            <h3><?php echo htmlentities($regstds);?></h3>
                           Registered Users
                        </div>
                    </div>

        </div>

<br><br>

 <div class="row">

 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-success back-widget-set text-center" id="author">
                          </div>
                   <div class="text-center alert-danger back-wiget-set">
<?php 
$sq4 ="SELECT id from tblauthors ";
$query4 = $dbh -> prepare($sq4);
$query4->execute();
$results4=$query4->fetchAll(PDO::FETCH_OBJ);
$listdathrs=$query4->rowCount();
?>


                            <h3><?php echo htmlentities($listdathrs);?></h3>
                      Authors Listed
                        </div>
                    </div>

            
                 <div class="col-md-3 col-sm-3 rscol-xs-6">
                      <div class="alert alert-info back-widget-set text-center" id="category">
                          </div>
                   <div class="text-center alert-danger back-wiget-set">
<?php 
$sql5 ="SELECT id from tblcategory ";
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$listdcats=$query5->rowCount();
?>

                            <h3><?php echo htmlentities($listdcats);?> </h3>
                           Listed Categories
                        </div>
                    </div>
        </div>                    
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
</body>
</html>
<?php } ?>
