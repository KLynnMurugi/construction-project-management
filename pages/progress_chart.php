<?php
// ... [Database connection remains the same] ...

$chart_data_points = [];

// 1. Fetch divisions
$prog = $conn->query("SELECT * FROM project_partition NATURAL JOIN project_division WHERE project_id = '$id'");

// CHECK: If the query failed or returned 0 rows, initialize variables to avoid errors
$num_rows = ($prog) ? $prog->num_rows : 0;

if ($num_rows > 0) {
    while($progress = $prog->fetch_assoc()){
        $name = $progress['division'];
        $pid = $progress['pp_id'];
        
        $prog3 = $conn->query("SELECT SUM(progress) as total_prog FROM project_progress WHERE pp_id = '$pid'");
        $row_prog = $prog3->fetch_assoc();
        
        // SAFETY: Use null coalescing to ensure value is at least 0
        $current_val = $row_prog['total_prog'] ?? 0;

        if($current_val <= 50){
            $color = 'rgba(251, 159, 118, 0.8)';
        } else {
            $color = 'rgba(120, 151, 239, 0.8)';
        }

        $chart_data_points[] = [
            "progress" => (int)$current_val,
            "name" => ucfirst($name),
            "color" => $color
        ];
    }

    // 2. Calculate Total Average
    $prog2 = $conn->query("SELECT SUM(progress) as total FROM project_progress NATURAL JOIN project_partition WHERE project_id = '$id'");
    $progress2 = $prog2->fetch_assoc();
    $sum_total = $progress2['total'] ?? 0;

    // SAFETY: Prevent Division by Zero error
    $total_avg = ($num_rows > 0) ? ($sum_total / $num_rows) : 0;
    $formatted_total = number_format($total_avg, 0);
    
    $chart_data_points[] = [
        "progress" => (int)$formatted_total,
        "name" => "Overall Progress",
        "color" => 'rgba(0, 241, 5, 0.6)'
    ];

} else {
    // 3. EMPTY STATE: Prevents the chart from breaking if project is brand new
    $chart_data_points[] = [
        "progress" => 0, 
        "name" => "Pending Setup", 
        "color" => "#eeeeee"
    ];
}

$data_json = json_encode($chart_data_points);
$conn->close();
?>