<?php
// MySQL 데이터베이스 연결 정보
$servername = "localhost";
$username = "root";
$password = "dlgpfl@1029";
$dbname = "my_db";

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 검색 조건을 위한 콤보박스 옵션
$searchOptions = array("이름", "환자 ID", "주민번호");

// POST로 전달된 검색 조건과 검색어
$searchOption = $_POST['search_option'];
$searchKeyword = $_POST['search_keyword'];

// 환자 정보 검색
$sql = "SELECT * FROM patient";

if (!empty($searchKeyword)) {
    if ($searchOption === "이름") {
        $sql .= " WHERE 환자이름 LIKE '%$searchKeyword%'";
    } elseif ($searchOption === "환자 ID") {
        $sql .= " WHERE PATID = '$searchKeyword'";
    } elseif ($searchOption === "주민번호") {
        $sql .= " WHERE 주민번호 = '$searchKeyword'";
    }
}

$result = $conn->query($sql);

// 검색 결과 표시
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>환자 ID</th><th>이름</th><th>나이</th><th>성별</th><th>주소</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['PATID']."</td>";
        echo "<td>".$row['환자이름']."</td>";
        echo "<td>".$row['SEX']."</td>";
        echo "<td>".$row['직업']."</td>";
        echo "<td>".$row['EMAIL']."</td>";
        echo "<td>".$row['DOCTID']."</td>";
        echo "<td>".$row['NURID']."</td>";
        echo "<td>".$row['ADDRESS']."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "검색 결과가 없습니다.";
}

// MySQL 연결 종료
$conn->close();
?>

<!-- 검색 폼 -->
<form method="POST" action="doctor_page.php">
    <select name="search_option">
        <?php
        foreach ($searchOptions as $option) {
            echo "<option value='$option'>$option</option>";
        }
        ?>
    </select>
    <input type="text" name="search_keyword">
    <input type="submit" value="검색">
</form>
