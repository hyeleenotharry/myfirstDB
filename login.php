<?php
// 사용자가 제출한 로그인 폼에서 전달된 데이터를 가져옴
$username = $_POST['username'];
$password = $_POST['password'];

// 실제 사용자 인증 로직을 구현
// 여기서는 간단히 예시를 들기 위해 고정된 사용자 이름과 비밀번호를 체크하는 것으로 가정
$validUsername = 'john';
$validPassword = '1029';

if ($username == $validUsername && $password == $validPassword) {
    // 인증 성공 시, 로그인 완료 페이지로 리다이렉션 또는 다음 로직을 추가
    header('Location: login_success.php');
    exit;
} else {
    // 인증 실패 시, 오류 메시지를 출력하거나 다음 로직을 추가
    echo '인증 실패';
}
?>