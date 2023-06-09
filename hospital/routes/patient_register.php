<?php
header('Content-Type: text/html; charset=utf-8');
// MySQL 데이터베이스 연결 설정//추가
$servername = "localhost:3306";
$username = "web";
$password = "web_admin";
$dbname = "company";

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

$conn->set_charset("utf8");

// POST 요청 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 웹 폼에서 전달된 환자 정보 수집
    $pid = isset($_POST["pid"]) ? $_POST["pid"] : "";
    $sex = isset($_POST["sex"]) ? $_POST["sex"] : "";
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $job = isset($_POST["job"]) ? $_POST["job"] : "";
    $resid = isset($_POST["resid"]) ? $_POST["resid"] : "";
    $tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
    $address = isset($_POST["address"]) ? $_POST["address"] : "";
    $mandoc = isset($_POST["mandoc"]) ? $_POST["mandoc"] : "";
    $mannur = isset($_POST["mannur"]) ? $_POST["mannur"] : "";

    if ($pid === "") {
        echo "오류: 환자 ID를 제공해야 합니다.";
    } else {
        // 환자 정보를 데이터베이스에 추가하기 전에 중복 확인
        $check_query = "SELECT * FROM PATIENT WHERE PID='$pid'";
        $check_result = $conn->query($check_query);

        if ($check_result === false) {
            echo "오류: " . $check_query . "<br>" . $conn->error;
        } elseif ($check_result->num_rows > 0) {
            echo "이미 해당 PID를 가진 환자가 데이터베이스에 존재합니다.";
        } else {
            // 환자 정보를 데이터베이스에 추가하는 SQL 쿼리
            $insert_query = "INSERT INTO PATIENT (PID, SEX, NAME, EMAIL, JOB, RESID, TEL, ADDRESS, MANDOC, MANNUR) VALUES ('$pid', '$sex', '$name', '$email', '$job', '$resid', '$tel', '$address', '$mandoc', '$mannur')";

            if ($conn->query($insert_query) === TRUE) {
                echo "새로운 환자 정보가 성공적으로 추가되었습니다.";
            } else {
                echo "오류: " . $insert_query . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
    <title>새로운 환자 추가</title>
</head>
<body>
		
    <h2>새로운 환자 추가</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="pid">환자 ID:</label>
        <input type="number" name="pid" required><br>

        <label for="sex">성별:</label>
        <input type="text" name="sex" maxlength="1" required><br>

        <label for="name">이름:</label>
        <input type="text" name="name" maxlength="10" required><br>

        <label for="email">이메일:</label>
        <input type="email" name="email" maxlength="50" required><br>

        <label for="job">직업:</label>
        <input type="text" name="job" maxlength="20" required><br>

        <label for="resid">주민등록번호:</label>
        <input type="text" name="resid" maxlength="14" required><br>

        <label for="tel">전화번호:</label>
        <input type="text" name="tel" maxlength="13" required><br>

        <label for="address">주소:</label>
        <input type="text" name="address" maxlength="30" required><br>

        <label for="mandoc">담당 의사 ID:</label>
        <input type="number" name="mandoc" required><br>

        <label for="mannur">담당 간호사 ID:</label>
        <input type="number" name="mannur" required><br>

        <input type="submit" value="추가">
    </form>
    
    <br>
    <form action="doctor_page.php">
        <input type="submit" value="Go to Doctor Page">
    </form>
    
    <br>
    <form action="nurse_page.php">
        <input type="submit" value="Go to Nurse Page">
    </form>
</body>
</html>
