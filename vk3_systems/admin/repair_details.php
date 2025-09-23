<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:admin_login.php');
   exit();
}

// -------------------- REPAIR STATISTICS --------------------
$total     = $conn->query("SELECT COUNT(*) as c FROM repairs")->fetch(PDO::FETCH_ASSOC)['c'];
$completed = $conn->query("SELECT COUNT(*) as c FROM repairs WHERE servicer_status='completed'")->fetch(PDO::FETCH_ASSOC)['c'];
$pending   = $conn->query("SELECT COUNT(*) as c FROM repairs WHERE admin_status='pending'")->fetch(PDO::FETCH_ASSOC)['c'];
$active    = $conn->query("SELECT COUNT(*) as c FROM repairs WHERE servicer_status='in-progress'")->fetch(PDO::FETCH_ASSOC)['c'];

// -------------------- REPAIRS DATA --------------------
$repairs = $conn->query("SELECT r.*, u.name as uname 
                         FROM repairs r 
                         JOIN users u ON r.user_id=u.id 
                         ORDER BY r.created_at DESC")
                ->fetchAll(PDO::FETCH_ASSOC);

// -------------------- SERVICERS DATA --------------------
$servicers = $conn->query("SELECT s.*, 
    (SELECT COUNT(*) FROM repairs r WHERE r.servicer_id=s.id AND r.servicer_status='completed') as finished_count 
    FROM servicers s")
    ->fetchAll(PDO::FETCH_ASSOC);

$repairs = $conn->query(" SELECT r.*, 
           u.name as uname, 
           s.name as servicer_name
    FROM repairs r
    JOIN users u ON r.user_id = u.id
    LEFT JOIN servicers s ON r.servicer_id = s.id
    ORDER BY r.created_at DESC") 
    ->fetchAll(PDO::FETCH_ASSOC);


$available_servicers = $conn->query("SELECT id, name FROM servicers WHERE status='available'")
                            ->fetchAll(PDO::FETCH_ASSOC);

// -------------------- ADMIN ACTIONS --------------------
if(isset($_GET['id']) && isset($_GET['action'])){
    $id = $_GET['id'];
    $action = $_GET['action'];

    if($action == 'accept'){
        $servicer = $conn->query("SELECT * FROM servicers WHERE status='available' ORDER BY RAND() LIMIT 1");
        $s = $servicer->fetch(PDO::FETCH_ASSOC);

        if($s){
            $conn->query("UPDATE repairs SET admin_status='accepted', servicer_id=".$s['id']." WHERE id=$id");
            $conn->query("UPDATE servicers SET status='busy' WHERE id=".$s['id']);
            echo "<div class='alert success'>✅ Assigned to ".$s['name']." <a href='repair_details.php'>Back</a></div>";
            exit();
        } else {
            echo "<div class='alert error'>❌ No servicers available! <a href='repair_details.php'>Back</a></div>";
            exit();
        }
    }

    if($action == 'reject'){
        $conn->query("UPDATE repairs SET admin_status='rejected' WHERE id=$id");
        echo "<div class='alert error'>❌ Request rejected. <a href='repair_details.php'>Back</a></div>";
        exit();
    }
}

if(isset($_POST['assign'])){
    $repair_id   = intval($_POST['repair_id']);
    $servicer_id = intval($_POST['servicer_id']);

    // Update repair table
    $stmt = $conn->prepare("UPDATE repairs SET admin_status='accepted', servicer_id=? WHERE id=?");
    $stmt->execute([$servicer_id, $repair_id]);

    // Update servicer status
    $stmt = $conn->prepare("UPDATE servicers SET status='busy' WHERE id=?");
    $stmt->execute([$servicer_id]);

    echo "<div class='alert success'>✅ Assigned repair #$repair_id to Servicer ID $servicer_id <a href='repair_details.php'>Back</a></div>";
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Repair Service</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link rel="stylesheet" href="../css/admin_style.css">

<script>
function confirmAction(msg, url){
   if(confirm(msg)){
       window.location.href = url;
   }
}
</script>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="repair_details">

    <h1 class="heading">Repair Service</h1>

    <div class="box-container">
        <h3>Repair Statistics</h3>
        <div class="card">Total Repairs: <?= $total ?></div>
        <div class="card">Completed: <?= $completed ?></div>
        <div class="card">Pending: <?= $pending ?></div>
        <div class="card">Active: <?= $active ?></div>

        <h3>Repair Requests</h3>
        <table class="repair-requests">
            <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Type</th>
                <th>Details</th>
                <th>Status</th>
                <th>Servicer Status</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach($repairs as $r) { ?>
            <tr>
                <td data-label="ID"><?= $r['id'] ?></td>
                <td data-label="User"><?= htmlspecialchars($r['uname']) ?></td>
                <td data-label="Type"><?= htmlspecialchars($r['repair_type']) ?></td>
                <td data-label="Details"><?= htmlspecialchars($r['repair_details']) ?></td>
                <td data-label="Status"><?= htmlspecialchars($r['admin_status']) ?></td>
                <td data-label="Servicer Status"><?= htmlspecialchars(ucfirst($r['servicer_status'])) ?></td>
                <td data-label="Action">
                    <?php if($r['admin_status']=='pending') { ?>
                        <form method="post" action="repair_details.php" style="display:inline;">
                            <input type="hidden" name="repair_id" value="<?= $r['id'] ?>">
                            <select name="servicer_id" required>
                                <option value="">-- Select Servicer --</option>
                                <?php foreach($available_servicers as $sv) { ?>
                                    <option value="<?= $sv['id'] ?>"><?= htmlspecialchars($sv['name']) ?></option>
                                <?php } ?>
                            </select>
                            <button type="submit" name="assign">Assign</button>
                        </form>
                        <button onclick="confirmAction('Reject this request?', 'repair_details.php?id=<?= $r['id'] ?>&action=reject')">Reject</button>
                    <?php } else { 
                        // echo ucfirst($r['admin_status']); 
                        // if($r['servicer_id']){
                        //     echo " (Servicer ID: ".$r['servicer_id'].")";
                        echo ucfirst($r['admin_status']); 
                        if(!empty($r['servicer_name'])){
                            echo " (Servicer: ".htmlspecialchars($r['servicer_name']).")";
                        }
                    } ?>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

        <h3>Servicer Details</h3>
        <table class="servicer-details">
            <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Status</th>
                <th>Finished Repairs</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($servicers as $s) { ?>
            <tr>
                <td data-label="Name"><?= htmlspecialchars($s['name']) ?></td>
                <td data-label="Username"><?= htmlspecialchars($s['username']) ?></td>
                <td data-label="Status"><?= htmlspecialchars($s['status']) ?></td>
                <td data-label="Finished"><?= $s['finished_count'] ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>

</section>

<script src="../js/admin_script.js"></script>
</body>
</html>
