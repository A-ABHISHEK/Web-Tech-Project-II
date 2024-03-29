<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
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
    <title>Online Library Management System | User Dash Board</title>
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
				setTimeout(getreturn, Math.random()*(1000-1500)+1000);	
		  }
		}
		
		function getreturn(){
		
				xhr.onreadystatechange=showreturn;
				xhr.open("GET","return.txt",true);
				xhr.send();
		}
		function showreturn(){
		
				if(xhr.readyState==4 && xhr.status==200){
					document.getElementById("return").innerHTML=xhr.responseText;
				}		
		}
</script>
    
</head>
<body onload="init()">
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">USER DASHBOARD</h4>
                 </div>
        </div>
             <div class="row">
                 
                 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-info back-widget-set text-center" id="book">
                            </div>
                   <div class="text-center back-wiget-set">
<?php 
$sid=$_SESSION['stdid'];
$sql1 ="SELECT id from tblissuedbookdetails where StudentID=:sid";
$query1 = $dbh -> prepare($sql1);
$query1->bindParam(':sid',$sid,PDO::PARAM_STR);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$issuedbooks=$query1->rowCount();
?>

                            <h3><?php echo htmlentities($issuedbooks);?> </h3>
                            Book Issued
                        </div>
                    </div>
             
               <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-warning back-widget-set text-center" id="return">
                            </div>
                   <div class="text-center back-wiget-set">
<?php 
$rsts=1;
$sql2 ="SELECT id from tblissuedbookdetails where StudentID=:sid and RetrunStatus=:rsts";
$query2 = $dbh -> prepare($sql2);
$query2->bindParam(':sid',$sid,PDO::PARAM_STR);
$query2->bindParam(':rsts',$rsts,PDO::PARAM_STR);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$returnedbooks=$query2->rowCount();
$returnedbooks=$issuedbooks-$returnedbooks;
?>
                            <h3><?php echo htmlentities($returnedbooks);?></h3>
                          Books Not Returned Yet
                        </div>
                    </div>
        </div>            
    </div>
    </div>
</body>
</html>
<?php } ?>
