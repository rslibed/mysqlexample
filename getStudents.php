<?php
    require_once('mysqlcredentials.php');
    if (empty($_GET['id'])) {
        $fields = 'name, email, status';
        $whereClause = '';
    } else {
        $fields = '*';
        $whereClause = "WHERE id= {$_GET['id']}";
    }
    $query = "SELECT $fields FROM users $whereClause";
    $result = mysqli_query($conn, $query);
    $output = [
        'success' => false,
        'data' => [],
        'errors' => []
    ];
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $output['data'][] = $row;
            }
            $output['success'] = true;
        } else {
            $output['errors'][] = 'no data available';
        }
    } else {
        $output['errors'][] = 'error in SQL query';
    }
    $json_output = json_encode($output);
    print($json_output);
?>