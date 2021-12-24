<?php
session_start();

if (!isset($_SESSION['payment'])) {
	header('Location:/medical-test-and-report-management-system/');
	return;
}

require 'db/connect_db.php';

$sql='SELECT name FROM auth, users WHERE auth.id=users.uid AND auth.id=:id LIMIT 1';
$query=$db->prepare($sql);
$query->execute(array(':id'=>$_SESSION['authid']));
$row=$query->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
		<meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="icon" type="image/ico" href="imgs/favicon/favicon.ico">
    	<link rel="apple-touch-icon" sizes="180x180" href="imgs/favicon/apple-touch-icon.png">
    	<link rel="icon" type="image/png" sizes="32x32" href="imgs/favicon/favicon-32x32.png">
    	<link rel="icon" type="image/png" sizes="16x16" href="imgs/favicon/favicon-16x16.png">
    	<link rel="manifest" href="site.webmanifest">
    	<title>Payment Confirmed</title>
    </head>
    <body>
        <main class="container">
			<div class="row m-3">
				<div class="col-3">
					<a href="https://med-lab-reports.great-site.net/">
					<img src="imgs/icons/logo.png" width="40" height="40" alt="logo"></a>
				</div>
				<div class="col-6">
					<h3 class="text-center font-monospace">Medical Test and Report Management System</h3>
				</div>
			</div>
            <div class="row m-3">
				<div class="col-md-6 offset-md-3">
                    <div class="card text-center">
                      <div class="card-body">
						  <h5>Congrats <?=htmlentities($row['name']); ?>!</h5>
						  <br>
						  <h5>Your Booking is Confirmed with Payment ID: <?=htmlentities($_SESSION['payment']); ?></h5>
							  <img src="imgs/icons/done.jpg" width="450" height="450" alt="done-icon">
							  <a href="view-result.php?payId=<?php echo $_SESSION['payment']; ?>" class="float-start btn btn-success my-6">Return to Dashboard</a>
							  <form action="invoice.php" target="_blank" method="post">
							  	<input type="hidden" name="payId" value="<?=htmlentities($_SESSION['payment']); ?>">
								<button type="submit" class="float-end btn btn-info my-6">View Invoice</button>
							  </form>
                      </div>
                    </div>
				</div>
			</div>
        </main>
		<?php
		header('refresh:15;url=view-result.php?payId='.$_SESSION['payment']);
		?>
    </body>
</html>
