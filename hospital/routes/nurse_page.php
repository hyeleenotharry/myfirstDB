<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <form method="post" action="search_nurse.php">
        <input type="submit" name="search" value="Search">
    </form>

    <form method="post" action="patient_register.php">
        <input type="submit" name="patient_register" value="Patient Register">
    </form>

    <form method="post" action="analysis_nurse.php">
        <input type="submit" name="analysis" value="Analysis">
    </form>
    <form method="POST" action="../login.php">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>
		<form method="POST" action="get_chart_data.php">
        <input type="submit" name="patient_register" value="Just Chart">
    </form>

    
</body>
</html>
