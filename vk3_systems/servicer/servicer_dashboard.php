<?php
include("../components/connect.php");
session_start();

// Check login
if(!isset($_SESSION['servicer_id'])){
    header("Location: servicer_login.php");
    exit;
}

// Process update only if form is submitted
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['repair_id'], $_POST['status'])){
    $repair_id = $_POST['repair_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE repairs SET servicer_status=? WHERE id=?");
    $stmt->execute([$status, $repair_id]);

    if($status=='completed'){
        $stmt = $conn->prepare("SELECT servicer_id FROM repairs WHERE id=?");
        $stmt->execute([$repair_id]);
        $servicer = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt2 = $conn->prepare("UPDATE servicers SET status='available' WHERE id=?");
        $stmt2->execute([$servicer['servicer_id']]);
    }

    header("Location: servicer_dashboard.php");
    exit;
}

// Fetch jobs including repair location
$servicer_id = $_SESSION['servicer_id'];
$jobs = $conn->query("SELECT r.*, u.name as uname FROM repairs r JOIN users u ON r.user_id=u.id WHERE r.servicer_id=$servicer_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Servicer Dashboard</title>
<link rel="stylesheet" href="../css/servicer.css">
</head>
<body>
<div class="container">
    <h2>Servicer Dashboard</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Type</th>
            <th>Tp.num</th>
            <th>Location</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while($j=$jobs->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?= $j['id'] ?></td>
            <td><?= $j['uname'] ?></td>
            <td><?= $j['repair_type'] ?></td>
            <td><?= $j['phone'] ?></td>
            <td>
                <!-- Button to open map modal -->
                <button class="view-map" data-location="<?= htmlspecialchars($j['location']) ?>">View Map</button>
            </td>
            <td>
                <span class="status <?= strtolower(str_replace(' ', '-', $j['servicer_status'])) ?>">
                    <?= $j['servicer_status'] ?>
                </span>
            </td>
            <td>
                <?php if($j['servicer_status']!='completed') { ?>
                    <form action="" method="POST">
                        <input type="hidden" name="repair_id" value="<?= $j['id'] ?>">
                        <select name="status">
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<!-- Modal -->
<div id="mapModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <iframe id="mapFrame" src=""></iframe>
    </div>
</div>

<script>
// Modal functionality
const modal = document.getElementById("mapModal");
const mapFrame = document.getElementById("mapFrame");
const closeBtn = document.querySelector(".close");

// Open modal on button click
document.querySelectorAll(".view-map").forEach(btn => {
    btn.addEventListener("click", () => {
        const location = btn.getAttribute("data-location");
        // Encode location for Google Maps Embed
        const mapSrc = `https://www.google.com/maps?q=${encodeURIComponent(location)}&output=embed`;
        mapFrame.src = mapSrc;
        modal.style.display = "block";
    });
});

// Close modal
closeBtn.onclick = function() {
    modal.style.display = "none";
    mapFrame.src = ""; // clear map
}

// Close modal when clicking outside modal content
window.onclick = function(event) {
    if(event.target == modal){
        modal.style.display = "none";
        mapFrame.src = "";
    }
}
</script>
</body>
</html>
