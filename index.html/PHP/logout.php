<?php
session_start();
session_destroy();
echo "<script>
    localStorage.removeItem('iniciales');
    window.location.href = '../HTML/index.html';
</script>";
exit();
?>
