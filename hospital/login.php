<?php
// MySQL 데이터베이스 연결 정보
$servername = "localhost";
$username = "root";
$password = "dlgpfl@1029";
$dbname = "sys";

// POST로 전달된 사용자 입력 값
$enteredId = $_POST['id'];
$enteredPassword = $_POST['password'];

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 입력받은 ID로 사용자 조회
$sql = "SELECT * FROM users WHERE id = '$enteredId'";
$result = $conn->query($sql);

// 사용자 확인
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];

    // 입력받은 비밀번호와 저장된 비밀번호 비교
    if ($enteredPassword === $storedPassword) {
        echo "로그인 성공";
        // 로그인 성공한 경우 추가적인 작업 수행
        $firstDigit = substr($enteredId, 0, 1);
        if ($firstDigit === '1') {
            // Doctor 화면으로 이동
            header("Location: routes/doctor_page.php");
            exit();
        } elseif ($firstDigit === '2') {
            // Nurse 화면으로 이동
            header("Location: routes/nurse_page.php");
            exit();
        } else {
            // 기타 화면으로 이동
            header("Location: other_page.php");
            exit();
        }
    } else {
        echo "비밀번호가 일치하지 않습니다.";
    }
} else {
    echo "사용자가 존재하지 않습니다.";
}

// MySQL 연결 종료
$conn->close();
?>
